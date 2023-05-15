<?php
// CODE FO A LOT OF TABLES IN DATABASE
/*session_start();
$a= "";
if(isset($_POST['Name']) && isset($_POST['Pass']) && isset($_POST['Email'])){
$salt = uniqid(mt_rand(), true);
$_SESSION['email'] = $_POST['Email'];
$_SESSION['Name'] = $_POST['Name'];
$name = $_POST['Name'];
$pass = $_POST['Pass'] . $salt;
$email = $_POST['Email'];
$hashed_salted_pass = hash('sha256', $pass);
    
    if (strlen(trim($pass && $name && $email)) < 1){
    $a = "Name, email and password are required" ;
    }
    elseif (strpos($email, '@') === false) {
        $a = "Email must have an at-sign (@)";
        }
    elseif (strlen(trim($hashed_salted_pass)) > 0 && strlen(trim($name)) > 0 && strlen(trim($email)) > 0){
            require_once "PDO.php";
            $val = ("SELECT * FROM `$email`");
            $result = $pdo->prepare($val);
            $result->execute(array(':email' => $email));
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            //print_r($rows);

            if ($rows == null){
                $sql = "INSERT INTO Users (Name, Email) VALUES (:name,  :email);

                INSERT INTO UsersPriv (Username, Email, Password, Salt, Hash) VALUES (:name,  :email, :password, :salt, :hash);
               
                CREATE TABLE `$email`(
                        car_id INT NOT NULL AUTO_INCREMENT,
                        Make VARCHAR(128),
                        Year VARCHAR(128),
                        Milage VARCHAR(128),
                        PRIMARY KEY (car_id)
                )ENGINE=INNODB CHARSET=UTF8;

                INSERT INTO `$email` (Make, Year, Milage) VALUES (0,  0, 0)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':name' => $_POST['Name'],
                    ':email' => $_POST['Email'],
                    ':password' => $_POST['Pass'],
                    ':salt' => $salt,
                    ':hash'=> $hashed_salted_pass));

                header("Location: autos.php ");

            } else {
                $sql = ("SELECT `Salt`, `Hash`, `Username` FROM `UsersPriv` WHERE Email=:email");
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':email' => $_POST['Email']));
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    $salt = $res[0]['Salt'];
                    $hashed_salted_pass = $res[0]['Hash'];
                    $database_name = $res[0]['Username'];
                    
                    $val = $_POST['Pass'] . $salt;
                    $hashed_salted_val = hash('sha256', $val);
                }
                if ($hashed_salted_pass == $hashed_salted_val && $name == $database_name){
                    header("Location: autos.php ");
                } else {
                    $a = "Incorrect Password or Username!";
                }
                //return false; 
                //echo $_SESSION['email'];
                // SELECT `Salt`, `Hash` FROM `UsersPriv` WHERE Email='philip@gmail.com'
                }
                }
            }
                
    if(isset($_POST['Cancel'])){
        header("Location: Index.php ");
}

*/



// CODE FOR A LOT OF DATA/ROWS IN TABLES

session_start();
$a= "";
if(isset($_POST['Name']) && isset($_POST['Pass']) && isset($_POST['Email'])){
$salt = uniqid(mt_rand(), true);
$_SESSION['email'] = $_POST['Email'];
$_SESSION['Name'] = $_POST['Name'];
$name = $_POST['Name'];
$pass = $_POST['Pass'] . $salt;
$email = $_POST['Email'];
$hashed_salted_pass = hash('sha256', $pass);
    
    if (strlen(trim($pass && $name && $email)) < 1){
    $a = "Name, email and password are required" ;
    }
    elseif (strpos($email, '@') === false) {
        $a = "Email must have an at-sign (@)";
        }
    elseif (strlen(trim($hashed_salted_pass)) > 0 && strlen(trim($name)) > 0 && strlen(trim($email)) > 0){
            require_once "PDO.php";
            $val = ("SELECT Email FROM User WHERE Email=:email");
            $result = $pdo2->prepare($val);
            $result->execute(array(':email' => $email));
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            //print_r($rows);

            if ($rows == null){
                $sql = "INSERT INTO User (Name, Email) VALUES (:name,  :email); ";

                $sql2 = "SELECT user_id FROM User WHERE Email = :email";

                $sql3 = "INSERT INTO UserPriv (Name, Email, Password, Salt, Hash, user_id) VALUES (:name,  :email, :password, :salt, :hash, :userid)";

                $stmt = $pdo2->prepare($sql);
                $stmt->execute(array(
                    ':name' => $_POST['Name'],
                    ':email' => $_POST['Email']));
                
                $stmt2 = $pdo2->prepare($sql2);
                $stmt2->execute(array(
                    ':email' => $_POST['Email']));
                $row = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $user_id = $row[0]['user_id'];

                $stmt3 = $pdo2->prepare($sql3);
                $stmt3->execute(array(
                    ':name' => $_POST['Name'],
                    ':email' => $_POST['Email'],
                    ':password' => $_POST['Pass'],
                    ':salt' => $salt,
                    ':hash'=> $hashed_salted_pass,
                    ':userid' => $user_id));
                header("Location: autos2.php ");
                

            } else {
                $sql = ("SELECT `Salt`, `Hash`, `Name` FROM `UserPriv` WHERE Email=:email");
                $stmt = $pdo2->prepare($sql);
                $stmt->execute(array(
                    ':email' => $_POST['Email']));
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($res) && isset($_POST['Pass'])) {
                    $salt = $res[0]['Salt'];
                    $hashed_salted_pass = $res[0]['Hash'];
                    $database_name = $res[0]['Name'];
                    
                    $val = $_POST['Pass'] . $salt;
                    $hashed_salted_val = hash('sha256', $val);
                }
                if ($hashed_salted_pass == $hashed_salted_val && $name == $database_name){
                    header("Location: autos2.php ");
                } else {
                    $a = "Incorrect Password or Username!";
                }
                //return false; 
                //echo $_SESSION['email'];
                // SELECT `Salt`, `Hash` FROM `UsersPriv` WHERE Email='philip@gmail.com'
                }
                }
            }
                
    if(isset($_POST['Cancel'])){
        header("Location: Index.php ");
}
//*/


?>





<html>
<style>
    body {
  padding-top: 50px;
}
.starter-template {
  padding: 40px 15px;
  text-align: center;
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

label{
    display: inline-block;
    float: left;
    clear: left;
    width: 80px;
    text-align: left; /*Change to right here if you want it close to the inputs*/
}
input {
  display: inline-block;
  float: left;
}
</style>

<head>
    <title>Philip Dewanto's LogIn Screen</title>
</head>
    
<body>
    <div class="container">
    <h1>Please Log In</h1>
    
    <p> <span style="color:#FF0000;text-align:center"> <?php echo ($a);?> </span> </p>
        
    <form method="post">
        <label for="Name"><b>Username: </b></label>
        <input type="text" name="Name" id="Name">
        <br>
        <label for="Email"><b>Email: </b></label>
        <input type="text" name="Email" id="Email">
        <br>
        <label for="Pass"><b>Password: </b></label>
        <input type="passowrd" name="Pass" id="Pass">
        <br>
        <br>
        <input value="Log In" type="Submit">
        <input type="submit" value="Cancel" name="Cancel" id="Cancel">
        <php echo $rows; ?>
    </form>
    </div>
    
    
    
</body>
</html>

