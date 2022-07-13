<?php 

$driver = 'mysql';
$host = 'localhost';
$dbName = 'commentstest';
$dbUser = 'root';
$pass = 'root';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try{
    $pdo = new PDO(
               "$driver:host=$host;dbname=$dbName;charset=$charset", $dbUser, $pass, $options
    );
}
catch(PDOException $i){
    die("Ошибка подключения к базе данных");
}