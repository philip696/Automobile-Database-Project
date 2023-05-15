<?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=Automobiles', 'philip', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

$pdo2 = new PDO('mysql:host=localhost;port=8889;dbname=Automobile2', 'philip', 'zap');
$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

?>