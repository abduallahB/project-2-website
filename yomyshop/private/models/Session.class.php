<?php
// session it is work when the user open the program and finsh it when the user check out program
//the information dose'not save in the browser but it save in server
// we can save the username and password and the storeg it is temprary

class Session {

  public $admin_id;

  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  public function login($admin) {
    if($admin) {
      $_SESSION['admin_id'] = $admin->id;
      $this->admin_id = $admin->id;
    }
  }

  public function is_logged_in() {  // if we need to moveing between pages we must sure if the usere login ot not
    return isset($this->admin_id);
  }

  public function logout() {
    unset($_SESSION['admin_id']); // unset we used to removed the value
    unset($this->admin_id);

  }

  private function check_stored_login() { //this function to sure if have login or not
    if(isset($_SESSION['admin_id'])) {
      $this->admin_id = $_SESSION['admin_id'];
    }
  }

}

?>
