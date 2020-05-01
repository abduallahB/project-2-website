<?php

class MenuItem
{
  static protected $database;
  static public function set_database($database) {
    self::$database = $database;
  }


  public function find_by_id($id)
  {
    $meal_array = [];
    $sql = "SELECT * FROM menu_item WHERE id = {$id}";
    $meal_array = self::find_by_sql($sql);
    return array_shift($meal_array);
  }


  public function find_by_sql($sql)
  {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    while ($record = $result->fetch_assoc()) {
      $meal_array[] =  self::instantiate($record);
    }
    return $meal_array;
  }


  public function __construct($args=[])
  {
    $this->id = $args['id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->category_id = $args['category_id'] ?? '';
    $this->photo = $args['photo'] ?? '';
    $this->price = $args['price']??'';

  }




  public function Add()
  {
    $sql  ="INSERT INTO menu_item(" ;
    $sql .="description,name,price,photo,category_id";
    $sql .=" ) VALUES ( ";
    $sql .="'" . $this->description ."',";
    $sql .="'" . $this->name ."',";
    $sql .="'" . $this->price ."',";
    $sql .="'" . $this->photo ."',";
    $sql .="'" . $this->category_id ."'";
    $sql .=");";
    print_r($sql);

    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
    }
    return $result;
  }



  public function update()
  {
    //print_r($this);
    $sql  ="UPDATE menu_item SET " ;
    $sql .=" description = '" . $this->description ."',";
    $sql .=" name = '" . $this->name ."',";
    $sql .=" price = '" . $this->price ."',";
    $sql .=" photo ='" . $this->photo ."',";
    $sql .=" category_id = '" . $this->category_id ."'";
    $sql .=" WHERE ";
    $sql .="id = ".$this->id ." ;";
  //print_r($sql);
    //echo $sql;
    //die();
    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
    }else {
      echo "Can't update record " . self::$database->error ;
    }
    return $result;
  }



  public function delete()
  {
    //print_r($this);
    $sql  ="DELETE FROM menu_item" ;
    $sql .=" WHERE ";
    $sql .="id = ".$this->id ." ;";

    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
    }else {
      echo "Can't Delete record " . self::$database->error ;
    }
    return $result;
  }


public function find_all()
{
  $sql = "SELECT * FROM menu_item";
  $menu_array = self::find_by_sql($sql);

  return $menu_array;
}


public function instantiate($value)
{
    $obj = new self();
    $obj->id = $value ['id'];
    $obj->description = $value['description'];
    $obj->name = $value ['name'];
    $obj->price = $value['price'];
    $obj->photo = $value ['photo'];
    $obj->category_id = $value['category_id'];
  return $obj;
}



private $id;
private $description;
private $name;
private $photo;
private $price;
private $category_id;

public function getId(){
  return $this->id;
}
public function getPrice(){
  return $this->price;
}
public function getName(){
  return $this->name;
}
public function getDescription(){
  return $this->description;
}
public function getPhoto(){
   return $this->photo;
}
public function getCategoryId(){
  return $this->category_id;
}

public function setId($value){
  return $this->id = $value;
}
public function setPrice($value){
  return $this->price = $value;
}
public function setName($value){
  return $this->name = $value;
}
public function setDescription($value){
  return $this->description = $value;
}
public function setCategory_id($value){
  return $this->category = $value;
}
public function setPhoto($value){
  return $this->photo = $value;
}



}


 ?>
