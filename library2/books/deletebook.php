<?php

require_once "../classes/library.php";
$bookObj = new Book();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $id = trim(htmlspecialchars($_GET["id"]));
        $book = $bookObj->fetchBook($id);
        if(!$book){
            echo "<a href='viewbook.php'>View Book</a>";
            exit("No book found");
        }else{
            $bookObj->deleteBook($id);
            header("Location: viewbook.php");
        }
    }else{
        echo "<a href='viewbook.php'>View Book</a>";
        exit("No book found");
    }
}