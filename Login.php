<?php
$user = new Memcached();
if(isset($_POST['btn-login'])){
	$email=$_POST['inputEmail'];
	$password=$_POST['inputEmail'];

	$user->setMulti(['id' => 12345, 'email' => $email, 'password' => $password, 'fname' => "dan"], 300);
		
}
var_dump($user->get('email'));
echo "test";
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Timer Agency Template</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        
        <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- owl carouserl js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- bootstrap js -->

        <script src="js/bootstrap.min.js"></script>
        <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- slider js -->
        <script src="js/slider.js"></script>
        <script src="js/jquery.fancybox.js"></script>
        <!-- template main js -->
        <script src="js/main.js"></script>
    </head>
    <body>
        
        <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 block wow fadeInUp">
                        <div class="cd-intro">
                           
                            
                        </div>
                    </div>
                </div>
            </div>
            </section><!--/#Page header-->

      <section id="hero-area" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="block wow fadeInUp" data-wow-delay=".3s">
                            
                            <!-- Slider -->
                            <section class="cd-intro">
                                 <h2>Login Here</h2>
                        	<br>
                            <div class="col-md-3"></div>

                            <form action="login.php" method="POST"  class="col-md-6">
                                <label for="inputEmail" class="sr-only">Email address</label>
                                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required>
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
                                <div class="checkbox">
                                </div>
                                <button  name="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#main-slider-->

            <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            
                
            </body>
        </html>
    </html>