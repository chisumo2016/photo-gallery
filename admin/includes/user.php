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

        $result_set =  self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;


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
                $the_object->the_attribute = $value;
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

}