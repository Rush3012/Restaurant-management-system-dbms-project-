<?php
require("db.php");
include("auth.php");
$email=$_SESSION['email']; //include auth.php file on all secure pages ?>
<!doctype html>
<html lang="en">

<head>
    <link href="//db.onlinewebfonts.com/c/465b1cbe35b5ca0de556720c955abece?family=AbolitionW00-Regular" rel="stylesheet"
        type="text/css" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/linearicons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/fixed.css">
    <link rel="stylesheet" href="css/button.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>Baker's Street</title>
</head>



<body data-aos-easing="ease-out-back" data-aos-duration="1500" data-aos-delay="0">
    <div class="se-pre-con"></div>

    <nav class="navbar navbar-expand-md navbar-dark position-sticky-top fixed-top">
        <div class="canvas-area">
            <div class="head1">
                <a class="navbar-logo" href="#"><img src="img/logo.png"
                        style="height:5000px; width: 214px;padding-top:1px"> </a></div>
            <div class="flot">
                <button class="navbar-toggler" type="button " style="float: right" data-toggle="collapse"
                    data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon "></span>
                </button>
            </div>

            <div class="collapse navbar-collapse text-right" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">
                            <p><?php
            $query1="select name from customer where email='$email'";
            $nameg = mysqli_query($con,$query1);
            while ($row = mysqli_fetch_assoc($nameg)) {
                echo $row['name']."<br>";
            }?></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <section id="section05" class="demo">
        <h1
            style="font-family:'Beyond the mountains';font-weight:normal;font-size:85px;padding-top:40px;text-shadow: 2px 2px #FF0000;">
            <span class="tagline">Great food</span><span class="punchline"> Always</span></h1>
        <a href="#about"><span></span></a>
    </section>


    <div class="container" style="height:600px" id="about">
        <div class="second">
            <div class="second-head" data-aos=zoom-out>
                <h1 style="font-family:'Beyond the mountains';font-size:65px;font-weight:bolder">Our Story</h>
            </div>
            <div class="row">
                <div class="col-sm-5" id="second-para" data-aos=zoom-in>
                    <p class="space">
         Savor the world's finest flavors under one roof! From spicy Indian curries to Italian pastas, Japanese sushi, and Mexican tacos, our menu offers something for everyone. Enjoy fresh ingredients, authentic recipes, and a cozy ambiance for an unforgettable dining experience. Come taste the world with us!           </p>
                </div>
                <div class="col-sm-6">
                    <img src="img/desert.jpg" style="height:45%;padding-left:100px;">
                </div>
            </div>
        </div>
    </div>


    <!---------- Start Cuisines---------->

    <div class="container-fluid" style="background:#C0C0C0">


        <div class="second-head" data-aos=zoom-out>
            <h1 style="font-weight:bolder;font-family:'beyond the mountains';font-size:65px">Wide range of cuisines to
                choose from</h>
        </div>
        <div class="row" id="row2">



            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-1">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    Turkish
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-2">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    italian
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-3">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    chinese
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-4">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    korean
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="container-fluid" style="background:#C0C0C0;padding-bottom:30px;">
        <div class="row" id="row2">



            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-5">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    french
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-6">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    mexican
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-7">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    american
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="set1">
                <div class="set-img-8">
                    <div class="set-pic-1">
                        <div class="foodwel" data-aos="fade-right">
                            <div class="foodwelh1">
                                <div class="heading1">
                                    indian
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>




    <!----------End Cuisines---------->
    <footer class="footer-area foo-4">
        <div class="footer-widget-wrap">
            <div class="container">
                <div class="row section-gap">
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h4>Opening Hours</h4>
                            <ul class="hr-list">
                                <li class="d-flex justify-content-between">
                                    <span>Monday - Thursday</span> <span>12:00 pm - 1:00 am</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Saturday</span> <span>12:00 pm - 12:00 am</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Sunday</span> <span>6:00 pm - 2:00 am</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-footer-widget" style="text-align: right;">
                            <h4>Contact Us</h4>
                            <p>
                                Calicut Mukkam Rd,Near NIT Calicut,
Kattangal, Kozhikode, Kerala - 673601.
                            </p>
                            <p class="number" style="text-align: right;">
                               +91-94974 36151<br>
                               +91-62353 77912<br>
                               +91-94461 97063
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bot">
            <p>
                Created with <i class="fa fa-heart"></i> by
                <a target="_blank" href="index.html">Baker's Street</a>
            </p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/scrollbar.js"></script>


    <script>
        AOS.init({
            easing: 'ease-out-back',
            duration: '1200'
        });
    </script>
    <script>
        mybutton = document.getElementByClassName("navbar");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 20) {
                navbar.style.opacity = "0.1";
            } else {
                navbar.style.opacity = "0.85";
            }
        }
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>


    <script>
        ScrollReveal({
            duration: 1000
        })
    </script>

    <script>
        ScrollReveal().reveal('.tagline', {
            delay: 500
        })
        ScrollReveal().reveal('.punchline', {
            delay: 2000
        })
    </script>

    <script>
        // GENERAL SETTING
        window.sr = ScrollReveal({
            reset: true
        });

        // Custom Settings
        sr.reveal('.foo-1', {
            duration: 200
        });

        sr.reveal('.foo-2', {
            origin: 'right',
            duration: 500
        });

        sr.reveal('.foo-3', {
            rotate: {
                x: 100,
                y: 100,
                z: 0
            },
            duration: 1000
        });

        sr.reveal('.foo-4', {
            viewFactor: 0.3
        });

        sr.reveal('.foo-5', {
            duration: 200
        });
    </script>
    <script>
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>


</body>

</html>
