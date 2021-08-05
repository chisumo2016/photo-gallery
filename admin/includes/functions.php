<?php

function Autoloader($class){

    $class= strtolower($class);

    $the_path = "includes/{$class}.php";

    if(file_exists($the_path)){

        require_once($the_path);

    }else{

        die("This file name{$class}.php was not found...");
    }

}

 spl_autoload_register('Autoloader');

//Direct to login page
function redirect($location)
{
    //Direct to login page

    header("Location: {$location}");
}


/*
spl_autoload_register(function($class) {
    $class = strtolower($class);
    include 'includes/'.$class.'.php';
});
 * */