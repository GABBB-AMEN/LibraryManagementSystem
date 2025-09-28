<?php
include 'db.php';

$book = null;

// Handle search
if (isset($_POST['search'])) {
    if (!empty($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
        // only search by title
        $sql = "SELECT * FROM books WHERE title LIKE '%$keyword%'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 1) {
            $book = $result->fetch_assoc();
        } elseif ($result->num_rows > 1) {
            
        } else {
            
        }
    } else {
        echo "⚠️ Please enter a search term.<br><br>";
    }
}

// Handle update
if (isset($_POST['update'])) {
    $id        = intval($_POST['id']);
    $Book_name = $_POST['book_name'];
    $Author    = $_POST['author'];
    $PubYear   = $_POST['year_publication'];

    $update_sql = "UPDATE books 
                   SET title='$Book_name', author='$Author', year='$PubYear' 
                   WHERE id=$id";

    if ($mysqli->query($update_sql) === TRUE) {
        $book = null;
    } else {
        echo "❌ Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <style>
        /* Page background */
        body {
          margin: 0;
          padding: 0;
          background: #9DD4DA;  
          font-family: "Times New Roman", serif;
        }

        /* Home Icon */
        .home-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            font-size: 26px;  
            color: #000000;
            transition: 0.3s;
        }

        .home-icon:hover {
            color: #ffffff;   
        }

        /* Search bar */
        .search-bar {
          display: flex;
          align-items: center;
          justify-content: space-between;  
          width: 500px;
          height: 35px;
          background: #fff;
          border-radius: 30px;
          padding: 0 15px;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
          margin: 100px auto 40px auto;
          transform: translateX(80px); /* shift to the right */
        }

        .search-icon-button {
          background: none;
          border: none;
          font-size: 16px;
          cursor: pointer;
          margin-right: 10px;
        }

        .mic-icon {
          font-size: 16px;
          color: #333;
          margin-left: 10px;
        }

        .search-bar input {
          flex: 1;            
          border: none;
          outline: none;
          font-size: 16px;
          padding: 5px;
        }

        /* Form Block */
        .form-block {
          margin-top: 35px;
          margin-left: 430px;   
        }

        .form-title {
          font-size: 24px;
          font-weight: bold;
          margin-bottom: 30px;
        }

        /* Each row */
        .form-row {
          display: flex;
          align-items: center;
          margin-bottom: 20px;
        }

        .label {
          font-size: 20px;
          font-weight: bold;
          width: 200px;
        }

        .input-field {
          width: 400px;
          height: 35px;
          border-radius: 8px;
          border: none;
          background: #fff;
          padding: 5px 10px;
          font-size: 16px;
        }

        /* Button */
        .button {
          margin-top: 20px;
          margin-left: 200px;   
          width: 120px;
          height: 40px;
          border-radius: 8px;
          border: 2px solid #000;
          background: #fff;
          font-size: 16px;
          cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="page">

    <!-- Home Icon -->
    <a href="login.php" class="home-icon">🏠</a>

    <!-- Functional Search Bar (Centered) -->
    <form method="POST" action="">
        <div class="search-bar">
            <button type="submit" name="search" class="search-icon-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" name="keyword" placeholder="Search by Title" required>
            <span class="mic-icon">🎤</span>
        </div>
    </form>

    <!-- Book Details -->
    <?php if ($book): ?>
    <div class="form-block">
        <h2 class="form-title">Book Details:</h2>

        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">

            <div class="form-row">
                <label class="label">Book Name:</label>
                <input class="input-field" type="text" name="book_name" value="<?= $book['title'] ?>" required>
            </div>

            <div class="form-row">
                <label class="label">Author:</label>
                <input class="input-field" type="text" name="author" value="<?= $book['author'] ?>" required>
            </div>

            <div class="form-row">
                <label class="label">Year Publication:</label>
                <input class="input-field" type="text" name="year_publication" value="<?= $book['year'] ?>" required>
            </div>

            <button type="submit" name="update" class="button">Update</button>
        </form>
    </div>
    <?php endif; ?>

</div>
</body>
</html>