
<?php $selected = "meals";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<div class="container">
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = "../../img/";
    //print_r($_FILES["fileToUpload"]);
    //die();
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    $description = $_POST['Meal_description'];
    $name = $_POST['Meal_name'];
    $price = $_POST['price'];
    $category_id = $_POST['Cat_id'];

    $img = basename( $_FILES["fileToUpload"]["name"]);

    $args['description'] = $description;
    $args['name'] = $name;
    $args['price'] = $price;
    $args['photo'] = $img;
    $args['category_id'] = $category_id;
    $Meal = new MenuItem($args);

    if($Meal->create())
    echo "meal Created Successfully";
    else
    echo "Not created";
    die("");
  }

  ?>
  <form role="form"  action="new.php" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="form-group col-lg-4">
        <label for="code">description:</label>
        <input type="text" name="Meal_description" class="form-control" />
        <label for="code">name:</label>
        <input type="text" name="Meal_name" class="form-control" />
        <label for="code">price:</label>
        <input type="number" name="price" class="form-control" />
        <label for="code">Category_id:please enter the number of category </label>
        <input type="text" name="Cat_id" class="form-control" />
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
