<?php $selected = "meals";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>
<div class="container">
  <h3>Welcome to Meals</h3>
  <a href="new.php">New meal</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">description</th>
        <th scope="col">price</th>
        <th scope="col">Photo</th>
        <th scope="col">Operations</th>
      </tr>
      <?php
      //Get all categories from database
      $meals = MenuItem::find_all();
      foreach ($meals as $meal) {
        echo "<tr>";
        echo "<td>".$meal->getId()."</td>";
        echo "<td>".$meal->getName()."</td>";
        echo "<td>".$meal->getDescription()."</td>";
        echo "<td>".$meal->getprice()."</td>";
        echo "<td>".$meal->getPhoto()."</td>";
        echo "<td>"
        ."<a href='view.php?id={$meal->getId()}'>". "View" ."</a>"
        ."<a href='edit.php?id={$meal->getId()}'>". "  - Edit" ."</a>"
        ."<a href='delete.php?id={$meal->getId()}' "
        ."onclick='return confirm(\"Are you sure?\")' >". "  -  Delete" ."</a>"
        ."</td>";
        echo "</tr>";

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
