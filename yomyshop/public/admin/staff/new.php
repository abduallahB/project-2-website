<?php $selected = "admins";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>


<div class="container">
  <?php

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $hashed_password = $_POST['hashed_password'];

//insert data form user inside the array
    $args['first_name'] =  $first_name;
    $args['last_name'] = $last_name;
    $args['email'] = $email;
    $args['username'] = $username;
    $args['hashed_password'] = password_hash($hashed_password, PASSWORD_BCRYPT); // this function to hashed password

    $adm = new Admin($args);
    if($adm->create()){
      echo " admin Created Successfully";
    }  else{
      echo "Not created";
      die("");
    }
  }

  ?>
  <html>
  <head>   </head>
  <body>
    <h1>   create new admin </h1> <br>
    <form role="form"  action="new.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-lg-4">
          <label for="code">First Name</label>
          <input type="text" name="first_name" class="form-control" />

          <label for="code">Last Name</label>
          <input type="text" name="last_name" class="form-control" />

          <label for="code">Email</label>
          <input type="text" name="email" class="form-control" />

          <label for="code">Username</label>
          <input type="text" name="username" class="form-control" />

          <label for="code">Password </label>
          <input type="password" name="hashed_password" class="form-control" />
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-1 ">
          <input class="btn btn-primary"  type="submit" name="submit" value="Add">
        </div>
      </div>
    </body>
    </html>
