<?php

class Posts extends Controller {

  // reference postModel on model Post to take all data from database
  public function __construct(){

    $this->postModel = $this->model('Post');

  }

  //Index Page For register users
  public function index(){

    //verify if user is logged in
    if(!isset($_SESSION['user_id'])) redirect("users/login");

    $posts = $this->postModel->getUsersPost($_SESSION['user_id']);

    $data = ['posts' => $posts];

    $this->view("posts/index", $data);

  }

  //show one post
  public function show($id){

    $post = $this->postModel->getPostById($id);

    $data = ['post' => $post];

    $this->view('posts/show', $data);

  }

  //delete post
  public function delete($id){

    //verify if user is logged in
    if(!isset($_SESSION['user_id'])) redirect("users/login");

    if($this->postModel->deletePost($id))
    {

      flash("post_message", "Successfuly deleted Post");
      redirect("posts/index");

    }

  }


  //update, edit post
  public function edit($id){

    //verify if user is logged in
    if(!isset($_SESSION['user_id'])) redirect("users/login");

    if(isset($_POST['editBtn']))
    {

      //sanitize inputs fields
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [

        'id' => $id,
        'title' => trim($_POST['title']),
        'text' => trim($_POST['text']),
        'title_err' => '',
        'text_err' => '',

      ];

      //verifing if data are empty
      empty($data['title']) ? $data['title_err'] = "Please fill out this field" : $data['title_err'] = '';
      empty($data['text']) ? $data['text_err'] = "Please fill out this field" : $data['text_err'] = '';

      if(empty($data['title_err']) && empty($data['text_err']))
      {

        if($this->postModel->editTextPost($data))
        {

          flash("post_message", "Successfuy updated Post");
          redirect("posts/index");

        }
        else die("Something went wrong");

      }
      else $this->view('posts/edit', $data);

    }
    else
    {

      //current posts data
      $post = $this->postModel->getPostById($id);

      //verify if is valid user for editing
      if($_SESSION['user_id'] != $post->user_id) redirect('posts/index');

      $data = [

        'id' => $id,
        'title' => $post->title,
        'text' => $post->text,
        'title_err' => '',
        'text_err' => '',

      ]; $this->view('posts/edit', $data);

    }

  }

  //adding nwe post
  public function add(){

    //verify if user is logged in
    if(!isset($_SESSION['user_id'])) redirect("users/login");

    if(isset($_POST['addBtn']))
    {

      //sanitize inputs fields
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [

        'title' => trim($_POST['title']),
        'text' => trim($_POST['text']),
        'image' => $_FILES['image'],
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'text_err' => '',
        'image_err' => ''

      ];

      //verifing if data are empty and checking image
      empty($data['title']) ? $data['title_err'] = "Please fill out this field" : $data['title_err'] = '';
      empty($data['text']) ? $data['text_err'] = "Please fill out this field" : $data['text_err'] = '';

      $validExt = array("jpg", "png", "jpeg", "webp", "bmp", "gif");

      if(empty($data['image']['name'])) $data['image_err'] = "You must choose image";
      elseif(!in_array(pathinfo($data['image']['name'], PATHINFO_EXTENSION), $validExt)) $data['image_err'] = "Invalid extension";
      elseif(!getimagesize($data['image']['tmp_name'])) $data['image_err'] = "You must choose image";

      if(empty($data['title_err']) && empty($data['text_err']) && empty($data['image_err']))
      {

        $data['image']['name'] = microtime(true).$data['image']['name'];
        if($this->postModel->addPost($data))
        {

          if(move_uploaded_file($data['image']['tmp_name'], 'img/'.$data['image']['name']))
          {
            flash("post_message", "Successfuy added Post");
            redirect("posts/index");
          }
          else
            die("Fille was not uploaded");


        }
        else die("Something went wrong");

      }
      else $this->view('posts/add', $data);

    }
    else
    {

      $data = [

        'title' => '',
        'text' => '',
        'image' => '',
        'title_err' => '',
        'text_err' => '',
        'image_err' => ''

      ]; $this->view('posts/add', $data);

    }

  }

  //change image in new page
  public function editimage($id){


    //verify if user is logged in
    if(!isset($_SESSION['user_id'])) redirect("users/login");

    $data = ['id' => $id];

    if(isset($_POST['changeImg']))
    {

      $data = [

        'id' => $id,
        'image' => $_FILES['image'],
        'image_err' => '',

      ];

      //checking if image is valid
      $validExt = array("jpg", "png", "jpeg", "webp", "bmp", "gif");

      if(empty($data['image']['name'])) $data['image_err'] = "Please choose photo";
      elseif(!in_array(pathinfo($data['image']['name'], PATHINFO_EXTENSION), $validExt)) $data['image_err'] = "Invalid extension";
      elseif(!getimagesize($data['image']['tmp_name'])) $data['image_err'] = "This is not image!!";

      if(empty($data['image_err']))
      {

        $data['image']['name'] = microtime(true).$data['image']['name'];
        if($this->postModel->editImage($data))
        {

          if(move_uploaded_file($data['image']['tmp_name'], 'img/'.$data['image']['name']))
          {

            flash("post_message", "Successfuly chagned photo");
            redirect("posts/index");

          }
          else die("File was not uploaded");

        }
        else die("Something went wrong with database");

      }
      else $this->view('posts/editimage', $data);

    }
    else
    {

      $data = [

        'id' => $id,
        'image' => '',
        'image_err' => '',

      ]; $this->view('posts/editimage', $data);

    }

  }

}

 ?>
