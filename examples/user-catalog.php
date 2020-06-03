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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>
    .searchButton {
      width: 30px !important;
      height: 17px !important;
      background: none !important;
      text-align: center !important;
      border: none;
      color: inherit !important;
      cursor: pointer !important;
    }
  </style>
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
                  echo $_SESSION['firstName'] . " ". $_SESSION['lastName'];
                  ?>
                  </h6>
                </center>
          <li class="active ">
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
          <li>
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
            <a class="navbar-brand" href="#pablo">Library Catalog</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form method="POST">
              <div class="input-group no-border">
                <select name="option" class="form-control">
                  <option value="all" selected hidden> Select.. </option>
                  <option value="ID"> Book ID </option>
                  <option value="Title"> Title </option>
                  <option value="ISBN"> ISBN </option>
                  <option value="Gen"> Genre </option>
                  <option value="Auth"> Author </option>
                  <option value="Pub"> Publisher </option>
                </select>
                <input type="text" style="height: 38px" name="searchInput" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <button type="submit" name="searchButton" class="searchButton"><i class="nc-icon nc-zoom-split"></i></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!-- <h4 class="card-title"> Collection </h4> -->
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Book ID
                      </th>
                      <th>
                        Title
                      </th>
                      <th>
                        ISBN
                      </th>
                      <th>
                        Genre
                      </th>
                      <th>
                        Author
                      </th>
                      <th>
                        Publisher
                      </th>
                    </thead>
                    <tbody>
                      <?php
                      require 'dbConfig.php';
                      if (isset($_POST['searchButton'])) {
                        if ($_POST['searchInput'] == null) {
                          echo '<p align="center" style = "color:red"> No entry placed </p>';
                        } else {
                          if ($_POST['option'] == "all") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookID LIKE '%" . $query . "%') OR (bookTitle LIKE '%" . $query . "%') OR (bookISBN LIKE '%" . $query . "%') OR (bookGen LIKE '%" . $query . "%') OR (bookAuth LIKE '%" . $query . "%') OR (bookPub LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "ID") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookID LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "Title") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookTitle LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "ISBN") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookISBN LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "Gen") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookGen LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "Auth") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookAuth LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                                }
                              }
                            }
                            echo "</tbody></table>";
                          } else if ($_POST['option'] == "Pub") {
                            $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1 = "SELECT * FROM library WHERE (bookPub LIKE '%" . $query . "%')";
                            $result2 = mysqli_query($conn, $query1);
                            if ($result2) {
                              while ($row = mysqli_fetch_array($result2)) {
                                echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                              }
                            }
                            echo "</tbody></table>";
                          }
                        }
                      } else {
                        $query = "SELECT * FROM library";
                        if ($result = mysqli_query($conn, $query)) {
                          while ($row = mysqli_fetch_array($result)) {
                            echo "<tr><td>" . $row['bookID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookISBN'] . "</td><td>" . $row['bookGen'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['bookPub'] . "</td></tr>";
                          }
                        }
                        echo "</tbody></table>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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