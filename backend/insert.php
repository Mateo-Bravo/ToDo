<?php
header("Access-Control-Allow-Origin:*");
$dsn = "mysql:host=localhost;dbname=todo";
$username = "root";
$password = "12345";
$options = ["\PDO::ATTR_ERRMODE" => "\PDO::ERRMODE_EXCEPTION"];

try{
$connection = new PDO($dsn, $username, $password);
}catch(Exception $exception){
    print_r($exception);
}

$content = file_get_contents("php://input");
$task = json_decode($content);

$name=$task->name;
$description=$task->description;
$date=$task->date;

$slqQuery = "INSERT INTO tasks (name, description, date)
    VALUES ('$name', '$description', '$date')";

$result = $connection->query($slqQuery);

if($result){
    echo "El registro se guardo correctamente";
} else {
    echo "Error, no se pudo registrar";
}

