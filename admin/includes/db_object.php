<?php

class  Db_object{

    protected static  $db_table ="users";

    public static  function  find_all()
    {
        global $database;

        return static::find_this_query("SELECT * FROM " .self::$db_table . "");

    }

    public static  function find_by_id($user_id)
    {
        global $database;

        $the_result_array = static::find_by_query("SELECT * FROM "  . static::$db_table ." WHERE id =$user_id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public  static  function  find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);

        $the_object_array = [];

        while($row = mysqli_fetch_array($result_set )){
            $the_object_array[] = static::instantantion($row);
        }
        return $the_object_array ;
    }


    //Testing the Instantiaon method
    public  static function instantantion($the_record)
    {
        $calling_class = get_called_class();

        $the_object = new $calling_class;

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



}