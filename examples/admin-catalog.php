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
                  echo $_SESSION['firstName'] . " ". $_SESSION['lastName'];
                  ?>
                  </h6>
        </center>
          <li class="active ">
            <a href="./admin-catalog.php">
              <i class="nc-icon nc-hat-3"></i>
              <p>Library Catalog</p>
            </a>
          </li>
          <li>
            <a href="./admin-borrowsys.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Borrowing System</p>
            </a>
          </li>
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
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <center> <span>
                    <!-- <h4 class="card-title"> Collection </h4> -->
                    <div class="alert-mini alert-success">
                      <a href="#add" style="color: inherit; text-decoration: none;">
                        <b>
                          <center>Add Book</center>
                        </b> </a>
                    </div>
                    <div class="alert-mini alert-warning">
                      <a href="#delete" style="color: inherit; text-decoration: none;">
                        <b>
                          <center>Delete Book</center>
                        </b></a>
                    </div>
                    <div class="alert-mini alert-info">
                      <a href="#EditInfo" style="color: inherit; text-decoration: none;">
                        <b>
                          <center>Edit Book</center>
                        </b></a>
                    </div>
                  </span> </center>
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <a href="#" class="new-item-menu-float">
          <i class="nc-icon nc-icon-lg nc-simple-add icon-float "></i> 
          </a>
          <div class="new-item-menu-label-container">
          <div class="new-item-menu-label-text">Add Book</div>
          </div> -->
      <div id="add" class="overlay">
        <div class="popup">
          <h1> Add Book </h1>
          <a class="close" href="admin-catalog.php">&times;</a>
          <div class="content">
            <form method="POST">
              Book ID <input type="text" class="form-control" name="bookID" required />
              Title <input type="text" class="form-control" name="bookTitle" required />
              ISBN <input type="text" class="form-control" name="bookISBN" required />
              Genre <input type="text" class="form-control" name="bookGen" required />
              Author <input type="text" class="form-control" name="bookAuth" required />
              Publisher <input type="text" class="form-control" name="bookPub" required />
              <center><input type="submit" class="btn btn-md btn-success" name="SubmitAdd" value="Submit" style="width: 200px" /></center>
            </form>
            <?php
            require 'dbConfig.php';
            if (isset($_POST['SubmitAdd'])) {
              $bookID = $_POST['bookID'];
              $bookTitle = $_POST['bookTitle'];
              $bookISBN = $_POST['bookISBN'];
              $bookGen = $_POST['bookGen'];
              $bookAuth = $_POST['bookAuth'];
              $bookPub = $_POST['bookPub'];
              $queryAdd = "INSERT INTO library(bookID, bookTitle, bookISBN, bookGen, bookAuth, bookPub) VALUES('$bookID', '$bookTitle', '$bookISBN', '$bookGen', '$bookAuth', '$bookPub')";
              $resultAdd = mysqli_query($conn, $queryAdd);
              if ($resultAdd) {
                echo '<center> <p style = "color: green">Book was successfully added! </p> </center>';
              } else {
                echo "Oops! Something went wrong";
              }
            }
            ?>
          </div>
        </div>
      </div>
      <div id="popup1">
        <div id="delete" class="overlay">
          <div class="popup">
            <h1> Delete Book </h1>
            <a class="close" href="admin-catalog.php">&times;</a>
            <div class="content">
              <form method="POST">
                Book ID <input type="text" class="form-control" name="bookID" required />
                <center><input type="submit" class="btn btn-md btn-success" name="SubmitDelete" value="Submit" style="width: 200px" /></center>
              </form>
            </div>
            <?php
            require 'dbConfig.php';
            if (isset($_POST['SubmitDelete'])) {
              $bookID = $_POST['bookID'];
              $queryDelete = "DELETE FROM library WHERE bookID = '$bookID'";
              $resultDelete = mysqli_query($conn, $queryDelete);
              if ($resultDelete) {
                echo '<center> <p style = "color: green"> Book was deleted successfully! </p> </center>';
              } else {
                echo '<center> <p style = "color: red"> Oops! Something went wrong </p> </center>';
              }
            }
            ?>
          </div>
        </div>
      </div>
      <div id="popup2">
        <div id="EditInfo" class="overlay">
          <div class="popup">
            <h1> Edit Book </h1>
            <a class="close" href="admin-catalog.php">&times;</a>
            <div class="content">
              <form method="POST">
                <center>
                  <p> Fill out the fields you want to change.
                </center>
                Book ID <input type="text" class="form-control" name="bookID1" />
                <center><input type="submit" class="btn btn-md btn-success" name="ConfirmEdit" value="Submit" style="width: 200px" /></center>
                <?php
                require 'dbConfig.php';
                if (isset($_POST['ConfirmEdit'])) {
                  $bookID = $_POST['bookID1'];
                  $query = "SELECT * FROM library WHERE bookID='$bookID'";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    if ($bookID == $row['bookID']) {
                      $_SESSION['bookID1'] = $bookID;
                      echo '<script type="text/javascript">';
                      echo 'window.location.href="admin-catalog.php#edit" </script>';
                    }
                  } else {
                    echo "<br><p align = 'center'; style = 'color: red'> Oops! Something went wrong. Enter a valid book ID. </p>";
                  }
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="popup3">
        <div id="edit" class="overlay">
          <div class="popup">
            <h1> Edit Book </h1>
            <a class="close" href="admin-catalog.php">&times;</a>
            <div class="content">
              <form method="POST">
                <center>
                  <p> Enter the ID of the book you want to edit the information of.
                </center>
                Book ID <input type="text" class="form-control" name="bookID" />
                Title <input type="text" class="form-control" name="bookTitle" />
                ISBN <input type="text" class="form-control" name="bookISBN" />
                Genre <input type="text" class="form-control" name="bookGen" />
                Author <input type="text" class="form-control" name="bookAuth" />
                Publisher <input type="text" class="form-control" name="bookPub" />
                <center><input type="submit" class="btn btn-md btn-success" name="EditInfo" value="Confirm" style="width: 200px" /></center>
              </form>
            </div>
            <?php
            require 'dbConfig.php';
            if (isset($_POST['EditInfo'])) {
              if ($_POST['EditInfo'] == 'Confirm') {
                if ($_POST['bookID'] == null && $_POST['bookTitle'] == null && $_POST['bookISBN'] == null && $_POST['bookGen'] == null && $_POST['bookAuth'] == null && $_POST['bookPub'] == null) {
                  echo "<center> <p style='color: red'> Please fill out any field to edit. </p> </center>";
                } else {
                  if ($_POST['bookID'] != null) {
                    $ID = $_POST['bookID'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    $validate = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $ID) . "'";
                    $result2 = mysqli_query($conn, $validate);
                    if (mysqli_num_rows($result) > 0) {
                      if (mysqli_num_rows($result2) > 0) {
                        echo "<p align = 'center' style = 'color: red'> Book ID is already taken. </p>";
                      } else {  
                        $edit = "UPDATE library SET bookID = '" . mysqli_real_escape_string($conn, $_POST['bookID']) . "' WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                      if (mysqli_query($conn, $edit)) {
                        echo "<p align = 'center' style = 'color: green'> Book ID successfully changed! </p>";
                      } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                      }
                    }
                  }
                  }
                  else if ($_POST['bookTitle'] != null) {
                    $Title = $_POST['bookTitle'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE library SET bookTitle = '". mysqli_real_escape_string($conn, $Title) . " ' WHERE bookID = '" . mysqli_escape_string($conn, $_SESSION['bookID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Book ID successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['bookISBN'] != null) {
                    $ISBN = $_POST['bookISBN'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE library SET bookISBN = '". mysqli_real_escape_string($conn, $ISBN) . " ' WHERE bookID = '" . mysqli_escape_string($conn, $_SESSION['bookID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Book ISBN successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['bookGen'] != null) {
                    $Gen = $_POST['bookGen'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE library SET bookGen = '". mysqli_real_escape_string($conn, $Gen) . " ' WHERE bookID = '" . mysqli_escape_string($conn, $_SESSION['bookID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Book Genre successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['bookAuth'] != null) {
                    $Auth = $_POST['bookAuth'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE library SET bookAuth = '". mysqli_real_escape_string($conn, $Auth) . " ' WHERE bookID = '" . mysqli_escape_string($conn, $_SESSION['bookID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Book Author successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['bookPub'] != null) {
                    $Pub = $_POST['bookPub'];
                    $select = "SELECT * FROM library WHERE bookID = '" . mysqli_real_escape_string($conn, $_SESSION['bookID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE library SET bookPub = '". mysqli_real_escape_string($conn, $Pub) . " ' WHERE bookID = '" . mysqli_escape_string($conn, $_SESSION['bookID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Book Publisher successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                }
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <footer class="footer footer-black  footer-white ">
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
      </footer> -->
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