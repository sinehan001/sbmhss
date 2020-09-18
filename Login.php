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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style34.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
</head>
<body>
	<div class="heading heading-center" style="width: 400px; height: 50px;">
	<h2>SBMHSS (Suspended)</h2> 
	</div>
	<div class="container container-center" style="width: 400px; height: 350px;">
		<h1> Login </h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<?php
			    if(isset($_POST['phnno'])){
			    	echo '<input type="email" name="email" value="'.$_POST['email'].'" required>';
			    }
			    else{
			        echo  '<input type="email" name="email" placeholder="Email Address" required>'; }?>
			<input type="password" name="pwd" placeholder="Password" required>
			<button type="submit">Login</button>
            <br>
            <span> New User? <a href="sign.php">SignUp</a></span>
		</form>

	</div>
<?php
     if($_SERVER['REQUEST_METHOD'] == "POST"){

     	  $email = $_POST['email'];
     	  $pwd = $_POST['pwd'];

          $dbServerName = "localhost";
          $dbUserName = "id14710301_sbmhssdb";
          $dbPassword = "@Sinehandb22";
          $dbName = "id14710301_sbmhss";
     	  $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

     	  $sql = "SELECT * from users where email = '$email'; ";
     	  $result = mysqli_query($conn,$sql);
     	  

     	  if(mysqli_num_rows($result) != 1){
     	  	echo '<script> alert("Email Address not yet registered!"); </script> ';
     	  }
     	  else
     	  {
     	  	$row = mysqli_fetch_assoc($result);

            if($pwd != $row['pwd']){
                 echo '<script> alert("Your Password is wrong!"); </script> ';
            }
            else{

     	    $_SESSION['uname'] = $row['uname'];
     	    $_SESSION['email'] = $row['email'];
              
            header("Location: index.php");
            exit();
     	  }
     	}

     } ?>
</body>
</html>