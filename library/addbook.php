<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['publication_year'];

    $stmt = $conn->prepare("INSERT INTO books (book_id, title, author, genre, publication_year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $book_id, $title, $author, $genre, $year);

    if ($stmt->execute()) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Signup Form</title>
</head>
<body>
    <h2>Book Signup Form</h2>
    <form method="POST" action="">
        <label>Book ID:</label><br>
        <input type="number" name="book_id" required><br><br>

        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author" required><br><br>

        <label>Genre:</label><br>
        <select name="genre" required>
            <option value="">--Select Genre--</option>
            <option value="History">History</option>
            <option value="Science">Science</option>
            <option value="Fiction">Fiction</option>
        </select><br><br>

        <label>Publication Year:</label><br>
        <input type="number" name="publication_year" required><br><br>

        <input type="submit" value="Add Book">
    </form>
</body>
</html>
