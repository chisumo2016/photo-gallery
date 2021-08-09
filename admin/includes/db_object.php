<?php

class  Db_object{

    protected static  $db_table ="users";

    public  $upload_errors_array  =
        [
            UPLOAD_ERR_OK            => "There is no error, the file uploaded with success.",
            UPLOAD_ERR_INI_SIZE      => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE     => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL       => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE       => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR    => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE    => " Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION     => "A PHP extension stopped the file upload. ",
        ];


    public static  function  find_all()
    {
        global $database;

        return static::find_by_query("SELECT * FROM " .static::$db_table . "");

    }

    public static  function find_by_id($id)
    {
        global $database;

        $the_result_array = static::find_by_query("SELECT * FROM "  . static::$db_table ." WHERE id = $id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public  static  function  find_by_query($sql)
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

    //abstract properties
    protected function properties()
    {
        //return get_object_vars($this);

        $properties = []; //to place value

        foreach(static::$db_table_fields as $db_field){  //dynamic  $db_field(value)
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
        $sql = "UPDATE " .static::$db_table ." SET ";
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
        $sql = "DELETE FROM  " .static::$db_table ."  ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        //save to database
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


}