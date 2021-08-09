<?php

Class Comment  extends  Db_object {

    //static properties
    protected static  $db_table ="comments";
    protected static $db_table_fields = [
        'id',
        'photo_id',
        'author',
        'body',
    ];

    // properties
    public int $id;
    public int $photo_id;
    public string $author;
    public string $body;

 public  static   function  create_comment($photo_id,$author="John",$body="")
 {
     if (!empty($photo_id) && !empty($author) && !empty($body)){

         $comment = new Comment();
         $comment ->photo_id    = $photo_id;
         $comment ->author      = $author;
         $comment ->body        = $body;

         return $comment;
     }else{
         return  false;
     }
 }

 public  static  function  find_the_comments($photo_id=0)
 {
     global $database;

     $sql  = "SELECT * FROM " . self::$db_table;
     $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
     $sql .= " ORDER  BY photo_id ASC";

     return self::find_by_query($sql);
 }

}