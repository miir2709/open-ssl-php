<?php
 session_start();
 require 'C:\xampp\htdocs\css_openssl\dbconfig\config.php';
?>

<html lang="en">

	<head>
		<title>Private Key Encryption and Decryption</title>
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
					</div>

					<form class="login100-form validate-form" method="post" action="private_key_encryption_decryption.php">
						<span class="login100-form-title">
							Enter Private Key
						</span>
							

						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" id = "password" type="password" name="password" placeholder="Key">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" name="enter">
								Enter
							</button>
						</div>
					</form>
					<?php
						if(isset($_POST['enter']))
						{
							$username = null;
						
							$username = $_SESSION['username'] ;
							$_SESSION['username'] = $username;
							if($username!=null){
								$query="select * from user WHERE username='$username'";
								$query_run=mysqli_query($con,$query);
								while($row = mysqli_fetch_assoc($query_run)) {
									// $encrypted_pass = $row["password"];
									$username = $row["username"];
									
								}
								if($username == "tony@kakkar.com"){
									$query="select * from user WHERE username='$username'";
									$query_run=mysqli_query($con,$query);
									while($row = mysqli_fetch_assoc($query_run)) {
										// $encrypted_pass = $row["password"];
										$username = $row["username"];
										// $privKey = $row['PrivateKey'];
										// $pubKey = $row['PublicKey'];
										// echo $privKey, $pubKey;
									}
									$original_string = "This is a secret message for Tony. ";
									$key_for_encryption='aa1234'; // hex string
									
									
									// Decrypt the data using the private key and store the results in $decrypted

									// openssl_private_decrypt($encrypted, $decrypted, $privKey);
									// echo $encrypted , "    ", $decrypted;

								}
								else if($username == "neha@kakkar.com"){
									$original_string = "This is a secret message for Neha. ";
									$key_for_encryption='bb1234';
								}
								else if($username == "sonu@kakkar.com"){
									$original_string = "This is a secret message for Sonu. ";
									$key_for_encryption='cc1234';
								}
								$private_secret_key = $_POST['password'];        // '1f4276388ad3214c873428dbef42243f' //some random hex characters
								// var_dump($private_secret_key);die;
							
								function encrypt($message, $encryption_key){
									$key = hex2bin($encryption_key);
									$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
									$nonce = openssl_random_pseudo_bytes($nonceSize);
									$ciphertext = openssl_encrypt(
									$message, 
									'aes-256-ctr', 
									$key,
									OPENSSL_RAW_DATA,
									$nonce
									);
									return base64_encode($nonce.$ciphertext);
								}
								function decrypt($message,$encryption_key){
									$key = hex2bin($encryption_key);
									$message = base64_decode($message);
									$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
									$nonce = mb_substr($message, 0, $nonceSize, '8bit');
									$ciphertext = mb_substr($message, $nonceSize, null, '8bit');
									$plaintext= openssl_decrypt(
									$ciphertext, 
									'aes-256-ctr', 
									$key,
									OPENSSL_RAW_DATA,
									$nonce
									);
									return $plaintext;
								}
								// $private_secret_key = '1f4276388ad3214c873428dbef42243f' ; //some random hex characters
								$encrypted = encrypt($original_string,$private_secret_key);
								// echo '<h3>Original String : '.$original_string.'</h3>';
								echo '<h3>After Encryption : '.$encrypted.'</h3>';
								echo '<h3>After Decryption : '.decrypt($encrypted,$key_for_encryption).'</h3>';	
							}
						}
					?>
					<div class="signup-image">
						<a href="../message/send_message.php" class="signup-image-link">Send Message</a>				
					</div>
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