<?php

Class User {
    //properties
    public $id;
    public $password;
    public $username;
    public $first_name;
    public $last_name;

    public static  function  find_all_users()
    {
         global $database;

          return self::find_this_query("SELECT * FROM users");

        /*$result_set = $database->query("SELECT * FROM users");
        return $result_set;*/
    }

    public static  function find_user_by_id($user_id)
    {
        global $database;
       // $result_set = $database->query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

        $the_result_array =  self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public  static  function  find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);

        $the_object_array = array();

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

        $sql = "SELECT * FROM users WHERE ";

        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        //RETURN BACK
        $the_result_array =  self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }
    //crud
    public  function  create()
    {
        global $database;
        $sql = "INSERT INTO users (username, password, first_name,last_name)";
        $sql .="VALUES ('";
        $sql .= $database->escape_string($this->username) . "', '";
        $sql .= $database->escape_string($this->password) . "', '";
        $sql .= $database->escape_string($this->first_name) . "', '";
        $sql .= $database->escape_string($this->last_name) . "')";

        //send the query
        if ($database->query($sql)){
            //Assigned id to the object
            $this->id = $database->the_insert_id();

            return true;
        }

        return false;
    }
}