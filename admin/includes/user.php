<?php

Class User {

    //static properties
    protected static  $db_table ="users";
    protected static $db_table_fields = [
        'password',
        'username',
        'first_name',
        'last_name'
    ];

    // properties
    public $id;
    public $password;
    public $username;
    public $first_name;
    public $last_name;



    public static  function  find_all()
    {
         global $database;

        return self::find_this_query("SELECT * FROM " .self::$db_table . " ");

        //return self::find_this_query("SELECT * FROM users");

        /*$result_set = $database->query("SELECT * FROM users");
        return $result_set;*/
    }

    public static  function find_by_id($user_id)
    {
        global $database;
       // $result_set = $database->query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

        //$the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        $the_result_array = self::find_this_query("SELECT * FROM " .self::$db_table . " WHERE id = $user_id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public  static  function  find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);

        $the_object_array = [];

        while($row = mysqli_fetch_array($result_set )){
            $the_object_array[] = self::instantantion($row);
        }
        return $the_object_array ;
    }

    public  static function instantantion($the_record)
    {
        $the_object = new self;

        foreach ($the_record as  $the_attribute => $value) {

            if ($the_object->has_the_attribute($the_attribute)){
                //assign the property a value
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private  function  has_the_attribute($the_attribute)
    {
       $object_properties = get_object_vars($this);
       //if the key exist
       return  array_key_exists($the_attribute, $object_properties);
    }

    public  static  function  verify_user($username,$password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$db_table . " WHERE ";
        $sql .= "username = '$username' AND ";
        $sql .= "password = '$password'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    //crud
    public  function  create()
    {
        global $database;
        //$properties = $this->properties();//column to separate keys with key
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " .static::$db_table. "(". implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

        //send the query
        if ($database->query($sql)){
            //Assigned id to the object
            $this->id = $database->the_insert_id();

            return true;
        }

        return false;
    }

    public  function update()
    {
        global $database;

        //$properties = $this->properties();//column to seperate keys with key
        $properties = $this->clean_properties();//cleaning the property
        $properties_pairs = [];

        foreach ($properties as $key => $value){
            $properties_pairs[] = "{$key}='{$value}'";
        }
        //$sql = "UPDATE users SET ";
        $sql = "UPDATE " .self::$db_table ." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .=" WHERE id =" .$database->escape_string($this->id);

        //save to database
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }
    //Abstraction
    public  function  save()
    {
        return isset($this->id) ? $this->update(): $this->create();
    }

    public function  delete()
    {
        global $database;
        //$sql = "DELETE FROM  users  ";
        $sql = "DELETE FROM  " .self::$db_table ."  ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        //save to database
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    //abstract properties
    protected function properties()
    {
       //return get_object_vars($this);

        $properties = []; //to place value

        foreach(self::$db_table_fields as $db_field){  //dynamic  $db_field(value)
            //check if exists and assign the value
            if (property_exists($this, $db_field)){
                //Assign to an array
                $properties[$db_field] = $this->$db_field;
            }
        }
        //Return all arrays and values
        return $properties;
    }
    
    protected  function  clean_properties()
    {
        global $database;

        $clean_properties  = array();

        foreach ($this->properties() as $key => $value) {
            //escape the value  and put in the arrays
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

}