<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <style>
        body {
            background-color: #a8d8de; 
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            width: 400px;
            background: transparent;
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            font-family: "Georgia", serif;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            text-align: left;
        }
        td {
            padding: 10px;
            font-size: 16px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: 2px solid black;
            border-radius: 8px;
            background: white;
            cursor: pointer;
        }
        button:hover {
            background: #e0e0e0;
        }
        .emoji_button {
            font-size: 2rem;
            text-decoration: none;
            color: black;
            position: absolute;
            top: 15px;
            left: 20px;
        }
    </style>
</head>
<body>
    <!-- 🏠 Home icon at top-left -->
    <a href="login.php" class="emoji_button">🏠</a>

    <div class="container">
        <h2>Add Book</h2>
        <form method="POST">
            <table>
                <tr>
                    <td><b>Book Name:</b></td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td><b>Author:</b></td>
                    <td><input type="text" name="author" required></td>
                </tr>
                <tr>
                    <td><b>Year Publication:</b></td>
                    <td><input type="number" name="year" required></td>
                </tr>
            </table>
            <button type="submit">Add Book</button>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $mysqli->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $_POST['title'], $_POST['author'], $_POST['year']);
    if ($stmt->execute()) {
        echo "<p style='color:green; font-weight:bold;'>Book added successfully!</p>";
    } else {
        echo "<p style='color:red;'> Error: " . $stmt->error . "</p>";
    }
}
?>
