<?php

//requiring files
require_once("config/config.php");
require_once("helpers/session_helper.php");

//autoload classes
spl_autoload_register(function($className){

  require_once("../app/core/".$className.'.php');

});

 ?>
