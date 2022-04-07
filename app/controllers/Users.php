<?php

//(password) - is password for all users
class Users extends Controller {

  //taking user model for methods
  public function __construct(){

    $this->userModel = $this->model('User');

  }


  //login Controller
  public function login(){

    if(isset($_POST['loginBtn']))
    {

      //sanitize input fields
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [

        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',

      ];

      //checking if data are empty and if email exists
      if(empty($data['email'])) $data['email_err'] = "Please fill out this field";
      elseif(!$this->userModel->getUserByEmail($data['email'])) $data['email_err'] = "User does't exists";

      if(empty($data['password'])) $data['password_err'] = "Please fill out this field";

      if(empty($data['email_err']) && empty($data['password_err']))
      {

        //jumping into login function and checking if password is valid, hashed password
        $loggedUser = $this->userModel->login($data['email'], $data['password']);
        if($loggedUser)
        {

          //session
          $this->createSession($loggedUser);

        }
        else
        {

          $data['password_err'] = "Incorect Password";
          $this->view('users/login', $data);

        }

      }
      else $this->view('users/login', $data);

    }
    else
    {

      $data = [

        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',

      ]; $this->view('users/login', $data);

    }

  }


  // register Controller
  public function register(){

    if(isset($_POST['registerBtn']))
    {

      //sanitize input fields from users
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [

        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'first_name_err' => '',
        'last_name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''

      ];

      //checking if data are empty, if email exists, if password is long enough and if passwords match
      empty($data['first_name']) ? $data['first_name_err'] = "Please fill out this field" : $data['first_name_err'] = "";
      empty($data['last_name']) ? $data['last_name_err'] = "Please fill out this field" : $data['last_name_err'] = "";

      if(empty($data['email'])) $data['email_err'] = "Please fill out this field";
      elseif($this->userModel->getUserByEmail($data['email'])) $data['email_err'] = "Email already exists";

      if(empty($data['password'])) $data['password_err'] = "Please fill out this field";
      elseif(strlen($data['password']) < 6) $data['password_err'] = "Password need to be at least 6 characters";

      if(empty($data['confirm_password'])) $data['confirm_password_err'] = "Please fill out this field";
      elseif($data['password'] != $data['confirm_password']) $data['confirm_password_err'] = "Password don't match";

      if(empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
      {

        //hash password
        //(password) - is password for all users
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if($this->userModel->register($data))
        {

          //if everything okey, redirect to login
          flash("user_message", 'You have been successfuly registered, you can login now!');
          redirect("users/login");

        }
        else die("Something went wrong");

      }
      else  $this->view('users/register', $data);

    }
    else
    {

      $data = [

        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'first_name_err' => '',
        'last_name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''

      ]; $this->view('users/register', $data);

    }

  }

  //Create session and redirect registered user to posts index
  public function createSession($user){

    $_SESSION['user_id'] = $user->id;
    $_SESSION['first_name'] = $user->first_name;
    $_SESSION['last_name'] = $user->last_name;
    $_SESSION['email'] = $user->email;
    redirect("posts/index");

  }

  //logout
  public function logout(){

    session_start();
    session_destroy();
    session_unset();
    redirect('users/login');

  }

}

 ?>
