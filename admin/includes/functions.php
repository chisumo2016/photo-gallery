<?php

function classAutoloadear($class)
 {
     $class = strtolower($class);

     $the_path = "includes/{$class}.php";
     if (is_file($the_path) && !class_exists($class)){
         include $the_path;
     }
 }

 spl_autoload_register('classAutoloadear');

function redirec($location){
    header("Location: {$location}");
}



