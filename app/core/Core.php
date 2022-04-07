<?php

class Core {

    private $currentController = "Pages";
    private $currentMethod = 'index';
    private $params = [];

    public function __construct(){

      //assign url to variable $url
      $url = $this->getUrl();

      //verify if isset controller
      if(isset($url[0]) && file_exists("../app/controllers/".strtolower($url[0]).'.php')){

        $this->currentController = strtolower($url[0]);
        unset($url[0]);

      }

      //instantiation controller and require
      require_once("../app/controllers/".$this->currentController.'.php');
      $this->currentController = new $this->currentController;

      //checking if isset method in controller
      if(isset($url[1]))
      {

        if(method_exists($this->currentController, $url[1]))
        {

          $this->currentMethod = $url[1];
          unset($url[1]);

        }

      }

      //adding more params like - posts/show/1
      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    //verifing if isset url, breaking url, sanitize url, and trim url from more / sign
    private function getUrl(){

      if(isset($_GET['url'])){

        $url = rtrim($_GET['url'], "/");
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/", $url);
        return $url;

      }

    }

}

 ?>
