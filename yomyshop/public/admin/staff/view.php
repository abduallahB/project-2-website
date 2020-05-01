<?php $selected = "admins";?>
<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>

<a href="index.php">  <i><b> BACK TO ADMIN PAGE </b></i></a>
</br>

<table class="table">

<?php
$adm = Admin::find_by_id($_GET['id']);
echo "<h3> ID: {$adm->getId()}</h3>";
echo "<h3> FirstName: {$adm->getfirstName()}</h3>";
echo "<h3> Lastname: {$adm->getlastName()}</h3>";
echo "<h3> Email: {$adm->getEmail()}</h3>";
echo "<h3> Username: {$adm->getUsername()}</h3>";
?>
</table>
</div>
</body>
</html>
