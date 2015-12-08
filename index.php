<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Montserrat Font -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <title>Punterest</title>    
</head>
<body>
<div class="head">
    <h1>Welcome to Punterest!</h1>
</div>
<center>
<p>Fill in a pun url and a text description, then click <strong>Submit</strong> to post a new pun.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
      Pun URL  <input type="text" name="name" id="name"/></br>
      Pun description <input type="text" name="email" id="email"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
</center>
<div>
<?php
//include("slike/like_function.php");
// DB connection info
$host = "";
$user = "";
$pwd = "1";
$db = "";
// Connect to database.

try {
    $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));

}

if(!empty($_POST)) {
try {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = date("Y-m-d");
    $like_num = 0;
    $dislike_num = 0;

    if ($name 
    
    // Insert data
    $sql_insert = "INSERT INTO puns (name, email, date, like_num, dislike_num)
                   VALUES (?,?,?,?,?)";

    $stmt = $conn->prepare($sql_insert);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $date);
    $stmt->bindValue(4, $like_num);
    $stmt->bindValue(5, $dislike_num);
    $stmt->execute();
}
catch(Exception $e) {
    die(var_dump($e));
}
echo "<h3>You created a post!</h3>";
}

$sql_select ="SELECT * FROM puns";

$stmt = $conn->query($sql_select);

$pun = $stmt->fetchAll();

if(count($pun) > 0) {
    
    echo "<div class=\"grid\">";
    foreach($pun as $prow) {
        echo "<a class=\"pin-item\">";
        echo "<img src=\"".$prow['name']."\">";
        echo "<h2>".$prow['email']."</h2>";
        echo "<center>";
        echo "<span class=\"likebtn-wrapper\" data-theme=\"disk\" data-i18n_like=\"Like\" data-white_label=\"true\" data-identifier=\"".$prow['id']."\"></span>";
        echo "<script>(function(d,e,s){if(d.getElementById(\"likebtn_wjs\"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id=\"likebtn_wjs\";a.src=s;m.parentNode.insertBefore(a, m)})(document,\"script\",\"//w.likebtn.com/js/w/widget.js\");</script>";
        echo "</center>";
        echo "</a>";
    }    echo "</div>";
} else {
    echo "<h3>No one is currently registered.</h3>";
}
?>
    <script type="text/javascript">
/**
* Function Name: cwRating()
* Function Author: CodexWorld
* Description: cwRating() function is used for implement the rating system. cwRating() function insert like or dislike data into the database and display the rating count at the target div.
* id = Unique ID, like or dislike is based on this ID.
* type = Use 1 for like and 0 for dislike.
* target = Target div ID where the total number of likes or dislikes will display.
**/
function cwRating(id,type,target){
    $.ajax({
        type:'POST',
        url:'rating.php',
        data:'id='+id+'&type='+type,
        success:function(msg){
            if(msg == 'err'){
                alert('Some problem occured, please try again.');
            }else{
                $('#'+target).html(msg);
            }
        }
    });
}
</script>


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="js/pingrid.js"></script>
    <script src="js/main.js"></script>



</body>
</html>
         
