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
              <h5>Account login</h5>
            </center>
            <input type="text" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" />
            <input type="password" class="form-control" name="pword" placeholder="Password" required="" />
            <select class="form-control" name="rolee">
              <option value=""> Select.. </option>
              <option value="Admin"> Admin </option>
              <option value="User"> User </option>
            </select>
            <input type="submit" class="btn btn-lg btn-success btn-block" name="Login" value="Login" />
            <div align="center"> <a href="password.php">Forgot Password?</a> </div>
            <?php
            require 'dbConfig.php';
            if (isset($_POST['Login'])) {
              $email = $_POST['email'];
              $pword = md5($_POST['pword']);
              $rolee = $_POST['rolee'];
              $query = "SELECT * FROM accounts WHERE email='" . $email . "' AND pword='" . $pword . "'
                  AND rolee='" . $rolee . "'";
              $result = mysqli_query($conn, $query);
              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                if ($row['rolee'] == "Admin" && $row['accStatus'] == "Active") {
                    $_SESSION['email'] = $email;
                    $_SESSION['pword'] = $pword;
                    $_SESSION['rolee'] = $rolee;
                    $_SESSION['accStatus'] = $row['accStatus'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['schoolID'] = $row['schoolID'];
                    echo '<script type="text/javascript">';
                    echo 'window.location.href="admin-catalog.php" </script>';
                } else if ($row['rolee'] == "User" && $row['accStatus'] == "Active") {
                    $_SESSION['email'] = $email;
                    $_SESSION['pword'] = $pword;
                    $_SESSION['rolee'] = $rolee;
                    $_SESSION['accStatus'] = $row['accStatus'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['schoolID'] = $row['schoolID'];
                    echo '<script type="text/javascript">';
                    echo 'window.location.href="user-catalog.php" </script>';
                } else {
                  echo '<center> <p style = "color: red"> Your account was deactivated. Please contact your administrator. </p> </center>';
                }
              } else {
                echo '<center> <p style = "color: red"> Please enter your correct login credentials. </p> </center>';
              }
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>