<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
     <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Document</title>
</head>
<body>
    <!----------------------Font Family-------------------->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@900&display=swap" rel="stylesheet">
<!-------------------------------------------------------->
<?php
session_start();
@$db = mysqli_connect('localhost', 'root', '', 'users');
if($db === false){
    @die("<h1>ERROR: Could not connect to db.");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	function cap($user_response){

		$field_string = '';
		$field = array(

			'secret'=>'6LfNm-MZAAAAAHglhVzL3ukUAkJXFWiETd63Ul7i',
			'response' => $user_response
		);
		foreach ($field as $key => $value)
			$field_string .= $key . '=' . $value .'&';
			$field_string = rtrim($field_string , '&');
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($ch, CURLOPT_POST, count($field));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
	}
	$res = cap($_POST['g-recaptcha-response']);
	if (!$res['success']) {
		echo ' <script> alert("wrong capatcha");window.location.href = "pas.php"</script> ';
	}else{
		//$ks=filter_var($_POST['key'], FILTER_SANITIZE_STRING);
		$ks=$_POST['key'];
		$re=mysqli_query($db,"SELECT * FROM kss WHERE kss like '$ks'");
 		  
  if (mysqli_num_rows($re)==1 ) {
  	echo "done";
  	$delete_query = mysqli_query($db,"delete FROM kss WHERE kss like '$ks'");
  	unset($_SESSION['keyy']);
  } else {

  echo ' <script> alert("key wrong");window.location.href = "pas.php"</script> ';
  	
exit;

  }
  
	}
}else{
	echo ' <script> alert("cannot go there");window.location.href = "pas.php"</script> ';
}
?>
<!------------div-Login---------->
<div class='login'>
  <h2>Promo Code</h2>

  <!----user name------------->
  <form action="vod0.php" method="post">
  <input name='number' placeholder='number' type='text'>
  
  <!----------password-->

  <input id='pw' name='pwd' placeholder='Password' type='password'>

  
  <!--------Login------->
  <input  type='submit' name= "login" value='Login'>
  <footer>
    <p>by claw team new members &copy;</p>
  </footer>
</div>
</body>
</html>

