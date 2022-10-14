<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create an account</title>

	<style type="text/css">
        @media screen and (min-width: 800px) {
            #container {
                margin: 5px 150px 0px 150px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        }
        @media screen and (max-width: 800px) {
            #container {
                margin: 2px 20px 0px 20px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        * {
            box-sizing: border-box
        }

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 5px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: #fff;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity:1;
        }
        /* Float cancel and signup buttons and add an equal width */
        .signupbtn {
            float: left;
            width: 50%;
        }

        /* Add padding to container elements */
        .container {
            padding: 16px;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {
        .signupbtn {
            width: 100%;
        }
        }

        /*arterisk for required*/ 
        .inputrequired:after {
            content:"*";
            color: #ff0000;
        }
        /*style error box */
        .error-infor{
            color: #ff0000;
            font-size: 12px;
        }
	</style>
</head>
<body>

<div id="container">
    <form method="post" action="<?php echo base_url()?>home/register_user" style="border:1px solid #ccc">
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email" class="inputrequired"><b>Email </b></label>
        <input type="text" placeholder="Enter Email" name="email">
        <span class="text-danger error-infor"><?php echo form_error("email"); ?></span>

        <label for="f_name" class="inputrequired"><b>First Name </b></label>
        <input type="text" placeholder="Enter First Name" name="f_name">
        <span class="text-danger error-infor"><?php echo form_error("f_name"); ?></span>

        <label for="l_name" class="inputrequired"><b>Last Name </b></label>
        <input type="text" placeholder="Enter Last Name" name="l_name">
        <span class="text-danger error-infor"><?php echo form_error("l_name"); ?></span>

        <label for="psw" class="inputrequired"><b>Password </b></label>
        <input type="password" placeholder="Enter Password" name="psw">
        <span class="text-danger error-infor"><?php echo form_error("psw"); ?></span>

        <label for="psw2" class="inputrequired"><b>Confirm Password </b></label>
        <input type="password" placeholder="Confirm Password" name="psw2">
        <span class="text-danger error-infor"><?php echo form_error("psw2"); ?></span>
        
        <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>
        
        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
        <p>Already have an account, <a href="<?php echo base_url()?>home/signin" style="color:dodgerblue">LOGIN </a></p>
    </div>
    </form>
</div>

</body>
</html>