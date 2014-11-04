<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('config/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "config/functions.php";

?>
<html>
  <head>
    <title>Forgot Password | Postmorten App</title>
    <link rel="stylesheet" type="text/css" href="style.css" />

        <link href="app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="app/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="app/assets/css/main.css">

        <!-- fonts -->

        <link rel="stylesheet" href="app/assets/css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="app/assets/css/ace.min.css" />
        <link rel="stylesheet" href="app/assets/css/ace-rtl.min.css" />

         <!-- ace js -->
        <script src='app/assets/js/jquery-2.0.3.min.js'></script>
        <script src="app/assets/js/bootstrap.min.js"></script>
        <script src="app/assets/js/typeahead-bs2.min.js"></script>

  </head>
      <body class="login-layout">


        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                             <div class="center">
                                <h1>
                                    <span class="white">PostMorten</span>
                                </h1>
                                <h4 class="form-logo centered"></h4>
                            </div>

                            <div class="space-6"></div>

                           <div class="position-relative">
                                <div id="forgot-box" class="forgot-box widget-box no-border visible">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="icon-key"></i>
                                                Retrieve Password
                                            </h4>
                                            <div class="space-6"></div>
                                            <p>
                                                Enter your email and to receive instructions
                                            </p>
                                            <form action="forgot.php" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" name="email" class="form-control" placeholder="Email" />
                                                            <i class="icon-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <input name="submit" type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                                                           <!--  <i class="icon-lightbulb"></i>
                                                            Send Me! -->
                                                    </div>
                                                </fieldset>
                                            </form>
                                            <?php


    // Include the Autoloader
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;

    //Check to see if the forms submitted
    if($_POST['submit']){
      //if it is continue checks

      // Create error array
      // Errors we catch will be added to this array
      $error = array();

      //store the posted email to variable after protection
      $email = protect($_POST['email']);

      //check if the email box was not filled in
      if(!$email){
        //if it wasn't display error message

                echo    "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-warning'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   You need to fill in your <b>E-mail</b> address!
                                       <br />
                               </div>
                            </div>
                        </div>";
      }else{
        //else continue checking

        //set the format to check the email against
        $checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";

        //check if the email doesnt match the required format
              if(!preg_match($checkemail, $email)){
                //if not then display error message

                    echo "<div class='row'>
                            <div class='col-sm-6 col-sm-offset-3'>
                               <div class='alert alert-warning'>
                                   <button type='button' class='close' data-dismiss='alert'>
                                       <i class='icon-remove'></i>
                                   </button>
                                   <strong>
                                        <i class='icon-remove'></i>

                                   </strong>
                                   <b>E-mail</b> is not valid, must be name@server.tld!
                                       <br />
                               </div>
                            </div>
                        </div>";
              }else{
                //otherwise continue checking

                //select all rows from the database where the emails match
                $res = mysql_query("SELECT * FROM `users` WHERE `email` = '".$email."'");
                $num = mysql_num_rows($res);

                //check if the number of row matched is equal to 0
                if($num == 0){
                  //if it is display error message

                            echo "<div class='row'>
                                    <div class='col-sm-6 col-sm-offset-3'>
                                       <div class='alert alert-warning'>
                                           <button type='button' class='close' data-dismiss='alert'>
                                               <i class='icon-remove'></i>
                                           </button>
                                           <strong>
                                                <i class='icon-remove'></i>

                                           </strong>
                                           The <b>E-mail</b> you supplied does not exist in our database!
                                               <br />
                                       </div>
                                    </div>
                                </div>";
          }else{
            //otherwise complete forgot pass function

            //split the row into an associative array
            $row = mysql_fetch_assoc($res);

            $pass = $row['password'];

            $username = $row['username'];

            // $temp_key = date('r',time()); 

            $requestedTime = time();

            $encrypted_key = md5($requestedTime);

            mysql_query('UPDATE users SET psswrdTime = "'.$requestedTime.'", token = "'.$encrypted_key.'" WHERE  email = "'.$email.'"');


                // Check to make sure a name was entered
                if($email == ""){
                    $error[] = "Please enter an Email.";
                }

                // Check to make sure the email is valid
                if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error[] = "Please enter a valid email address.";
                }

                // If there are no errors, send the email
                // Else, output the errors and don't send the email
                if ( ! $error) {

                    // Instantiate the client
                    // You can create a free account and get your own API key here: http://www.mailgun.com/
                    $mgClient = new Mailgun('key-23bbe53903e531c713c72ea6d71421f6');
                    $domain = "sandboxb660f7be4ebe4a3690536a76acbce6b6.mailgun.org";

                    // Make the call to the client to send email.
                    $result = $mgClient->sendMessage("$domain",
                                          array(
                                                'from'    => "No Reply <no-reply@postmortem-hngr.com>",
                                                'to'      => "<$email>",
                                                'subject' => 'Forgotten Password on Postmortem',
                                                'html'    => "<html><p>Here is your temporary password: ".$temp_key."\n\nPlease try to change it inmediatly! http://localhost:8888/phpcodes/postmorten/resetpass/?user=".$username."&&token=".$encrypted_key."</p></html>"));
                } else {
                    // Output any errors
                    foreach ($error as $line) {
                        echo "<p class='error'>$line</p>";
                    }
                }

            //send email containing their password to their email address
            // mail($email, 'Forgotten Password at Postmorten App', "Here is your temporary password: ".$temp_key."\n\nPlease try to change it inmediatly! https://postmortem-hngr.rhcloud.com/resetpass/?user=".$username."&&token=".$encrypted_key."", 'From: noreply@postmorten-hangar.cr');

            //display success message

                        echo    "<div class='row'>
                                    <div class='col-sm-6 col-sm-offset-3'>
                                       <div class='alert alert-block alert-success'>
                                           <button type='button' class='close' data-dismiss='alert'>
                                               <i class='icon-remove'></i>
                                           </button>
                                            <p>
                                                <strong><i class='icon-ok'></i>Got it!</strong>
                                                An email has been sent too your email address containing your password!
                                            </p>
                                            <p>
                                                <a href='index.php' class='btn btn-sm btn-success'>Go back</a>
                                            </p>
                                       </div>
                                    </div>
                                </div>";
          }
        }
      }
    }

    ?>
                                        </div><!-- /widget-main -->
                                        <div class="toolbar center">
                                            <a href="index.php" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                Back to login
                                                <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div> <!-- forgot-box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>

