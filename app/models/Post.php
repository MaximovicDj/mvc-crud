<?php

class Post {

  private $db;

  //instantiation database to db
  public function __construct(){

    $this->db = new Database();

  }

  //adding new post to database
  public function addPost($data){

    $this->db->query("INSERT INTO posts (title, text, image, user_id) VALUES (:title, :text, :image, :user_id)");
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":text", $data['text']);
    $this->db->bind(":image", $data['image']['name']);
    $this->db->bind(":user_id", $_SESSION['user_id']);

    if($this->db->execute()) return true;
    else return false;

  }

  //edit current post to database
  public function editImage($data){

    $this->db->query("UPDATE posts SET image = :image WHERE id = :id");
    $this->db->bind(":image", $data['image']['name']);
    $this->db->bind(":id", $data['id']);

    if($this->db->execute()) return true;
    else return false;

  }

  //delete post and witch id
  public function deletePost($id){

    $this->db->query("DELETE FROM posts WHERE id = :id");
    $this->db->bind(":id", $id);

    if($this->db->execute()) return true;
    else return false;

  }

  //get all posts from one users who is looged in
  public function getUsersPost($user_id){

    $this->db->query("SELECT * FROM vwposts WHERE user_id = :user_id ORDER BY id DESC");
    $this->db->bind(":user_id", $user_id);

    $result = $this->db->resultSet();

    return $result;

  }

  //editin only text from post
  public function editTextPost($data){

    $this->db->query("UPDATE posts SET title = :title, text = :text  WHERE id = :id");
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":text", $data['text']);
    $this->db->bind(":id", $data['id']);

    if($this->db->execute()) return true;
    else return false;

  }

  //show single post
  public function getPostById($id){

    $this->db->query("SELECT * FROM vwposts WHERE id = :id");
    $this->db->bind(":id", $id);

    $row = $this->db->single();

    return $row;

  }


  //get all posts
  public function getPosts(){

    $this->db->query("SELECT * FROM vwposts ORDER BY id DESC");

    $result = $this->db->resultSet();

    return $result;

  }

}

 ?>
