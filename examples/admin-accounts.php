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
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
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
      float:left;
      margin-right:15px;
  }
    
    @media screen and (max-width: 700px){
      .box{
        width: 70%;
      }
      .popup{
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
              <li>
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
              <li class="active">
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
            <a class="navbar-brand" href="#pablo">Accounts</a>
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
                  <option value="schoolID"> School ID </option>
                  <option value="firstName"> First Name </option>
                  <option value="lastName"> Last Name </option>
                  <option value="membType"> Membership </option>
                  <option value="accStatus"> Account Status </option>
                </select>
                <input type="text" style="height: 38px" name="searchInput" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                  <button type = "submit" name = "searchButton" class="searchButton"><i class="nc-icon nc-zoom-split"></i></button>
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
                <center> <span>
                  <!-- <h4 class="card-title"> Collection </h4> -->
                  <div class="alert-mini alert-success">
                    <a href="#activateAccount" style="color: inherit; text-decoration: none;">
                    <b><center>Activate</center></b> </a>
                  </div>
                  <div class="alert-mini alert-warning" style =  "background-color: #ff6961">
                    <a href="#deactivateAccount" style="color: inherit; text-decoration: none;">
                      <b><center>Deactivate</center></b></a>
                    </div>
                  <div class="alert-mini alert-warning">
                    <a href="#addAccount" style="color: inherit; text-decoration: none;">
                    <b><center>Add Account</center></b> </a>
                  </div>
                  <div class="alert-mini alert-info">
                    <a href="#editAccount" style="color: inherit; text-decoration: none;">
                      <b><center>Edit Account Info</center></b></a>
                    </div> 
                  </span> </center>
                  <div id = "addAccount" class="overlay" >
                  <div class="popup">
                  <h1> Add Account </h1>
                  <a class="close" href="admin-accounts.php">&times;</a>
                  <div class="content">
                    <form method="POST">
                    School ID  <input type="text" class="form-control" name="schoolID" required/>
                    First Name <input type="text" class="form-control" name="firstName" required/>
                    Last Name <input type="text" class="form-control" name="lastName" required/>
                    Email <input type="text" class="form-control" name="email" required/>
                    Password <input type="password" class="form-control" name="pword" required/>
                    Confirm Password <input type="password" class="form-control" name="confirm" required/>
                    Role <select class = "form-control" name="rolee">
                      <option value = ""> Select.. </option>
                      <option value="Admin"> Admin </option>
                      <option value="User"> User </option>
                    </select>
                    Account Status <select class = "form-control" name="accStatus">
                      <option value = ""> Select.. </option>
                      <option value="Active"> Active </option>
                      <option value="Inactive"> Inactive </option>
                    </select>
                    <center><input type ="submit" class="btn btn-md btn-success" name="SubmitAdd" value="Submit" style="width: 200px"/></center>
                    </form>
                    <?php
                    require 'dbConfig.php';
                    if(isset($_POST['SubmitAdd'])) {
                      $schoolID = $_POST['schoolID'];
                      $firstName = $_POST['firstName'];
                      $lastName = $_POST['lastName'];
                      $email = $_POST['email'];
                      $pword = md5($_POST['pword']);
                      $confirm = md5($_POST['confirm']);
                      $rolee = $_POST['rolee'];
                      $accStatus = $_POST['accStatus'];

                      if($pword == $confirm) {
                      $queryAdd= "INSERT INTO accounts(schoolID, firstName, lastName, email, pword, rolee, accStatus) VALUES('$schoolID', '$firstName', '$lastName', '$email', '$pword', '$rolee', '$accStatus')";
                      $resultAdd=mysqli_query($conn, $queryAdd);
                      if($resultAdd) {
                      echo '<center> <p style = "color: green">Account was successfully added! </p> </center>';
                      }
                      else {
                        echo "Oops! Something went wrong";
                      }
                    } else {
                        echo '<center> <p style = "color: red"> Passwords do no match </p> </center>';
                    }
                  }
                    ?>
                  </div>
                </div> 
              </div>
            <div id = "popup1">
            <div id = "activateAccount" class="overlay" >
            <div class="popup">
              <h1> Activate Account </h1>
              <a class="close" href="admin-accounts.php">&times;</a>
              <div class="content">
                <form method="POST">
                 School ID  <input type="text" class="form-control" name="schoolID" required/>
                 <center><input type ="submit" class="btn btn-md btn-success" name="SubmitActivate" value="Submit" style="width: 200px"/></center>
                </form>
              </div>
              <?php
                require 'dbConfig.php';
                if(isset($_POST['SubmitActivate'])) {
                  $schoolID=$_POST['schoolID'];
                  $queryActivate="UPDATE accounts SET accStatus = 'Active' WHERE schoolID = '$schoolID'";
                  $resultActivate = mysqli_query($conn, $queryActivate);
                  if($resultActivate){
                    echo '<center> <p style = "color: green"> Account was successfully activated! </p> </center>';
                  } else {
                    echo '<center> <p style = "color: red"> Oops! Something went wrong </p> </center>';
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <div id = "popup2">
            <div id = "deactivateAccount" class="overlay" >
            <div class="popup">
              <h1> Deactivate Account </h1>
              <a class="close" href="admin-accounts.php">&times;</a>
              <div class="content">
                <form method="POST">
                 School ID  <input type="text" class="form-control" name="schoolID" required/>
                 <center><input type ="submit" class="btn btn-md btn-success" name="SubmitDeactivate" value="Submit" style="width: 200px"/></center>
                </form>
              </div>
              <?php
                require 'dbConfig.php';
                if(isset($_POST['SubmitDeactivate'])) {
                  $schoolID=$_POST['schoolID'];
                  $queryDeactivate="UPDATE accounts SET accStatus = 'Inactive' WHERE schoolID = '$schoolID'";
                  $resultDeactivate = mysqli_query($conn, $queryDeactivate);
                  if($resultDeactivate){
                    echo '<center> <p style = "color: green"> Account was successfully deactivated! </p> </center>';
                  } else {
                    echo '<center> <p style = "color: red"> Oops! Something went wrong </p> </center>';
                  }
                }
              ?>
            </div>
          </div>
        </div>
        <div id="popup3">
        <div id="editAccount" class="overlay">
          <div class="popup">
            <h1> Edit Account Information </h1>
            <a class="close" href="admin-accounts.php">&times;</a>
            <div class="content">
              <form method="POST">
                <center>
                <p> Enter the ID of the account you want to edit the information of.
                </center>
                School ID <input type="text" class="form-control" name="schoolID1" />
                <center><input type="submit" class="btn btn-md btn-success" name="ConfirmEdit" value="Submit" style="width: 200px" /></center>
                <?php
                require 'dbConfig.php';
                if (isset($_POST['ConfirmEdit'])) {
                  $schoolID = $_POST['schoolID1'];
                  $query = "SELECT * FROM accounts WHERE schoolID='$schoolID'";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    if ($schoolID == $row['schoolID']) {
                      $_SESSION['schoolID1'] = $schoolID;
                      echo '<script type="text/javascript">';
                      echo 'window.location.href="admin-accounts.php#edit" </script>';
                    }
                  } else {
                    echo "<br><p align = 'center'; style = 'color: red'> Oops! Something went wrong. Enter a valid School ID. </p>";
                  }
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="popup4">
        <div id="edit" class="overlay">
          <div class="popup">
            <h1> Edit Account Information </h1>
            <a class="close" href="admin-accounts.php">&times;</a>
            <div class="content">
              <form method="POST">
                <center>
                <p> Fill out the fields you want to change.
                </center>
                School ID <input type="text" class="form-control" name="schoolID" />
                First Name <input type="text" class="form-control" name="firstName" />
                Last Name <input type="text" class="form-control" name="lastName" />
                Email Address <input type="text" class="form-control" name="email" />
                Role <select class = "form-control" name="rolee">
                  <option value = ""> Select.. </option>
                  <option value="Admin"> Admin </option>
                  <option value="User"> User </option>
                  </select>
                Account Status <select class = "form-control" name="accStatus">
                  <option value = ""> Select.. </option>
                  <option value="Active"> Active </option>
                  <option value="Inactive"> Inactive </option>
                  </select>
                <center><input type="submit" class="btn btn-md btn-success" name="EditInfo" value="Confirm" style="width: 200px" /></center>
              </form>
            </div>
            <?php
            require 'dbConfig.php';
            if (isset($_POST['EditInfo'])) {
              if ($_POST['EditInfo'] == 'Confirm') {
                if ($_POST['schoolID'] == null && $_POST['firstName'] == null && $_POST['lastName'] == null && $_POST['email'] == null && $_POST['rolee'] == null && $_POST['accStatus'] == null) {
                  echo "<center> <p style='color: red'> Please fill out any field to edit. </p> </center>";
                } else {
                  if ($_POST['schoolID'] != null) {
                    $ID = $_POST['schoolID'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    $validate = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $ID) . "'";
                    $result2 = mysqli_query($conn, $validate);
                    if (mysqli_num_rows($result) > 0) {
                      if (mysqli_num_rows($result2) > 0) {
                        echo "<p align = 'center' style = 'color: red'> School ID is already taken. </p>";
                      } else {  
                        $edit = "UPDATE accounts SET schoolID = '" . mysqli_real_escape_string($conn, $_POST['schoolID']) . "' WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                      if (mysqli_query($conn, $edit)) {
                        echo "<p align = 'center' style = 'color: green'> School ID successfully changed! </p>";
                      } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                      }
                    }
                  }
                  }
                  else if ($_POST['firstName'] != null) {
                    $fName = $_POST['firstName'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE accounts SET firstName = '". mysqli_real_escape_string($conn, $fName) . " ' WHERE schoolID = '" . mysqli_escape_string($conn, $_SESSION['schoolID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> First Name successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['lastName'] != null) {
                    $lName = $_POST['lastName'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE accounts SET lastName = '". mysqli_real_escape_string($conn, $lName) . " ' WHERE schoolID = '" . mysqli_escape_string($conn, $_SESSION['schoolID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Last Name successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['email'] != null) {
                    $eMail = $_POST['email'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE accounts SET email = '". mysqli_real_escape_string($conn, $eMail) . " ' WHERE schoolID = '" . mysqli_escape_string($conn, $_SESSION['schoolID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Email Address successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  }
                  else if ($_POST['rolee'] != "") {
                    $uRole = $_POST['rolee'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE accounts SET rolee = '". mysqli_real_escape_string($conn, $uRole) . " ' WHERE schoolID = '" . mysqli_escape_string($conn, $_SESSION['schoolID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Role successfully changed! </p>";
                        } else {
                        echo "<p align = 'center' style = 'color: red'> Oops! Something went wrong </p>";
                        }
                    }
                  } 
                  else if ($_POST['accStatus'] != "") {
                    $Stat = $_POST['accStatus'];
                    $select = "SELECT * FROM accounts WHERE schoolID = '" . mysqli_real_escape_string($conn, $_SESSION['schoolID1']) . "'";
                    $result = mysqli_query($conn, $select);
                    if(mysqli_num_rows($result) > 0) {
                      $edit = "UPDATE accounts SET accStatus = '". mysqli_real_escape_string($conn, $Stat) . " ' WHERE schoolID = '" . mysqli_escape_string($conn, $_SESSION['schoolID1']) . "'";
                        if(mysqli_query($conn, $edit)) {
                          echo "<p align = 'center' style = 'color: green'> Account Status successfully changed! </p>";
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
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        School ID 
                      </th>
                      <th>
                        First Name
                      </th>
                      <th>
                        Last Name
                      </th>
                      <th>
                        Email Address
                      </th>
                      <th>
                        Role
                      </th>
                      <th>
                        Account Status
                      </th>
                    </thead>
                    <tbody>
                    <?php
                    require 'dbConfig.php';
                    if(isset($_POST['searchButton'])) {
                      if($_POST['searchInput']== null) {
                        echo '<p align="center" style = "color:red"> No entry placed </p>';
                      } else {
                        if($_POST['option'] == "all") {
                          $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                            $query1="SELECT * FROM accounts WHERE (schoolID LIKE '%".$query."%') OR (firstName LIKE '%".$query."%') OR (lastName LIKE '%".$query."%') OR (email LIKE '%".$query."%') OR (rolee LIKE '%".$query."%') OR (accStatus LIKE '%".$query."%')";
                              $result2 = mysqli_query($conn,$query1);
                            if ($result2) {
                                if(mysqli_num_rows($result2)>0) {
                                  while ($row = mysqli_fetch_array($result2)) {
                                    echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                  }
                                }
                              }
                             echo "</tbody></table>";
                          }
                          else if($_POST['option'] == "schoolID") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (schoolID LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                            echo "</tbody></table>";
                          } 
                          else if($_POST['option'] == "firstName") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (firstName LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {  
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                            echo "</tbody></table>";
                          }
                          else if($_POST['option'] == "lastName") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (lastName LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {  
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                           echo "</tbody></table>";
                          }
                          else if($_POST['option'] == "email") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (email LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {  
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                           echo "</tbody></table>";
                          }
                          else if($_POST['option'] == "rolee") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (rolee LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {  
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                            echo "</tbody></table>";
                          }
                          else if($_POST['option'] == "accStatus") {
                            $query= mysqli_real_escape_string($conn, $_POST['searchInput']);
                              $query1 = "SELECT * FROM accounts WHERE (accStatus LIKE '%".$query."%')";
                                $result2 = mysqli_query($conn, $query1);
                                if($result2) {
                                  if(mysqli_num_rows($result2)>0) {
                                    while($row = mysqli_fetch_array($result2)) {  
                                      echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                                    }
                                  }
                                }
                              echo "</tbody></table>";
                          }
                      }
                  }
                      else {
                        $query = "SELECT * FROM accounts";
                        if($result=mysqli_query($conn, $query)) {
                          while($row = mysqli_fetch_array($result)) {
                            echo "<tr><td>" . $row['schoolID'] . "</td><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>". $row['rolee'] . "</td><td>". $row['accStatus'] . "</td></tr>";
                          }
                        } echo "</tbody></table>";
                      }
                      ?>
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