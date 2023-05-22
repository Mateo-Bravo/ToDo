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

$id = $task->id;
$name = $task->name;
$description = $task->description;
$date = $task->date;

$slqQuery = "UPDATE tasks SET
    name = '$name', description = '$description', date = '$date' 
    WHERE id = $id";
$result = $connection->query($slqQuery);

if($result){
    echo "El registro se actualizo correctamente";
} else {
    echo "Error, no se pudo actualizar";
}