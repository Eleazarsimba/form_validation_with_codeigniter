<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Homepage</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" />

	<style type="text/css">
            * {
                box-sizing: border-box !important;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                color: #666666;
                font-size: 14px;
                font-family: 'Poppins', sans-serif;
                line-height: 1.80857;
                font-weight: normal;
            }

            a {
                color: #1f1f1f;
                text-decoration: none !important;
                outline: none !important;
                -webkit-transition: all .3s ease-in-out;
                -moz-transition: all .3s ease-in-out;
                -ms-transition: all .3s ease-in-out;
                -o-transition: all .3s ease-in-out;
                transition: all .3s ease-in-out;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                letter-spacing: 0;
                font-weight: normal;
                position: relative;
                padding: 0 0 10px 0;
                font-weight: normal;
                line-height: normal;
                color: #111111;
                margin: 0
            }

            h1 {
                font-size: 24px;
                font-family: 'Baloo Chettan', cursive;
            }

            h2 {
                font-size: 22px;
                font-family: 'Baloo Chettan', cursive;
            }

            h3 {
                font-size: 18px;
                font-family: 'Baloo Chettan', cursive;
            }

            h4 {
                font-size: 16px
            }

            h5 {
                font-size: 14px
            }

            h6 {
                font-size: 13px
            }

            *,
            *::after,
            *::before {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            h1 a,
            h2 a,
            h3 a,
            h4 a,
            h5 a,
            h6 a {
                color: #212121;
                text-decoration: none!important;
                opacity: 1
            }

            button:focus {
                outline: none;
            }

            ul,
            li,
            ol {
                margin: 0px;
                padding: 0px;
                list-style: none;
            }

            p {
                margin: 0px;
                font-weight: 300;
                font-size: 15px;
                line-height: 24px;
            }

            a {
                color: #222222;
                text-decoration: none;
                outline: none !important;
            }

            a,
            .btn {
                text-decoration: none !important;
                outline: none !important;
                -webkit-transition: all .3s ease-in-out;
                -moz-transition: all .3s ease-in-out;
                -ms-transition: all .3s ease-in-out;
                -o-transition: all .3s ease-in-out;
                transition: all .3s ease-in-out;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            :focus {
                outline: 0;
            }

            .form-control:focus {
                border-color: #ffffff !important;
                box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .25);
            }

            .navbar-form input {
                border: none !important;
            }

            button {
                border: 0;
                margin: 0;
                padding: 0;
                cursor: pointer;
            }

            .full {
                float: left;
                width: 100%;
            }

            .full {
                width: 100%;
                float: left;
                margin: 0;
                padding: 0;
            }



            /*-- navigation--*/

            .navigation.navbar {
                float: right;
                padding-top: 12px;
                position: relative;
            }

            .navigation.navbar-dark .navbar-nav .nav-link {
                padding: 0 25px;
                color: #fff;
                font-size: 16px;
                line-height: 20px;
                text-transform: uppercase;
            }

            .navigation.navbar-dark .navbar-nav .nav-link:focus,
            .navigation.navbar-dark .navbar-nav .nav-link:hover {
                color: #000;
            }

            .navigation.navbar-dark .navbar-nav .active>.nav-link,
            .navigation.navbar-dark .navbar-nav .nav-link.active,
            .navigation.navbar-dark .navbar-nav .nav-link.show,
            .navigation.navbar-dark .navbar-nav .show>.nav-link {
                color: #fdd430;
            }

            .navbar-expand-md .navbar-nav {
                padding-right: 10px;
            }

            .sign_btn a {
                background-color: #2d2c2c;
                display: inline-block;
                padding: 7px 35px;
                border-radius: 30px;
                color: #fff;
                font-size: 17px;
            }

            .sign_btn a:hover {
                color: #0aec98;
            }


            /*-- header area --*/


            /*--------------------------------------------------------------------- top banner area ---------------------------------------------------------------------*/


            /*--------------------------------------------------------------------- layout new css ---------------------------------------------------------------------*/

            .header {
                width: 100%;
                background: transparent;
                padding: 30px 30px;
            }

            .logo a {
                font-size: 40px;
                font-weight: bold;
                text-transform: uppercase;
                color: #fff;
                line-height: 40px;
            }

            .titlepage {
                text-align: center;
                padding-bottom: 60px;
            }

            .titlepage h2 {
                font-size: 50px;
                color: #3e3e3e;
                line-height: 50px;
                font-weight: bold;
                padding: 0;
            }
            .nav-item a {
                color:#666666;
            }

            /** best section **/

            .best {
                background: #fff;
                margin-top: 90px;
                border-radius: 20px;
            }

            .best .titlepage h2 {
                color: #fff;
                margin-bottom: 20px;
            }

            .best .titlepage span {
                font-size: 17px;
                line-height: 28px;
            }

            .best_box {
                text-align: center;
                background-color: #2bcc91;
                border-radius: 20px;
                padding: 30px 20px;
                margin-bottom: 30px;
            }

            .best_box h4 {
                color: #fff;
                text-transform: uppercase;
                font-size: 25px;
                line-height: 40px;
                font-weight: 500;
                padding: 0;
            }

            .best_box p {
                color: #fff;
                font-size: 17px;
                line-height: 28px;
                padding-top: 25px;
            }

            .best {
                margin: 0 auto;
                display: block;
                background-color: #000;
                color: #fff;
            }

            /** end best section **/


            /** request section **/
            .request .titlepage h2 {
                margin-bottom: 20px;
                padding-bottom: 10px
            }

            .request .titlepage span {
                font-size: 17px;
                line-height: 28px;
            }

            .request {
                padding-top: 90px;
            }

            .main_form {
                padding: 10px;
            }

            .black_bg {
                background-color: #2c363d;
            }

            .request .main_form .contactus {
                border: inherit;
                padding: 0px 19px;
                margin-bottom: 20px;
                width: 100%;
                height: 60px;
                background: #fff;
                color: #353535;
                font-size: 17px;
                border-radius: 15px;
            }

            .request .main_form .textarea {
                border: inherit;
                padding: 0px 19px;
                margin-bottom: 20px;
                width: 100%;
                height: 140px;
                background: #fff;
                color: #353535;
                font-size: 17px;
                border-radius: 15px;
                padding-top: 51px;
            }

            .request .main_form .send_btn {
                font-size: 17px;
                transition: ease-in all 0.5s;
                background-color: #000;
                color: #fff;
                padding: 13px 0px;
                margin: 0 auto;
                /* max-width: 200px; */
                width: 100%;
                display: block;
                margin-top: 30px;
                border-radius: 15px;
            }

            .request .main_form .send_btn:hover {
                background-color: #2bcc91;
                transition: ease-in all 0.5s;
                color: #fff;
                border-radius: 26px;
            }

            #request *::placeholder {
                color: #353535;
                opacity: 1;
            }
            @media screen and (min-width: 770px) {
                .mane_img figure {
                    margin: 0;
                }

                .mane_img figure img {
                    width: 100%;
                }
            }
            @media screen and (max-width: 770px) {
                .mane_img figure {
                    display: none;
                }
            }


            /** end request section **/



            /** footer **/
            .footer {
                border-top: #000 solid 1px;
                font-family: Poppins;
                background: #fff;
                padding-top: 50px;
            }

            .copyright {
                margin-top: 43px;
                padding: 20px 0px;
                background-color: #23262d;
            }

            .copyright p {
                color: #fff;
                font-size: 18px;
                line-height: 22px;
                text-align: center;
            }
 
	</style>
</head>
<body>
<body class="main-layout">
   <div id="home" class="home">
    
          <!-- header inner -->
             <div class="header">
                <div class="container">
                   <div class="row">
                      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col logo_section">
                         <div class="full">
                            <div class="center-desk">
                               <div class="logo">
                                  <a href="/"><img src="<?php echo base_url("assets/logo.png"); ?>" alt="#" /></a>
                               </div>
                            </div>
                         </div>
                      </div>
                         <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6">
                         <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <div id="navbarsExample04">
                               <div class="sign_btn"><a href="<?php echo base_url()?>home/signin">Sign in</a></div>
                            </div>
                         </nav>
                      </div>
                   </div>
                </div>
            
             <!-- end header inner -->

       <!-- best -->
       <div id="" class="best">
          <div class="container">
             <div class="row">
                <div class="col-md-12">
                   <div class="titlepage">
                      <h2>Build With Best </h2>
                      <span>Check our shop for best offers</span>
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-4">
                   <div class="best_box">
                      <h4>500GB <br>Micro SD Card</h4>
                      <p>6 Months warranty available</p>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="best_box">
                      <h4>100GB <br> Internal Ram</h4>
                      <p>6 Months warranty available</p>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="best_box">
                      <h4>100% <br> High Quality</h4>
                      <p>Additional 1 Months warranty for all products</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- end best -->

       <!-- request -->
       <div id="request" class="request">
          <div class="container">
             <div class="row">
                <div class="col-md-12">
                   <div class="titlepage">
                      <h2>Give your complain or testimonial</h2>
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-sm-12">
                   <div class="black_bg">
                      <div class="row">
                         <div class="col-md-7 ">
                            <form class="main_form">
                               <div class="row">
                                  <div class="col-md-12 ">
                                     <input class="contactus" placeholder="Name" type="text" name="Name">
                                  </div>
                                  <div class="col-md-12">
                                     <input class="contactus" placeholder="Phone number" type="text" name=" Phone number">
                                  </div>
                                  <div class="col-md-12">
                                     <input class="contactus" placeholder="Email" type="text" name="Email">
                                  </div>
                                  <div class="col-md-12">
                                     <textarea class="textarea" placeholder="Message" type="text" name="Message "> Message </textarea>
                                  </div>
                                  <div class="col-sm-12">
                                     <button class="send_btn">Send</button>
                                  </div>
                               </div>
                            </form>
                         </div>
                         <div class="col-md-5">
                            <div class="mane_img">
                               <figure><img src="<?php echo base_url("assets/mane_img.jpg"); ?>" alt="#"/></figure>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- end request -->
      
       <!--  footer -->
       <footer>
          <div class="footer">
             <div class="copyright">
                <div class="container">
                   <div class="row">
                      <div class="col-md-12">
                         <p>© 2019 All Rights Reserved.</p>
                      </div>
                   </div>
                </div>
             </div>
          </div>

</body>
</html>