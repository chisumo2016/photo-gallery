<?php

Class User  extends  Db_object {

    //static properties
    protected static  $db_table ="users";
    protected static $db_table_fields = [
        'password',
        'username',
        'first_name',
        'last_name',
        'user_image'
    ];

    // properties
    public $id;
    public $password;
    public $username;
    public $first_name;
    public $last_name;
    public $user_image;
    public  $upload_directory = "images";
    public  $image_placeholder ="http://placehold.it/400x400&text=image";



    public  static  function  verify_user($username,$password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$db_table . " WHERE ";
        $sql .= "username = '$username' AND ";
        $sql .= "password = '$password'";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public  function   image_path_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }

}