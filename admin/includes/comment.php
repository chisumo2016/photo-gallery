<?php

Class Comment  extends  Db_object {

    //static properties
    protected static  $db_table ="comments";
    protected static $db_table_fields = [
        'photo_id',
        'author',
        'body',
    ];

    // properties
    public $id;
    public $photo_id;
    public $author;
    public $body;



}