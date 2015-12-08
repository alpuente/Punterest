<?php
// DB connection info
$host = "";
$user = "r";
$pwd = "";
$db = "";
try{
    $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "CREATE TABLE puns(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    name VARCHAR(300),
    email VARCHAR(120),
    date DATE)";
    $conn->query($sql);

    echo "<h1> Made table </h1>";
}
catch(Exception $e){
    die(print_r($e));
}
echo "<h3>Table created.</h3>";
?>
