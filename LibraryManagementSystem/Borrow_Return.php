<?php
include 'db.php';

// ✅ initialize para hindi mag-warning
$message = "";
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = trim($_POST['book_name']);

    if (isset($_POST['borrow'])) {
        // Borrow book
        $sql = "SELECT * FROM books WHERE title=? AND status='available'";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $bookName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $update = "UPDATE books SET status='borrowed' WHERE title=?";
            $upStmt = $mysqli->prepare($update);
            $upStmt->bind_param("s", $bookName);
            $upStmt->execute();
            $message = "✅ You borrowed '$bookName'.";
        } else {
            $message = "❌ Book not available for borrowing.";
        }
    }

    if (isset($_POST['return'])) {
        // Return book
        $sql = "SELECT * FROM books WHERE title=? AND status='borrowed'";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $bookName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $update = "UPDATE books SET status='available' WHERE title=?";
            $upStmt = $mysqli->prepare($update);
            $upStmt->bind_param("s", $bookName);
            $upStmt->execute();
            $message = "✅ You returned '$bookName'.";
        } else {
            $message = "❌ Book not found or not borrowed.";
        }
    }

    if (isset($_POST['search'])) {
        // Search books
        $searchTerm = "%" . $bookName . "%";
        $sql = "SELECT * FROM books WHERE title LIKE ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $searchResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Borrow / Return Books</title>
    <!-- ✅ internal CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c0e0e5; /* Figma background */
            text-align: center;
            margin: 0;
            padding: 50px;
        }

        /* Home button (top left) */
        /* Home button (top left) */
.home-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 10px 18px;
    font-size: 32px; /* ⬅️ make the house bigger */
    text-decoration: none;
}

        .container {
            background: #add8e6; /* Box color */
            padding: 40px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        h2 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000;
        }

        label {
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 200px;
            margin: 15px auto;
            padding: 15px 0;
            background-color: white;
            border: 2px solid #000;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: #000;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #333;
            color: white;
        }

        .borrow { border-color: #000; }
        .return { border-color: #000; }
        .search { border-color: #000; }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background: white;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Home button (upper left) -->
    <a href="login.php" class="home-btn">🏠</a>

    <div class="container">
        <h2>BORROW / RETURN BOOKS</h2>
        <form method="post">
            <label><b>BOOK NAME:</b></label><br>
            <input type="text" name="book_name" required><br><br>
            <button type="submit" name="borrow" class="borrow">BORROW</button>
            <button type="submit" name="return" class="return">RETURN</button>
            <button type="submit" name="search" class="search">SEARCH</button>
        </form>
        <?php if ($message != "") echo "<p class='message'>$message</p>"; ?>

        <!-- Show search results -->
        <?php if (!empty($searchResults)) { ?>
            <h3>Search Results</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($searchResults as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</body>
</html>