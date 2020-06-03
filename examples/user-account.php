<?php
session_start();
if ($_SESSION['lastName'] == null && $_SESSION['firstName'] == null) {
  header("Cache-Control: no-cache, must-revalidate");
  echo '<script type="text/javascript">';
  echo 'window.location.href="index.php" </script>';
} else {
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
  </head>

  <body class="">
    <div class="wrapper ">
      <div class="sidebar" data-color="white" data-active-color="danger">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
        -->
        <div class="logo">
          <class="simple-text logo-mini">
            <div class="logo-image-small">
              <center> <img src="../assets/img/logo-small.png">
                <br>Library Management System </center>
            </div>
            </a>
            <class="simple-text logo-normal">
              <!-- <div class="logo-image-big">
                <img src="../assets/img/logo-big.png">
              </div> -->
              </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <center>
              Currently logged in as:
              <h6>
                <?php
                echo $_SESSION['firstName'] . " " . $_SESSION['lastName'];
                ?>
              </h6>
            </center>
            <li>
              <a href="./user-catalog.php">
                <i class="nc-icon nc-hat-3"></i>
                <p>Library Catalog</p>
              </a>
            </li>
            <li>
              <a href="./user-borrowsys.php">
                <i class="nc-icon nc-book-bookmark"></i>
                <p>Borrowing System</p>
              </a>
            </li>
            <li class="active ">
              <a href="./user-account.php">
                <i class="nc-icon nc-single-02"></i>
                <p>Account</p>
              </a>
            </li>
            <li>
              <a href="./logout.php">
                <i class="nc-icon nc-tap-01"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="#pablo">My Account</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
            </div>
          </div>
        </nav>

        <div class="content">
          <div class="card card-user">
            <div class="card-header">
              <h5 class="card-title">Edit Profile</h5>
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="row">
                  <div class="col-md-3 pr-1">
                    <div class="form-group">
                      <label>Student/Faculty Number</label>
                      <input type="number" class="form-control" name="bookID" placeholder="
                      <?php
                      echo $_SESSION['schoolID'] . '" disabled>';
                      ?>
                    </div>
                  </div>
                  <div class=" col-md-3 px-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="
                      <?php
                      echo $_SESSION['firstName'] . '" disabled>';
                      ?>
                    </div>
                  </div>
                  <div class=" col-md-3 pl-1">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="email" class="form-control" name="lastName" placeholder="
                      <?php
                      echo $_SESSION['lastName'] . '" disabled>';
                      ?>
                    </div>
                  </div>
                </div>
                <div class=" row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email">
                              <?php
                              require 'dbConfig.php';
                              if (isset($_POST['Update'])) {
                                $schoolID = $_SESSION['schoolID'];
                                $email = $_POST['email'];
                                $query =  "UPDATE accounts SET email='$email' WHERE schoolID='$schoolID'";
                                if (mysqli_query($conn, $query)) {
                                  echo "<p align = 'center' style = 'color: green'> Email successfully changed! </p>";
                                }
                              }
                              ?>
                            </div>
                          </div>
                          <div class="col-md-3 pl-1">
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" name="pword">
                            </div>
                          </div>
                          <div class="col-md-3 pl-1">
                              <div class="form-group">
                              <label> Confirm Password</label>
                              <input type="password" class="form-control" name="confirm">
                              <?php
                              require 'dbConfig.php';
                              if (isset($_POST['Update'])) {
                                $schoolID = $_SESSION['schoolID'];
                                $pword = md5($_POST['pword']);
                                $confirm = md5($_POST['confirm']);
                                if ($pword == $confirm) {
                                  $query =  "UPDATE accounts SET pword='$pword' WHERE schoolID='$schoolID'";
                                  if (mysqli_query($conn, $query)) {
                                    echo "<p align = 'center' style = 'color: green'> Password successfully changed! </p>";
                                  }
                                }
                                else {
                                  echo "<p align = 'center' style = 'color: red'> Passwords do not match </p>";
                                }
                              }
                              ?>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Role</label>
                              <input type="text" class="form-control" placeholder="
                      <?php
                      echo $_SESSION['rolee'] . '" disabled>';
                      ?>
                    </div>
                  </div>
                  <div class=" col-md-4 px-1">
                              <div class="form-group">
                                <label>Account Status</label>
                                <input type="text" class="form-control" placeholder="
                      <?php
                      echo $_SESSION['accStatus'] . '" disabled>';
                      ?>
                    </div>
                  </div>
                </div>
                <div class=" row">
                                <div class="update ml-auto mr-auto">
                                  <button type="submit" name="Update" class="btn btn-primary btn-round">Update Profile</button>
                                </div>
                              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
  </body>

  </html>
<?php
}
?>