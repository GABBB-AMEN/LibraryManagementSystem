<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #c0e0e5; /* Light blue background */
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            background-color: #add8e6; /* Slightly darker box */
            padding: 50px 80px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        h2 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .btn {
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

        .btn:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Library Management System</h2>
        <a href="librarian.php" class="btn">Librarian</a>
        <a href="Borrow_Return.php" class="btn">Student</a>
    </div>
</body>
</html>
