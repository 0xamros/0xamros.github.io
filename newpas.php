
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleold1.css">
    <title>Document</title>
</head>
<body>
	<form method="post" action="pas.php" class="form">

	<?php
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
}else{
  echo ' <script> alert("cannot go there");window.location.href = "pas.php"</script> ';
}*/
	session_start();
	if (!isset($_SESSION['keyy'])) {
echo ' <script> alert("key is not valid");window.location.href = "pas.php"</script> ';

    //$_SESSION['successed'] = "key is valid";
    
    //header('location: logins.php');
    //echo ($_SESSION['keyy']);
    }else{
    unset($_SESSION['keyy']);
   
    }

	$x=random_bytes(25);
	$y=bin2hex($x);
		
	$db = mysqli_connect('localhost', 'root', '', 'users');
	$query = "INSERT INTO kss (kss) 
  			  VALUES('$y')";
  	mysqli_query($db, $query);
  	?>
  	<div class="input-group">
  	<p0>
    <?php echo "key="."<br>".($y)."<br>"; ?>
		  
  </p0>
  	 <input type="submit" value="get key" class="btn" id="btnHome" onClick="Javascript:window.location.href = 'pas.php';" />
  	 </div>
  	 </form>
  	 </body>
</html>