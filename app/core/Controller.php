<?php

class Controller {

  //function to load mode
  public function model($model){

    if(file_exists("../app/models/".$model.".php")){
      require_once("../app/models/".$model.".php");
      return new $model();
    }

    else
      require_once("../app/views/404.php");

  }

  //function to load view and pass some data to another page
  public function view($view, $data = []){

    if(file_exists("../app/views/".$view.'.php'))
      require_once("../app/views/".$view.'.php');
    else
      require_once("../app/views/404.php");

  }

}

 ?>
