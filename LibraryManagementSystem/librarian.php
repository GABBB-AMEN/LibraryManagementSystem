<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Options</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #c0e0e5; /* light blue */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        h2 {
            margin-bottom: 40px;
            color: #333;
        }

        .button {
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
            transition: background-color 0.3s, color 0.3s;
        }

        .button:hover {
            background-color: #333;
            color: white;
        }

        /* Home icon (top left) */
        .home-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 36px; /* bigger size */
            text-decoration: none;
            color: #000;
            transition: color 0.3s;
        }

        .home-icon:hover {
            color: #333; /* darken on hover */
        }
    </style>
</head>
<body>

    <!-- 🏠 Home icon -->
    <a href="login.php" class="home-icon">🏠</a>

    <div class="container">
        <h2>Librarian Options</h2>
        <a href="browse_books.php" class="button">Browse Books</a>
        <a href="add_book.php" class="button">Add Book</a>
        <a href="edit_book.php" class="button">Edit Book Details</a>
        <a href="delete_book.php" class="button">Remove Book</a>
    </div>

</body>
</html>