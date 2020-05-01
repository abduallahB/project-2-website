<?php
class Admin {
  // ACTIVE RECORD CODE TO KEEP EVERY CLASS KNOLWEDGE WITH DB
  static protected $database;

  static public function set_database($db) {
    self::$database = $db;  // save database coming from initializein this calss
  }



  public function find_by_sql($sql)
  {
    $admins_array = array();
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    while ($record = $result->fetch_assoc()) {
      $admins_array[] =  self::instantiate($record);   // this function to convert array to object
    }
    return $admins_array;
  }



  public function __construct($args=[]) {
    $this->id = $args['id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->hashed_password = $args['hashed_password'] ?? '';
    //var_dump($this);
  }



  public function create()
  {
    //print_r($this);
    $sql  ="INSERT INTO admins(" ;
      $sql .=" first_name, last_name, email, username, hashed_password";
      $sql .=" ) VALUES ( ";
        $sql .="'" . $this->first_name ."',";
        $sql .="'" . $this->last_name ."',";
        $sql .="'" . $this->email ."',";
        $sql .="'" . $this->username ."',";
        $sql .="'" . $this->hashed_password ."'";
        $sql .=");";

        //echo $sql;
        $result = self::$database->query($sql);
        if($result){
          $this->id = self::$database->insert_id;
        }
        return $result;
      }


      public function delete()
      {
        //print_r($this);
        $sql  =" DELETE FROM admins" ;
        $sql .=" WHERE ";
        $sql .="id = ".$this->id." ;";

        $result = self::$database->query($sql);
        if($result){
          $this->id = self::$database->insert_id;
        }else {
          echo "Can't delete record " . self::$database->error ;
        }
        return $result;
      }



      public function update()
      {
        //print_r($this);
        $sql  ="UPDATE admins SET " ;
        $sql .=" first_name = '" . $this->first_name ."',";
        $sql .=" last_name = '" . $this->last_name ."',";
        $sql .=" email = '" . $this->email ."',";
        $sql .=" username ='" . $this->username ."'";
        $sql .=" WHERE ";
        $sql .="id = ".$this->id ." ;";




      echo $sql;
        //die();
        $result = self::$database->query($sql);
        if($result){
          $this->id = self::$database->insert_id;
        }else {
          echo "Can't update record " . self::$database->error ;
        }
        return $result;
      }


      public function find_all()
      {
        $sql = "SELECT * FROM admins";
        $admin_array = self::find_by_sql($sql);

        return $admin_array;
      }



      public function find_by_id($id)
      {
        $admin_array = [];
        $sql = "SELECT * FROM admins WHERE id = {$id}";
        $admin_array = self::find_by_sql($sql);
        return array_shift($admin_array);
      }



      public function instantiate($value)
      {
        $obj = new self();
        $obj->id = $value ['id'];
        $obj->first_name = $value ['first_name'];
        $obj->last_name = $value ['last_name'];
        $obj->email = $value ['email'];
        $obj->username = $value ['username'];
        $obj->hashed_password = $value ['hashed_password'];

        return $obj;
      }



      static public function find_by_username($username) {
        $sql = "SELECT * FROM admin ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
        $obj_array = self::find_by_sql($sql);
        //print_r($obj_array); exit();
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }


      public function verify_password($password) {
        //password_verify built in function
        return password_verify($password, $this->hashed_password);  // this function to make sure if password it is true or not  comerering with  Database informations
      }


      public function full_name() {
        return $this->first_name . " " . $this->last_name;
      }



      private $id;
      private $first_name;
      private $last_name;
      private $email;
      private $username;
      private $hashed_password;




      public function getId(){
        return $this->id;
      }

      public function getfirstName(){
        return $this->first_name;
      }
      public function getlastName(){
        return $this->last_name;
      }
      public function getEmail(){
        return $this->email;
      }
      public function getUsername(){
        return $this->username;
      }
      public function getPassword(){
        return $this->hashed_password;
      }


            public function setId($value){
              return $this->id = $value;
            }

      public function setfirstName($value){
        return $this->first_name = $value;
      }
      public function setlastName($value){
        return $this->last_name = $value;
      }
      public function setEmail($value){
        return $this->email = $value;
      }
      public function setUsername($value){
        return $this->username = $value;
      }
      public function setPassword($value){
        return $this->hashed_password = $value;
      }


    }

    ?>
