<?php
require_once "../classes/library.php";
$bookObj = new Book();

$book = [];
$errors= [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $book["title"] = trim(htmlspecialchars($_POST["title"]));
     $book["author"] = trim(htmlspecialchars($_POST["author"]));
      $book["genre"] = trim(htmlspecialchars($_POST["genre"]));
      $book["pub_year"] = trim(htmlspecialchars($_POST["pub_year"]));

      if(empty($book["title"])){
        $errors["title"] = "Book name is required";
      }else if($bookObj->isBookExist($book["title"])){
        $errors["title"] = "Title already exist";
      }
      
      if(empty($book["author"])){
        $errors["author"] = "author name is required";
      }

      if(empty($book["genre"])){
        $errors["genre"] = "genre required";
      }

      if(empty($book["pub_year"])){
        $errors["pub_year"] = "publication year is required";
      }

      else if($book["pub_year"] > 2025){
        $errors["pub_year"] = "publication year can't be in the future";

      }
      
      if(empty(array_filter($errors))){
        $bookObj->title = $book["title"];
        $bookObj->author = $book["author"];
        $bookObj->genre = $book["genre"];
        $bookObj->pub_year = $book["pub_year"];

        if($bookObj->editBook($_GET["id"])){
            header("Location: viewbook.php");
        }
        else{
            echo "failed";
        }
      }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>

    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <form action="" method="post">
    <label for="title">Book name </label>
    <input type="text" name="title" id="title" value="<?= $book["title"] ?? ""?>">
    <p class="error"><?= $errors["title"] ?? ""?></p>

    <label for="author">Author name</label>
    <input type="text" name="author" id="" value="<?= $book["author"] ?? "" ?>">
    <p class="error"><?= $errors["author"] ?? "" ?></p>

    <label for="genre">Genre</label>
    <select name="genre" id="genre">
        <option value="">--Select Genre</option>
        <option value="History" <?= (isset($book["genre"]) && $book["genre"] == "History")? "selected":""?>>History</option>
        <option value="Science" <?= (isset($book["genre"]) && $book["genre"] == "Science")? "selected":""?>>Science</option>
        <option value="Fiction" <?= (isset($book["genre"]) && $book["genre"] == "Fiction")? "selected":""?>>Fiction</option>
    </select>
    <p class="error"><?= $errors["genre"] ?? ""?></p>


    <label for="pub_year">Publication year</label>

    <input type="number" name="pub_year" id="pub_year" value="<?= $book["pub_year"] ?? "" ?>">
    <p class="error"><?= $errors["pub_year"] ?? "" ?></p>
    
    <input type="submit" value="Save Book">
   </form>
</body>
</html>