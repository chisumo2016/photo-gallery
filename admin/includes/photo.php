<?php


class  Photo extends  Db_object
{
    //static properties
    protected static  $db_table ="photos";
    protected static $db_table_fields = [
        'photo_id',
        'title',
        'description',
        'filename',
        'type',
        'size'
    ];

    // properties
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;


}