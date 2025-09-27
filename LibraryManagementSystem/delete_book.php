<?php
include 'db.php'; // database connection

if (isset($_POST['remove'])) {
    $bookName = $_POST['book_name'];

    // Safety check
    if (!empty($bookName)) {
        $sql = "DELETE FROM books WHERE title = '$bookName'";
        if ($mysqli->query($sql) === TRUE) {
            echo "✅ Book removed successfully.<br>";
        } else {
            echo "❌ Error deleting book: " . $mysqli->error;
        }
    } else {
        echo "⚠️ Please enter a book name.<br><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Book</title>
    <!-- Internal CSS -->
    <style>
        /* General Page */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Kameron', sans-serif;
            background: #9DD4DA;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Home Icon */
        .home-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            font-size: 26px;   /* icon size */
            color: #000000;
            transition: 0.3s;
        }

        .home-icon:hover {
            color: #ffffff;     /* changes to white on hover */
        }

        /* Title */
        h2 {
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 60px;
            color: #000000;
            text-align: center;
        }

        /* Form Styling */
        form {
            width: 100%;
            max-width: 750px;   /* was 650px */
        }

        /* Input Row */
        .input-row {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* left-align label + input */
            margin-bottom: 30px;
            gap: 15px; /* small space between label and input */
        }

        label {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            white-space: nowrap;
            margin-right: 15px;
            margin-left: -100px;   /* pushes the label left */
        }

        input[type="text"] {
            width: 550px;        /* fixed width instead of flex */
            height: 45px;        /* a bit shorter height */
            border-radius: 8px;  /* slightly smaller rounding */
            border: 2px solid #000000;
            font-size: 18px;
            padding: 8px;
            box-sizing: border-box;
        }

        /* Button Row */
        .button-row {
            display: flex;
            justify-content: center; /* centers button horizontally */
            margin-top: 30px;        /* adds space below the input row */
        }

        /* Remove Button */
        button {
            width: 220px;
            height: 60px;
            background: #ffffff;
            border: 3px solid #000000;
            border-radius: 12px;
            font-weight: 600;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #000000;
            color: #ffffff;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <a href="login.php" class="home-icon">
            <i class="fa-sharp fa-solid fa-house"></i>
        </a>

        <h2>Remove Book</h2>

        <form method="post">
            <div class="input-row">
                <label>Book Name:</label>
                <input type="text" name="book_name" placeholder="Enter book title" required>
            </div>

            <div class="button-row">
                <button type="submit" name="remove">Remove Book</button>
            </div>
        </form>
    </div>
</body>
</html>
