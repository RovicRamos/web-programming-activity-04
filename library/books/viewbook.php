<?php

require_once "../classes/library.php";
$bookObj = new Book();

$search = "";
$genre_filter ="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = isset($_GET["search"])? trim(htmlspecialchars($_GET["search"])) : "";
    $genre_filter = isset($_GET["genre_filter"])? trim(htmlspecialchars($_GET["genre_filter"])) : "";


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
</head>
<body>

<h1>List of Books</h1>  
<form action="" method="get">
    <label for="search">Search Book: </label>
    <input type="search" name="search" id="search" value="<?= $search ?>">
    <input type="submit" value="Search">
    <label for="genre_filter">Filter Genre:</label>
    <select name="genre_filter" id="genre_filter">
        <option value="">--Select Genre--</option>
        <option value="History" <?= ($genre_filter == "History") ? "selected" : "" ?>>History</option>
        <option value="Science" <?= ($genre_filter == "Science") ? "selected" : "" ?>>Science</option>
        <option value="Fiction" <?= ($genre_filter == "Fiction") ? "selected" : "" ?>>Fiction</option>
    </select>
     <input type="submit" value="Filter">
    
</form>

<a href="addbook.php">Add book</a>
<table border="1">
    <tr>
        <td>No.</td>
        <td>Title</td>
        <td>Author</td>
        <td>Genre</td>
        <td>Publication Year</td>
    </tr>

    <?php
    $no=1;
    foreach($bookObj->viewBook($search, $genre_filter) as $book){
    ?>
    <tr>
         <td><?= $no++?></td>
        <td><?= $book["title"]?></td>
        <td><?= $book["author"]?></td>
        <td><?= $book["genre"]?></td>
        <td><?= $book["pub_year"]?> </td>
    </tr>
   <?php } ?>
  
</table>
    
</body>
</html>