<?php
 session_start();
 require 'C:\xampp\htdocs\css_openssl\dbconfig\config.php';
?>

<html lang="en">

<head>
	<title>Send Message</title>
	<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<!-- <title>Animal Shelter</title> -->

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="../css/linearicons.css">
			<link rel="stylesheet" href="../css/font-awesome.min.css">
			<link rel="stylesheet" href="../css/bootstrap.css">
			<link rel="stylesheet" href="../css/magnific-popup.css">
			<link rel="stylesheet" href="../css/nice-select.css">							
			<link rel="stylesheet" href="../css/animate.min.css">
			<link rel="stylesheet" href="../css/owl.carousel.css">
			<link rel="stylesheet" href="../css/main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

<body>
	  
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/img.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<span class="login100-form-title">
						Send Message
					</span>
						
					<div class="wrap-input100 validate-input" data-validate = "Text is required">
						<input class="input100" type="text" name="message" placeholder="Your message goes here">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Receivers Name is required. Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="receiver" placeholder="Receivers Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="send">
							Send
						</button>
					</div>
				</form>
				<?php

						if(isset($_POST['send'])){
							$username = $_SESSION['username'] ;
							$_SESSION['username'] = $username;

							$message=$_POST['message'];
							$receiver=$_POST['receiver'];

							$query="SELECT * FROM user WHERE username='$receiver'";
							$query_run=mysqli_query($con,$query);
							if((mysqli_num_rows($query_run)>0))
							{
								// while($row = mysqli_fetch_assoc($query_run)) {
								//     $receiver = $row["username"];
								//   }
								// echo $receiver;
								
								$query="SELECT * FROM friends WHERE sender='$username' AND receiver = '$receiver'";
								$query_run=mysqli_query($con,$query);
								if((mysqli_num_rows($query_run)>0))
								{
									while($row = mysqli_fetch_assoc($query_run)) {
										$pubKey = $row["receiver_public_key"];
									}
									// echo "Public Key from FRIENDS:", "            ",$pubKey;
								}

								else{
									$query="SELECT * FROM user WHERE username = '$receiver'";

									$query_run=mysqli_query($con,$query);

									if((mysqli_num_rows($query_run)>0))
									{
										while($row = mysqli_fetch_assoc($query_run)) {
											$pubKey = $row["PublicKey"];
											// $privKey = $row["PrivateKey"];
										}
									}
									// echo "Public Key from user:", "           ", $pubKey;
									$query="INSERT INTO friends VALUES ('$username' , '$receiver', '$pubKey')";
									$query_run=mysqli_query($con,$query);
									if($query_run)
									{
										echo '<script type="text/javascript">alert("Inserted into friends table")</script>';
									}
									else
									{
										echo '<script type="text/javascript">alert("Error!!!")</script>';
										 
									}
								}
								// $data = 'plaintext data goes here';
					
								// Encrypt the data to $encrypted using the public key
								openssl_public_encrypt($message, $encrypted, $pubKey);	 	
								echo $encrypted, "<br>", $message , "<br>", $username, "<br>", $receiver;
								$query="INSERT INTO messages VALUES ('$username', '$receiver', '$encrypted')";
								$query_run=mysqli_query($con,$query);
								if($query_run)
									{
										echo '<script type="text/javascript">alert("Message Sent")</script>';
									}
									else
									{
										echo '<script type="text/javascript">alert("Error!!!")</script>';
										 
									}
							}	
							else{
								echo '<script type="text/javascript">alert("No such username...")</script>';
							}
						}

				?>
					<div class="signup-image">
						<a href="../message/view_message.php" class="signup-image-link">View Message</a>				
					</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>