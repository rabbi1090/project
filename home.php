<?php 
  include "conn.php";
  include "auth.php";
?>
<?php
  $selectSql="SELECT * FROM `dp` WHERE `username` = '$username';";
  $result = mysqli_query($conn, $selectSql);
  $data =mysqli_fetch_array($result);
  if($data) {
    $folder = $data['folder'];
  }
  else
  {
    $folder = "asset/user.png";
  }

  $sql="SELECT * FROM `profile` WHERE `username` = '$username';";
  $userResult = mysqli_query($conn, $sql);
  $userData = mysqli_fetch_array($userResult);
  if($userData)
  {
    $name = $userData['fn']." ".$userData['ln'];
  }
  else
  {
    $name = NULL;
  }
  $_SESSION['folder']=$folder;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Home | HelloChat </title>
    <link rel="icon" href="img/hellochat2.png" type="image/x-icon">
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: bold;
    }

    html {
        scroll-behavior: smooth;
    }

    .carousel-item {
        height: 100vh;
        min-height: 350px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    </style>
</head>

<body>

    <!-- fixed navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/hellochat2.png" class="rounded-circle" width="40" height="40"
                    class="d-inline-block align-top" alt="Logo">
                <b>HelloChat </b>
            </a>

            <ul class="navbar-nav ml-auto">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $folder; ?>" class="rounded-circle" height="32" alt="user"
                            loading="lazy" />
                        <div class="text-dark d-none d-lg-block d-print-block">&nbsp;
                            <?php 
            if($name == NULL)
            {
              echo $username;
            }
            else{
              echo $name;
            }
          ?>&nbsp;</div>
                    </a>
                    <ul class="dropdown-menu mt-2 dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php"><i class="fa fa-user"
                                aria-hidden="true"></i>&nbsp;&nbsp;My Profile</a>
                        <a class="dropdown-item" href="find.php"><i class="fa fa-coffee"
                                aria-hidden="true"></i>&nbsp;&nbsp;Friends</a>
                        <a class="dropdown-item" href="init.php"><i class="fa fa-comments"
                                aria-hidden="true"></i>&nbsp;&nbsp;Messenger</a>
                        <?php
            $sql = "SELECT * FROM `profile` WHERE `username` LIKE '$username' ";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            $check = mysqli_num_rows($result);
            if($check >= 1)
            {
              $sn = $data['sn'];
              echo "<a class='dropdown-item' href='editprofile.php?id=$sn'><i class='fas fa-pencil-alt' aria-hidden='true'></i>&nbsp;&nbsp;Edit Profile</a>";
            }
            else{
              echo "<a class='dropdown-item' href='editprofile.php'><i class='fas fa-pencil-alt' aria-hidden='true'></i>&nbsp;&nbsp;Edit Profile</a>";
            }
          ?>
                        <a class="dropdown-item" href="hatDisplay.php"><i class="fa fa-envelope"
                                aria-hidden="true"></i>&nbsp;&nbsp;My Inbox</a>
                        <a class="dropdown-item" href="changepass.php"><i class="fa fa-unlock-alt"
                                aria-hidden="true"></i>&nbsp;&nbsp;Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="sessionOut.php">Sign Out&nbsp;&nbsp;<i class="fa fa-sign-out-alt"
                                aria-hidden="true"></i></a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <header>
        <!--Carousel Wrapper-->

        <!--/.Carousel Wrapper-->
    </header>


    <!-- Page Content -->
    <div class="container pt-5">
        <div class="card w-100">
            <div class=" p-4 shadow">
                <!-- <h5 class="card-title">Introducing,</h5>
                <h2 class="card-title text-primary">web chat</h2>
                <p class="card-text">
                <ul style="list-style-type: katakana;">
                    <li> First of all, Setup your beautiful profile by uploading a beautiful picture of yours.</li>
                    <li> Find your friends here and start chatting with them, also make numbers of new friend here.</li>
                    <li> There is a option to create group also, if you want to chat with more than one friend
                        simultaneously.</ol>
                </ul>
                </p> -->
                <?php
        if($check >= 1)
        {
          $sn = $data['sn'];
          echo "<a href='editprofile.php?id=$sn' class='btn btn-primary'>Update Profile</a>";
        }
        else{
          echo "<a href='editprofile.php' class='btn btn-primary'>Update Profile</a>";
        }
      ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 pt-4">
                <div class="card">
                    <div class=" p-4 shadow">
                        <h5 class="card-title">Visit your profile</h5>
                        <p class="card-text">
                            Visit your beautiful profile. Upload profile picture, edit your details, change password and
                            many more.
                        </p>
                        <a href="profile.php" class="btn btn-danger">My Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 pt-4">
                <div class="card">
                    <div class=" p-4 shadow">
                        <h5 class="card-title">Find your friends here</h5>
                        <p class="card-text">
                            Visit your beautiful profile. Upload profile picture, edit your details, change password and
                            many more.
                        </p>
                        <a href="find.php" class="btn btn-success">Find Friends</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 pt-4">
                <div class="card">
                    <div class=" p-4 shadow">
                        <h5 class="card-title">Check your Messages</h5>
                        <p class="card-text">
                            Create a new group now and use realtime and instant chatting feature with any numbers of
                            friends.
                        </p>
                        <a href="hatDisplay.php" class="btn btn-warning">My Inbox</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 pt-4">
                <div class="card">
                    <div class=" p-4 shadow">
                        <h5 class="card-title">Create a chat group</h5>
                        <p class="card-text">
                            Create a new group now and use realtime and instant chatting feature with any numbers of
                            friends.
                        </p>
                        <a href="init.php" class="btn btn-secondary">Create Group</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Footer -->
    <footer class="bg-light text-center text-white mt-5">
        <!-- Grid container -->


        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright |
            <a class="text-dark" href="#">HelloChat Team</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body>

</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>