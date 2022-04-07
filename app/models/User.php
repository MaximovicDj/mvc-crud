<?php

class User {

  private $db;

  //instantiation database to db
  public function __construct(){

    $this->db = new Database();

  }

  //login function, veryfy if password match from hashed password
  public function login($email, $password){

    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(":email", $email);

    $row = $this->db->single();

    $password_hash = $row->password;

    if(password_verify($password, $password_hash)) return $row;
    else return false;

  }

  //register, insert user into database
  public function register($data){

    $this->db->query("INSERT INTO users (first_name, last_name, email, password) VALUE (:first_name, :last_name, :email, :password)");
    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    if($this->db->execute()) return true;
    else return false;

  }


  //function to verify if user and email exists
  public function getUserByEmail($email){

    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(":email", $email);

    $row = $this->db->single();

    if($this->db->rowCount() > 0) return $row;
    else return false;

  }

}

 ?>
