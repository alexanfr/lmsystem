<!--
=========================================================
 Paper Dashboard 2 - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard-2
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

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

    .overlay {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.7);
      transition: opacity 500ms;
      visibility: hidden;
      opacity: 0;
    }

    .overlay:target {
      visibility: visible;
      opacity: 1;
    }

    .popup {
      margin: 70px auto;
      padding: 20px;
      background: #fff;
      border-radius: 5px;
      width: 50%;
      position: relative;
      transition: all 5s ease-in-out;
    }

    .popup h2 {
      margin-top: 0;
      color: #333;
      font-family: Tahoma, Arial, sans-serif;
    }

    .popup .close {
      position: absolute;
      top: 20px;
      right: 30px;
      transition: all 200ms;
      font-size: 30px;
      font-weight: bold;
      text-decoration: none;
      color: #333;
    }

    .popup .close:hover {
      color: #06D85F;
    }

    .popup .content {
      max-height: 30%;
      overflow: auto;
    }

    label {
      text-align: right;
      clear: both;
      float: left;
      margin-right: 15px;
    }

    @media screen and (max-width: 700px) {
      .box {
        width: 70%;
      }

      .popup {
        width: 70%;
      }
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
            <a href="./admin-catalog.php">
              <i class="nc-icon nc-hat-3"></i>
              <p>Library Catalog</p>
            </a>
          </li>
          <li class="active ">
            <a href="./admin-borrowsys.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Borrowing System</p>
            </a>
          </li c>
          <li>
            <a href="./admin-accounts.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Accounts</p>
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
            <a class="navbar-brand" href="#pablo">Borrowing System</a>
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
                  <option value="transID"> Transaction # </option>
                  <option value="bookTitle"> Book Title </option>
                  <option value="bookAuth"> Author </option>
                  <option value="borrower"> Issued To </option>
                  <option value="borrowDate"> Borrowed On </option>
                  <option value="dueDate"> Due On </option>
                  <option value="processBy"> Processed By </option>
                  <option value="returnDate"> Returned On </option>
                  <option value="receiveBy"> Received By </option>
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

            <div class="card-body">
              <div class="card">
                <div class="card-header">
                  <center> <span>
                      <!-- <h4 class="card-title"> Collection </h4> -->
                      <div class="alert-mini alert-success">
                        <a href="#checkin" style="color: inherit; text-decoration: none;">
                          <b>
                            <center>Borrow</center>
                          </b> </a>
                      </div>
                      <div class="alert-mini alert-warning">
                        <a href="#checkout" style="color: inherit; text-decoration: none;">
                          <b>
                            <center>Return</center>
                          </b></a>
                      </div>
                      <div class="alert-mini alert-info">
                        <a href="#renew" style="color: inherit; text-decoration: none;">
                          <b>
                            <center>Renew</center>
                          </b></a>
                      </div>
                    </span> </center>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Transaction #
                        </th>
                        <th>
                          Book Title
                        </th>
                        <th>
                          Author
                        </th>
                        <th>
                          Issued To
                        </th>
                        <th>
                          Borrowed On
                        </th>
                        <th>
                          Due On
                        </th>
                        <th>
                          Processed By
                        </th>
                        <th>
                          Returned On
                        </th>
                        <th>
                          Received By
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
                              $query1 = "SELECT * FROM borrowsys WHERE (transID LIKE '%" . $query . "%') OR (bookTitle LIKE '%" . $query . "%') OR (bookAuth LIKE '%" . $query . "%') OR (CONCAT(firstName, ' ', lastName) LIKE '%" . $query . "%') OR (borrowDate LIKE '%" . $query . "%') OR (dueDate LIKE '%" . $query . "%') OR (CONCAT(fName_processBy, ' ', lName_processBy) LIKE '%" . $query . "%') OR (returnDate LIKE '%" . $query . "%') OR (CONCAT(fName_receiveBy, ' ', lName_receiveBy) LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "transID") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (transID LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "bookTitle") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (bookTitle LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "bookAuth") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (bookAuth LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            }else if ($_POST['option'] == "borrower") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (CONCAT(firstName, ' ', lastName) LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "borrowDate") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (borrowDate LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "dueDate") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (dueDate LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                  }
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "processBy") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (processBy LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "returnDate") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (returnDate LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                }
                              }
                              echo "</tbody></table>";
                            } else if ($_POST['option'] == "receiveBy") {
                              $query = mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM borrowsys WHERE (receiveBy LIKE '%" . $query . "%')";
                              $result2 = mysqli_query($conn, $query1);
                              if ($result2) {
                                while ($row = mysqli_fetch_array($result2)) {
                                  echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
                                }
                              }
                              echo "</tbody></table>";
                            }
                          }
                        } else {
                          $query = "SELECT * FROM borrowsys";
                          if ($result = mysqli_query($conn, $query)) {
                            while ($row = mysqli_fetch_array($result)) {
                              echo "<tr><td>" . $row['transID'] . "</td><td>" . $row['bookTitle'] . "</td><td>" . $row['bookAuth'] . "</td><td>" . $row['firstName'] . " " . $row['lastName'] . "</td><td>" . $row['borrowDate'] . "</td><td>" . $row['dueDate'] . "</td><td>" . $row['fName_processBy'] . " " . $row['lName_processBy'] . "</td><td>" . $row['returnDate'] . "</td><td>" . $row['fName_receiveBy'] . " " . $row['lName_receiveBy'] . "</td></tr>";
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
        <div id="checkin" class="overlay">
          <div class="popup">
            <h1> Borrow a Book</h1>
            <a class="close" href="admin-borrowsys.php">&times;</a>
            <div class="content">
              <form method="POST">
                Book ID <input type="number" class="form-control" name="bookID" required />
                Book Title <input type="text" class="form-control" name="bookTitle" required />
                Author <input type="text" class="form-control" name="bookAuth" required />
                <p>
                  <h6>Issued to</h6>
                  School ID <input type="number" class="form-control" name="schoolID" required />
                  First Name <input type="text" class="form-control" name="firstName" required />
                  Last Name <input type="text" class="form-control" name="lastName" required />
                  <!-- Borrowed on <input type="date" class="form-control" name="borrowDate" required /> -->
                  <p>
                    <h6>Processed by </h6>
                    First Name <input type="text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['firstName'] . '" disabled/>';
                    ?>
                    Last Name <input type=" text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['lastName'] . '" disabled/>';
                    ?>
                    Due on <input type="date" class="form-control" name="dueDate" required />
                    <center><input type="submit" class="btn btn-md btn-success" name="SubmitAdd" value="Submit" style="width: 200px" /></center>
                    <?php
                    if (isset($_POST['SubmitAdd'])) {
                      $bookID = $_POST['bookID'];
                      $bookTitle = $_POST['bookTitle'];
                      $bookAuth = $_POST['bookAuth'];
                      $schoolID = $_POST['schoolID'];
                      $firstName = $_POST['firstName'];
                      $lastName = $_POST['lastName'];

                      $fName_processBy = $_SESSION['firstName'];
                      $lName_processBy = $_SESSION['lastName'];
                      $dueDate = $_POST['dueDate'];

                      $querySearch = "SELECT * FROM library WHERE bookID = '$bookID' AND bookTitle='$bookTitle' AND bookAuth='$bookAuth'";
                      $resultSearch = mysqli_query($conn, $querySearch);
                      $querySearch2 = "SELECT * FROM accounts WHERE schoolID = '$schoolID' AND firstName = '$firstName' AND lastName = '$lastName'";
                      $resultSearch2 = mysqli_query($conn, $querySearch2);

                      if (mysqli_num_rows($resultSearch2) > 0) {
                        $search2 = mysqli_fetch_array($resultSearch2);
                        if ($search2['schoolID'] == $schoolID && $search2['accStatus'] == "Active") {
                          if (mysqli_num_rows($resultSearch) > 0) {
                            $search = mysqli_fetch_array($resultSearch);
                            if ($search['bookID'] == $bookID && $search['bookTitle'] == $bookTitle && $search['bookAuth'] == $bookAuth) {
                              if ($fName_processBy != '' && $lName_processBy != '') {
                                $queryAdd = "INSERT INTO borrowsys(bookID, bookTitle, bookAuth, schoolID, firstName, lastName, fName_processBy, lName_processBy, dueDate) VALUES('$bookID', '$bookTitle', '$bookAuth', '$schoolID', '$firstName', '$lastName', '$fName_processBy', '$lName_processBy', '$dueDate')";
                                if ($resultAdd = mysqli_query($conn, $queryAdd)) {
                                  echo '<center> <p style = "color: green">Book was successfully checked in! </p> </center>';
                                } else {
                                  echo "<center> <p style = 'color: red'> Oops! Something went wrong </p> </center>";
                                }
                              } else {
                                echo "<center> <p style = 'color: red'>Oops! Book ID and Book Title do not match</p> </center>";
                              }
                            }
                          } else {
                            echo "<center> <p style = 'color: red'>Oops! Book ID and Book Title do not exist in the Library</p> </center>";
                          }
                        }
                      } else {
                        echo "<center> <p style = 'color: red'>Oops! User does not exist in Accounts </p> </center>";
                      }
                    }
                    ?>
              </form>
            </div>
          </div>
        </div>
      
      <div id="popup1">
        <div id="checkout" class="overlay">
          <div class="popup">
            <h1> Return a Book</h1>
            <a class="close" href="admin-borrowsys.php">&times;</a>
            <div class="content">
              <form method="POST">
                Transaction # <input type="number" class="form-control" name="transID" required />
                  <p>
                    <h6>Received by </h6>
                    First Name <input type="text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['firstName'] . '" disabled/>';
                    ?>
                    Last Name <input type="text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['lastName'] . '" disabled/>';
                    ?>
                    Returned on <input type="text" class="form-control" placeholder ="
                    <?php
                    echo $date=date("Y-m-d");
                    ?> " disabled/>
                    <center><input type="submit" class="btn btn-md btn-success" name="SubmitDelete" value="Submit" style="width: 200px" /></center>
              </form>
              <?php
              if (isset($_POST['SubmitDelete'])) {
                $transID = $_POST['transID'];
                $fName_receiveBy = $_SESSION['firstName'];
                $lName_receiveBy = $_SESSION['lastName'];
                $date = date("Y-m-d");
                $querySearch = "SELECT * FROM borrowsys WHERE transID = '$transID'";
                $resultSearch = mysqli_query($conn, $querySearch);
                

                if(mysqli_num_rows($resultSearch) > 0) {
                  $search = mysqli_fetch_array($resultSearch);
                  if($search['transID'] == $transID) {
                    if($fName_receiveBy != '' && $lName_receiveBy != '') {
                      $queryUpdate = "UPDATE borrowsys SET fName_receiveBy = '$fName_receiveBy', lName_receiveBy = '$lName_receiveBy', returnDate = '$date' WHERE transID = '$transID'";
                      if($resultUpdate = mysqli_query($conn, $queryUpdate)) {
                      echo '<center> <p style = "color: green">Book was successfully checked out! </p> </center>'; 
                    } else {
                      echo "<center> <p style = 'color: red'> Oops! Something went wrong </p> </center>";
                    }
                  }
                } 
                }
                else {
                  echo "<center> <p style = 'color: red'> Oops! Transaction does not exist. </p> </center>";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div id="popup2">
        <div id="renew" class="overlay">
          <div class="popup">
            <h1> Renew </h1>
            <a class="close" href="admin-borrowsys.php">&times;</a>
            <div class="content">
              <form method="POST">
                Transaction # <input type="number" class="form-control" name="transID" required />
                  <p>
                    <h6>Processed by </h6>
                    First Name <input type="text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['firstName'] . '" disabled/>';
                    ?>
                    Last Name <input type="text" class="form-control" placeholder="
                    <?php
                    echo $_SESSION['lastName'] . '" disabled/>';
                    ?>
                    Due on <input type="date" class="form-control" name="dueDate" required />
                    <center><input type="submit" class="btn btn-md btn-success" name="SubmitRenew" value="Submit" style="width: 200px" /></center>
              </form>
              <?php
              if (isset($_POST['SubmitRenew'])) {
                $transID = $_POST['transID'];
                $fName_processBy = $_SESSION['firstName'];
                $lName_processBy = $_SESSION['lastName'];
                $dueDate = $_POST['dueDate'];

                $querySearch = "SELECT * FROM borrowsys WHERE transID = '$transID'";
                $resultSearch = mysqli_query($conn, $querySearch);

                if(mysqli_num_rows($resultSearch) > 0) {
                  $search = mysqli_fetch_array($resultSearch);
                  if($search['transID'] == $transID) {
                    if($fName_processBy != '' && $lName_processBy != '') {
                      $queryUpdate = "UPDATE borrowsys SET fName_processBy = '$fName_processBy', lName_processBy = '$lName_processBy', dueDate = '$dueDate' WHERE transID = '$transID'";
                      if($resultUpdate = mysqli_query($conn, $queryUpdate)) {
                      echo '<center> <p style = "color: green">Transaction was successfully renewed! </p> </center>'; 
                    } else {
                      echo "<center> <p style = 'color: red'> Oops! Something went wrong </p> </center>";
                    }
                  }
                } 
                }
                else {
                  echo "<center> <p style = 'color: red'> Oops! Transaction does not exist. </p> </center>";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
        <footer class="footer footer-black  footer-white ">
          <div class="container-fluid">
            <div class="row">
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