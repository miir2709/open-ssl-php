<?php
 require 'C:\xampp\htdocs\css_openssl\dbconfig\config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                         
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="username" id="email" placeholder="Username"/ required>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/ required>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="cpassword" id="re_pass" placeholder="Confirm your password"/ required>
                            </div>
                            <!-- <div class="form-group"> -->
                                <!-- <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" /> -->
                                <!-- <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label> -->
                            <!-- </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="submit_btn" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
						<?php
							if(isset($_POST['submit_btn']))
							{
								//echo '<script type="text/javascript">alert("Sign up button clicked")</script>';
								
								
							$username = $_POST['username'];
							$password = $_POST['password'];
							$cpassword = $_POST['cpassword'];
							$config = array(
                                "digest_alg" => "sha512",
                                "private_key_bits" => 4096,
                                "private_key_type" => OPENSSL_KEYTYPE_RSA,
                            );
                               
                            // Create the private and public key
                            $res = openssl_pkey_new($config);
                            
                            // Extract the private key from $res to $privKey
                            openssl_pkey_export($res, $privKey);
                            
                            // Extract the public key from $res to $pubKey
                            $pubKey = openssl_pkey_get_details($res);
                            $pubKey = $pubKey["key"];
                            // echo $pubKey , "   ", $privKey ;
							if($password==$cpassword)
							{
								$query="select * from user WHERE username='$username'";
								
								$query_run=mysqli_query($con,$query);
								// $query2="select * from user order by user_id desc limit 1";
                                // $query_run2=mysqli_query($con,$query2);
                                
                                // $user_id = $query_run2->fetch_array()['user_id'] ?? '';
                                // $user_id = $user_id + 1;
								if(mysqli_num_rows($query_run)>0)
								{
									//there is already a user with the same username
									echo '<script type="text/javascript">alert("Username already exists try another username")</script>';
								}
								else
								{  
                                    $encrpyted_pass = secured_encrypt($password);
                                    // echo $password;
                                    // $privKey_phrase = openssl_pkey_get_private($privKey, "phrase");
									$query="insert into user values('$username','$encrpyted_pass', '$privKey', '$pubKey')";
									$query_run=mysqli_query($con,$query);
									
									if($query_run)
									{
										echo '<script type="text/javascript">alert("User Registered")</script>';
									}
									else
									{
										echo '<script type="text/javascript">alert("Error!!!")</script>';
										 
									}
								}
								
							}
							else
							{
								echo '<script type="text/javascript">alert("Error!!Passwords do not match Please re-enter...")</script>';
							}
							
							 
							}
							
						?>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/img-01.png" alt="sing up image"></figure>
                        <a href="../index.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <!-- <section class="sign-in"> -->
            <!-- <div class="container"> -->
                <!-- <div class="signin-content"> -->
                    <!-- <div class="signin-image"> -->
                        <!-- <figure><img src="images/signin-image.jpg" alt="sing up image"></figure> -->
                        <!-- <a href="#" class="signup-image-link">Create an account</a> -->
                    <!-- </div> -->

                    <!-- <div class="signin-form"> -->
                        <!-- <h2 class="form-title">Sign up</h2> -->
                        <!-- <form method="POST" class="register-form" id="login-form"> -->
                            <!-- <div class="form-group"> -->
                                <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                                <!-- <input type="text" name="your_name" id="your_name" placeholder="Your Name"/> -->
                            <!-- </div> -->
                            <!-- <div class="form-group"> -->
                                <!-- <label for="your_pass"><i class="zmdi zmdi-lock"></i></label> -->
                                <!-- <input type="password" name="your_pass" id="your_pass" placeholder="Password"/> -->
                            <!-- </div> -->
                            <!-- <div class="form-group"> -->
                                <!-- <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" /> -->
                                <!-- <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label> -->
                            <!-- </div> -->
                            <!-- <div class="form-group form-button"> -->
                                <!-- <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/> -->
                            <!-- </div> -->
                        <!-- </form> -->
                        <!-- <div class="social-login"> -->
                            <!-- <span class="social-label">Or login with</span> -->
                            <!-- <ul class="socials"> -->
                                <!-- <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li> -->
                                <!-- <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li> -->
                                <!-- <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li> -->
                            <!-- </ul> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </section> -->

    <!-- </div> -->

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>