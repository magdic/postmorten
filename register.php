<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include "config/dbconfig.php";

//include out functions file giving us access to the protect() function
include "config/functions.php";

?>
<html>
	<head>
		<title>Register on this Page | My App</title>
		<link rel="stylesheet" type="text/css" href="style.css" />

         <link href="app/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="app/assets/css/font-awesome.min.css" />

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
		<?php
			if($_GET['message'] == 'edeb734ec075b20cd9e995a05888270e'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-success'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                                <p>
                                    <strong><i class='icon-ok'></i></strong>
                                    Account created successfully, please check your email for activation.
                                </p>
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == 'a23e3efffdd987d1ef098e1d25199b38'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  The <b>E-mail</b> address you supplied is already taken
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == '903ad7fca286e13199c0aedb9c5f4081'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  You are <b>NOT member</b> of our company, you must have a company email like that name@thehang.net or name@soup.com!!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == '288a62414db78c24149f396d8e4d6bc2'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  The <b>Password</b> you supplied did not match the confirmation password!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == '08bfefacdbd9b8dc8d8f3f2cba0645e3'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  You need to fill in all of the required filds!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == '6c864db20a09afec2e00ce46feeca264'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                 Your <b>Username</b> must be between 3 and 32 characters long!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == 'b93ba93cb03d581227432da187c629c3'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                 The <b>Username</b> you have chosen is already taken!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			if($_GET['message'] == 'f601b5d64fec441496b4f4899cd5aba4'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                The <b>password</b> must be between 5 and 32 characters long!
                                  <br />
                          </div>
                       </div>
                  </div>";
			}
			// $msg=$_GET['message'];
			// echo '<center>'.$msg.'</center>';
		?>
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                             <div class="center">
                                <h1>
                                    <span class="white">PostMorten</span>
                                </h1>
                                <h4 class="blue">&copy; Hangar</h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="signup-box" class="signup-box widget-box no-border visible">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="icon-group blue"></i>
                                                New User Registration
                                            </h4>

                                            <div class="space-6"></div>
                                            <p> Enter your details to begin: </p>

                                            <form action="controllers/regAction.php" method="post">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" name="email" class="form-control" placeholder="Email" />
                                                            <i class="icon-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="username" class="form-control" placeholder="Username" />
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" />
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="passconf" class="form-control" placeholder="Repeat password" />
                                                            <i class="icon-retweet"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space-24"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="icon-refresh"></i>
                                                            Reset
                                                        </button>

                                                        <input type="submit" name="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                           <!--  Register -->
                                                           <!--  <i class="icon-arrow-right icon-on-right"></i> -->
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="toolbar center">
                                            <a href="index.php" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                <i class="icon-arrow-left"></i>
                                                Back to login
                                            </a>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /signup-box -->
                            </div><!-- /position-relative -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>
