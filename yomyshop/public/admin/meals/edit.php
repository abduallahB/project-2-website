
<?php $selected = "meals";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<div class="container">
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Upload
    if($_FILES["fileToUpload"]["name"] !==''){
      $target_dir = "../../img/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }
    $name = $_POST['meal_name'];
    $id= $_POST['id'];
    $price =$_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $img = '';
    if($_FILES["fileToUpload"]["name"] !== ''){
      $img = basename( $_FILES["fileToUpload"]["name"]);//$_POST['category_photo'];
    }else{
      $img = $_POST['image'];
    }
    //$meal_id = $_POST['Meal_id'];


    $args['id'] = $id;
    $args['name'] = $name;
    $args['description'] = $description;
    $args['photo'] = $img;
    $args['price']=$price;
    $args['category_id'] = $category_id;
    $meal = new MenuItem($args);

    if($meal->update())
    {echo "Category updated Successfully";
      header("Location: index.php" );
    }
    else
    echo "Not created";
    die("");
  }//End handling POST request

  ?>
  <?php
  //get the Meals information related to the id sent

  $meal = MenuItem::find_by_id($_GET['id']);
  //print_r($cat);
  //die("HH");
  ?>
  <form role="form"  action="edit.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $meal->getId() ?>" />
    <input type="hidden" name="image" value="<?php echo $meal->getPhoto() ?>"/>

    <div class="row">
      <div class="form-group col-lg-4">
        <label for="code">Meal Name:</label>
        <input type="text" name="meal_name" value="<?php echo $meal->getName() ?>" class="form-control" />
        <label for="code">Meal description:</label>
        <input type="text" name="description" value="<?php echo $meal->getDescription() ?>" class="form-control" />
        <label for="code">Meal price:</label>
        <input type="number" name="price" value="<?php echo $meal->getPrice() ?>" class="form-control" />
        <label for="code">category:</label>
        <input type="number" name="category_id" value="<?php echo $meal->getCategoryId() ?>" class="form-control" />
      </div>




    </div>
    <div class="row">
      <div class="form-group col-lg-4 ">
        <label for="code">Image</label></br>
        <img height='100' width='100' src="<?php echo "../../img/".$meal->getPhoto() ?>"> </img>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-4 ">
        <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $meal->getPhoto() ?>">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-1 ">
        <input class="btn btn-primary"  type="submit" name="submit" value="Edit">
      </div>
    </div>
  </div>


</form>
</div>
