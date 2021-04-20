<?php
 session_start();
 require 'C:\xampp\htdocs\css_openssl\dbconfig\config.php';
?>

<html lang="en">

<head>
	<title>View Message</title>
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
						View Message
					</span>
						
					
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="view">
							View
						</button>
					</div>
				</form>
				<?php

						if(isset($_POST['view'])){
							$username = $_SESSION['username'] ;
                            $query="SELECT * FROM user WHERE username='$username'";
							$query_run=mysqli_query($con,$query);
                            if((mysqli_num_rows($query_run)>0))
							{
								while($row = mysqli_fetch_assoc($query_run)) {
								    $privKey = $row["PrivateKey"];
									$pubKey = $row["PublicKey"];
                                }
                            }
                            // echo $username, "<br>",$privKey, "<br><br>", $pubKey;
							$data = 'plaintext data goes here';
							$query="SELECT * FROM messages WHERE receiver='$username'";
							$query_run=mysqli_query($con,$query);
							if((mysqli_num_rows($query_run)>0))
							{	
								// echo $privKey;
								while($row = mysqli_fetch_assoc($query_run)) {
									// $decrypted = "hello";
									$encrypted = null;
									// echo $row["message"], "<br><br><br><br>" ;
								    $encrypted = $row["message"];
                                    $sender = $row["sender"];
                                    // echo $message ,"<br><br>", $privKey ,"<br><br>";
									openssl_public_encrypt($data, $m, $pubKey);
									echo $encrypted, "<br><br>";
                                    openssl_private_decrypt($m, $decrypted, $privKey);
									echo $decrypted, "<br><br>";
                                    // var_dump($decrypted); die();
								  }
							}	
							else{
								echo '<script type="text/javascript">alert("Sadly there are no messages for you...")</script>';
							}
						}

				?>
					
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