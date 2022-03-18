<?php 

    spl_autoload_register(function($class){
        include_once(__DIR__."/classes/" . $class . ".php");
    });

    // try{
    //     $config = parse_ini_file(__DIR__. "/config/config.ini");
    // }
    // catch(Throwable $e){
    //     $error = $e->getMessage();
    //   }