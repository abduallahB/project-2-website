<?php $selected = "Requsets";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<div class="container">
  <h3>Welcome to Yomyshop Admin panel</h3>
  <a href="new.php"> Add New Reequst </a>

  <?php
  if($session->is_logged_in()){
    echo "Logged in, ". "<a href='logout.php'> logout </a>";
  }else {
    echo "Login, ". "<a href='login.php'> login </a>";
  }

  ?>

    <html>
    <body>
    <table class="table">
    <thead>
    <tr>
    <th scope="col">Id</th>
    <th scope="col">FirstName</th>
    <th scope="col">Lastname</th>
    <th scope="col">Username</th>
    <th scope="col">Email</th>
    <th scope="col">opration</th>
    </tr>


    <?php
    //Get all Admins from database

    $admin = Admin::find_all();
    foreach ($admin as $admin) {
      echo "<tr>";
      echo "<td>".$admin->getId()."</td>";
      echo "<td>".$admin->getfirstName()."</td>";
      echo "<td>".$admin->getlastName()."</td>";
      echo "<td>".$admin->getUsername()."</td>";
      echo "<td>".$admin->getEmail()."</td>";



      echo "<td>"
      ."<a href='view.php?id={$admin->getId()}'>". "View" ."</a>"
      ."<a href='edit.php?id={$admin->getId()}'>". "  - Edit" ."</a>"
      ."<a href='delete.php?id={$admin->getId()}' "
      ."onclick='return confirm(\"Are you sure?\")' >". "  -  Delete" ."</a>"
      ."</td>";
      echo "</tr>";
      //print_r($admin);
    }

    ?>
  </thead>
</div>

<script type="text/javascript">
$('.confirmation').on('click', function () {
  return confirm('Are you sure?');
});
</script>
</body>
</html>
