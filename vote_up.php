<?php

 /* db connection */
 include('connect.php');
 // DB connection info
 $host = "";
 $user = "";
 $pwd = "";
 $db = "";
 // Connect to database.
 try {
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
         $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         }
         catch(Exception $e){
             die(var_dump($e));
             }


 /* id posted with AJAX */
 $id = $_POST['id'];

 /* query for row with posted id */
 $query = mysql_query("SELECT * FROM likes WHERE image_id = " .$id);

 /* check if row exists */
 if(mysql_num_rows($query) == 1){

 /* if id found -> update row in db by adding 1 to the image_id of the visitor-clicked image */
 mysql_query("UPDATE likes SET likes = likes + 1 WHERE image_id = " .$id);

 } else {

 /* if id not found -> insert into db */
 mysql_query("INSERT INTO likes SET likes = 1, image_id = " .$id);

 }
?>
