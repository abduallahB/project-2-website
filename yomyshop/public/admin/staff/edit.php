<?php $selected = "admins";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<div class="container">
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id= $_POST['id'];
    echo $id;
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $email= $_POST['email'];
    $username= $_POST['username'];


  //insert data comes from user inside the array
    $args['id'] = $id;
    $args['first_name'] = $first_name;
    $args['last_name'] = $last_name;
    $args['email'] = $email;
    $args['username'] = $username;


  //convert data and inserted>> from array to object
    $admin = new Admin($args);

  //  print_r($admin);
    if($admin->update())
    {echo "Category updated Successfully";
      header("Location: index.php" );
    }
    else
    echo "Not created";
    die("");
  }//End handling POST request

  ?>


  <?php
  //get the admins information related to the id sent
  $ado = Admin::find_by_id($_GET['id']);
  print_r($ado);
  echo "<br>";
  echo $ado->getId();
  //die("HH");
  ?>
  <form role="form"  action="edit.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $ado->getId() ?>" />


    <div class="row">
      <div class="form-group col-lg-4">
        <label for="code">Firs Name:</label>
        <input type="text" name="first_name" value="<?php echo $ado->getfirstName() ?>" class="form-control" />

        <label for="code">last Name:</label>
        <input type="text" name="last_name" value="<?php echo $ado->getlastName() ?>" class="form-control" />

        <label for="code">email:</label>
        <input type="text" name="email" value="<?php echo $ado->getEmail() ?>" class="form-control" />

        <label for="code">Username: </label>
        <input type="text" name="username" value="<?php echo $ado->getUsername() ?>" class="form-control" />


      </div>


      <div class="row">
        <div class="form-group col-lg-1 ">
          <input class="btn btn-primary"  type="submit" name="submit" value="Edit">
        </div>
      </div>
    </div>


  </form>
</div>
