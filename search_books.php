<?php
// connect to DB
$conn = new mysqli("db", "root", "rootpassword", "Library_DB");
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
} 


// Initialize search
$search = "";
$where = "";
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $conn->real_escape_string($_GET['search']);
    $where = "WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR year LIKE '%$search%'";
}

// Fetch books
$result = $conn->query("SELECT * FROM books $where ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <style>
        /* Browse Style */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #add8e6; 
        }

        .container {
            width: 90%;
            max-width: 1000px;
                margin: 80px auto 50px auto;
        }

        .home-icon {
            font-size: 35px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }

        .header-bar {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            margin-bottom: 15px;
        }

        .header-bar h2 {
            font-size: 30px;
            margin: 0;
        }

        .search-box {
            display: flex;
            justify-content: center; 
            align-items: center;
            margin: 8px 0;
            gap: 10px; 
        }

        .search-box input[type="text"] {
            width: 350px;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-box input[type="submit"] {
            padding: 10px 20px;
            border-radius: 15px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .search-box input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .book-list {
            width: 100%;
            max-height: 700px;
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
            overflow-y: auto;
            padding: 10px;
            margin-top: 20px;
        }

        .book-list table th{
            position: sticky;
            top: 0;
            background: #ddd;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ddd;
            color: black;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .highlight {
            background-color: yellow;
        }

        @media (max-width: 600px ) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th {
                position: relative;
            }
        }
    </style>
</head>
<body>
    <div class="home-icon" onclick="window.location.href='login.php'">&#x1F3E0;</div>
    <div class="container">
        <div class="header-bar">
            
            <h2>Book List</h2>
    
            <div class="search-box">
                <form action="search_books.php" method="get" >
                    <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>

        <div class="book-list">
            <?php 
            if($result->num_rows > 0){
                echo "<table>";
                echo "<tr><th>TITLE</th><th>AUTHOR</th><th>PUBLICATION YEAR</th><th>Status</th></tr>";
                while($row = $result->fetch_assoc()){
                    $title = htmlspecialchars($row['title']);
                    $author = htmlspecialchars($row['author']);
                    $year = (int)$row['year'];
                    $status = htmlspecialchars($row['status']);

                    // Highlight search
                    if($search) {
                        $title = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $title);
                        $author = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $author);
                        $year = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $year);
                    }

                    echo "<tr>";
                    echo "<td>$title</td>";
                    echo "<td>$author</td>";
                    echo "<td>$year</td>";
                    echo "<td>$status</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No Books Found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
