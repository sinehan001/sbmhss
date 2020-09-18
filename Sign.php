<?php

session_start();

if (isset($_SESSION['uname']) && isset($_SESSION['email'])) {
	header("Location: index.php");
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
</head>

<body>
	<div class="heading heading-center" style="width: 400px; height: 50px;">
	<h2>SBMHSS (Suspended)</h2> 
	</div>
	<div class="container container-center" style="width: 400px; height: 450px;">
		<h1> SignUp</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<?php
			    if(isset($_POST['uname'])){
			        echo '<input type="text" name="uname" value="'.$_POST['uname'].'" required>';
			    }
			    else{
			        echo '<input type="text" name="uname" placeholder="Username" required>'; }?>
			<?php 
			    if(isset($_POST['email'])){
                    echo '<input type="email" name="email" value="'.$_POST['email'].'" required>';
			    }
			    else{ 
			        echo '<input type="email" name="email" placeholder="Email Address" required>'; }?>
			<?php
			    if(isset($_POST['phnno'])){
			    	echo '<input type="number" name="phnno" value="'.$_POST['phnno'].'" required>';
			    }
			    else{
			        echo  '<input type="number" name="phnno" placeholder="Phone Number" required>'; }?>
			<?php
			    if(isset($_POST['pwd'])){
			    	echo '<input type="password" name="pwd" value="'.$_POST['pwd'].'" required>';
			    }
			    else{
			    	echo '<input type="password" name="pwd" placeholder="Set Password" required>'; }?>
			
			<button type="submit">Signup</button>
            <br>
            <span> Already an User? <a href="Login.php">Login</a></span>
		</form>

	</div>
	
<?php
     if($_SERVER['REQUEST_METHOD'] == "POST"){
     	  $uname = $_POST['uname'];
     	  $email = $_POST['email'];
     	  $phnno = $_POST['phnno'];
     	  $pwd = $_POST['pwd'];
          $dbServerName = "localhost";
          $dbUserName = "id14710301_sbmhssdb";
          $dbPassword = "@Sinehandb22";
          $dbName = "id14710301_sbmhss";
     	  $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
     	  $sql = "SELECT uname from users where uname = '$uname'; ";
     	  $result = mysqli_query($conn,$sql);

     	  if(mysqli_num_rows($result) > 0)
     	  {
     	  	echo '<script> alert("Username already been taken!"); </script> ';
     	  }
     	  else
     	  {
     	  	$sql = "SELECT * from users where phnno = '$phnno'; ";
     	    $result = mysqli_query($conn,$sql);
     	  }

     	  if(mysqli_num_rows($result) > 0)
     	  {
     	  	echo '<script> alert("Phone Number already been registered!"); </script> ';
     	  }
     	  else
     	  {
     	  	$sql = "INSERT into users (uname, email, phnno, pwd) VALUES('$uname', '$email', '$phnno', '$pwd')";
     	    mysqli_query($conn,$sql);

     	    $_SESSION['uname'] = $uname;
     	    $_SESSION['email'] = $email;
              
            header("Location: index.php");
            exit();
     	  }

     }?>
</body>
</html>