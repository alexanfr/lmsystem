<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo-small.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Library Management System
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />

    <style>
    .background {
      background-image: url("../assets/img/bg.jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }
    .row {
      margin-right: 0 !important;
      margin-left: 0 !important;
    }
    </style>
</head>

<body class = "background">
    <br>
    <br>
    <div class="logo">
        <class="simple-text logo-mini">
            <div class="logo-image-small">
                <center> <img src="../assets/img/logo-small.png">
                    <h5> Library Management System </h5>
                </center>
            </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card card-account">
                <div class="card-body">
                    <form class="form-signin" method="POST">
                        <center>
                            <h5>Password Recovery</h5>
                        </center>
                        <input type="text" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" />
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit" name="Submit">
                        <div align="center"> <a href="index.php">Back to Login</a> </div>
                        <?php
                        require 'dbConfig.php';
                        if (isset($_POST['Submit'])) {
                            $newpass = rand(999, 999);
                            $newpasshash = md5($newpass);

                            $emailTo = $_POST['email'];
                            $email = $_POST['email'];
                            $query = "SELECT * FROM accounts WHERE email = '$email'";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $queryUpdate = "UPDATE accounts SET pword='$newpasshash' WHERE email='$email'";
                                $resultUpdate = mysqli_query($conn, $queryUpdate);
                            } else {
                                echo '<center> <p style = "color: red"> There is no user registered with this Email Address</p> </center>';
                            }

                            if ($resultUpdate) {
                                $subject = "Reset Password";
                                $body = "In order for you to access your account, login using this temporary password " . $newpass . ". After login, please immediately change your password in the Accounts page.";
                                $headers =  'MIME-Version: 1.0' . "\r\n"; 
                                $headers .= 'From: Library Management System <demo@domain.com> . "\r\n"';
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                                if ($_POST['email'] != null) {

                                    if (mail($emailTo, $subject, $body, $headers)) {
                                        $success = "<p align='center'><font color = '#177a03'>Please check your email for further instructions</font></p>";
                                    } else {
                                        $error = "<p align='center'><font color = '#fc1616'>Email was not sent</font></p>";
                                    }
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>