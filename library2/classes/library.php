<?php

require_once "databases.php";
class Book extends Database {
    public $id="";
    public $title="";
    public $author="";
    public $genre="";
    public $pub_year="";
    

    public function addBook(){
        $sql = "INSERT INTO book(title, author,genre,pub_year) VALUE(:title, :author, :genre, :pub_year)";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":pub_year", $this->pub_year);

        return $query->execute();
    }

     public function viewBook($search="", $genre_filter=""){
     if (!empty($search) && !empty($genre_filter)) {
        $sql = "SELECT * FROM book WHERE title LIKE CONCAT('%', :search, '%') AND genre = :genre ORDER BY title ASC";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":search", $search);
        $query->bindParam(":genre", $genre_filter);

        } elseif (!empty($search)) {
        $sql = "SELECT * FROM book WHERE title LIKE CONCAT('%', :search, '%') ORDER BY title ASC";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":search", $search);

        } elseif (!empty($genre_filter)) {
        $sql = "SELECT * FROM book WHERE genre = :genre ORDER BY title ASC";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":genre", $genre_filter);

        } else {
        $sql = "SELECT * FROM book ORDER BY title ASC";
        $query = $this->connect()->prepare($sql);
        }

        if ($query->execute()) {
        return $query->fetchAll();
        } else {
        return null;
        }
    }

    public function isBookExist($btitle, $id=""){
        $sql = "SELECT COUNT(*) as total FROM book WHERE title = :title";
        $query= $this->connect()->prepare($sql);
        $query->bindParam(":title", $btitle);
        $query->bindParam(":id", $id);
        $record = null;
        if($query->execute()){
            $record = $query->fetch();
        }

        if($record["total"] > 0){
            return true;
        }else{
            return false;
        }
        

    }

    public function fetchBook($id){
        $sql="SELECT * FROM book WHERE id = :id";
        $query = $this->connect()->prepare($sql);
        $query->bindParam("id", $id);

        if ($query->execute()){
            return $query->fetch();
        }else{
            return null;
        }
    }

    public function editBook($id) {
        $sql = "UPDATE SET title=:title, genre=:genre, pub_year=:pub_year WHERE id=:id";

        $query = $this->connect()->prepare($sql);

        $query->bindParam(":title", $this->title);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":pub_year", $this->pub_year);
        $query->bindParam(":id", $this->id);

        return $query->execute();
    }

    public function deleteBook($id){
        $sql = "DELETE FROM book WHERE id=:id";

        $query = $this->connect()->prepare($sql);

        $query->bindParam(":id", $id);

        return $query->execute();
    }
}

// $obj = new Book();
// $obj->title = "marvel";
// $obj->author = "nolan";
// $obj->genre = "Fiction";
// $obj->pub_year=2024;

// $obj->addBook();
