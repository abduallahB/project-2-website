
<?php $selected = "cats";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<div class="container">

  <?php
  //this code to save data from html inside file
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = "../../img/";
    //print_r($_FILES["fileToUpload"]);
    //die();
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {  // this function to save photo from target and move it to fil img
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    //  echo $target_file ;

      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // this code to take form user and  save in database
    $name = $_POST['category_name'];
    $img = basename( $_FILES["fileToUpload"]["name"]);// this function to give the photo the unreal name

    $args['name'] = $name;
    $args['photo'] = $img;
    $cat = new Category($args);

    if($cat->create())
    echo "Category Created Successfully";
    else
    echo "Not created";
    die("");
  }

  ?>
  <form role="form"  action="new.php" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="form-group col-lg-4">
        <label for="code">Category Name:</label>
        <input type="text" name="category_name" class="form-control" />
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-4 ">
        <label for="code">Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
      </div>
    </div>
      <div class="row">
        <div class="form-group col-lg-1 ">
          <input class="btn btn-primary"  type="submit" name="submit" value="Add">
        </div>
      </div>
    </div>


  </form>
</div>
