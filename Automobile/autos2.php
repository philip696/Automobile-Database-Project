<?php
session_start();
if (isset($_SESSION['email']))
$email = $_SESSION['email'];
$date = date("Y");
$a = "";
//echo $date;
//echo $email;

require_once "PDO.php";
$stmt = $pdo2->prepare("SELECT * FROM User WHERE Email= :email");
$stmt->execute(array(
    ':email' => $_SESSION['email']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$name = $rows[0]['Name'];

$stmt2 = $pdo2->prepare("SELECT user_id FROM User WHERE Email = :email");
$stmt2->execute(array(':email' => $_SESSION['email']));
$rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$user_id = $rows2[0]['user_id'];

if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['milage'])){
    if (strlen(trim($_POST['make'])) > 0 && strlen(trim($_POST['year'])) > 0 && strlen(trim($_POST['milage'])) > 0)  {
        $sql = "INSERT INTO `Cars` (Make, Year, Milage, user_id) VALUES (:make,  :year, :milage, :userid)";
        $stmt2 = $pdo2->prepare($sql);
        $stmt2->execute(array(
            ':make' => $_POST['make'],
            ':year' => $_POST['year'],
            ':milage' => $_POST['milage'],
            ':userid' => $user_id));

            //echo $sql;

        } else {
            $a = "All fields are required to be filled";
        }
            //echo($make) . ($year) . ($milage);


}

if(isset($_POST['logout'])){
    header("Location: LogIn.php ");
    die ();
}
//print_r($rows);
?>

<html lang="en">
<head>
    <title></title>
</head>
<style>
#message-box {
    width: 67%;
    padding: 0.87px;
    background: lightgray;
    color: black;
    max-width: 720px;
    min-width: 320px;
    outline-style: solid;
    outline-width: 1px;
    outline-color: black;
    border-radius: 10px;
      padding-bottom: 7px;
    text-align: left;
}
    body {
  padding-top: 50px;
}

label{
    display: inline-block;
    float: left;
    clear: left;
    width: 60px;
    text-align: left; /*Change to right here if you want it close to the inputs*/
}
input {
  display: inline-block;
  float: left;
}

.container{
    padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto
    }
    @media (min-width:768px){
        .container{width:750px}
    }
    @media (min-width:992px){
        .container{width:970px}
    }
    @media (min-width:1200px){
        .container{width:1170px}
    }
    .container-fluid{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
</style>

<body>
    <div div class="container">
        <h1>Tracking Autos for <?php echo htmlentities($name); ?></h1>
        <table border= "1">
            <?php
                foreach ( $rows as $row ) {
                    echo "<tr><td>";
                    echo("Name:");
                    echo("</td><td>");
                    echo($row['Name']);
                    echo("</td></tr>\n");

                    echo "<tr><td>";
                    echo("Email:");
                    echo("</td><td>");
                    echo($row['Email']);
                    echo("</td></tr>\n");
                }
            ?>
        </table>
<br>
        <p> <span style="color:#FF0000;text-align:center"> <?php echo htmlentities($a);?> </span> </p>
</br>
        <form method="post">
            <div class="message-box">
                <label for="make"><b>Make: </b></label>
                <input type="text" name="make" id="make">
                <br>
                <br>
                <label for="year"><b>Year: </b></label>
                <input type="number" name="year" id="year" min="1886" max=<?php echo ($date) ?> >
                <br>
                <br>
                <label for="milage"><b>Milage: </b></label>
                <input type="number" name="milage" id="milage" min="0"> 
                <br>
                <br>
                <input value="Add" type="Submit">
                <input type="submit" value="Logout" name="logout" id="logout">
            </div>
        </form>
<br>
        <h2>Automobiles</h2>
        <ul>
            <?php
                $stmt3 = $pdo2->prepare("SELECT * FROM `Cars` WHERE user_id = :userid");
                $stmt3->execute(array(
                    ':userid' => $rows2[0]['user_id']));

                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows3 as $row3) {
                    $database_make = $row3['Make'];
                    $database_year = $row3['Year'];
                    $database_milage = $row3['Milage'];
                    echo "<li>" . $database_year . " " . $database_make . " " .  $database_milage . "Km" . "<br>";
                }
            
             ?>
        </ul> 
    </div>
</body>
</html>