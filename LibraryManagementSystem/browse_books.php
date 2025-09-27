<?php 
include 'db.php';

// Now including the new 'status' column
$validColumns = ["id", "title", "author", "year", "status"]; 
$sort = isset($_GET["sort"]) && in_array($_GET["sort"], $validColumns) ? $_GET["sort"] : "id";
$order = isset($_GET["order"]) && $_GET["order"] === "ASC" ? "ASC" : "DESC";

// Fetch all books
$sql = "SELECT * FROM books ORDER BY $sort $order";
$books = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse Catalog</title>
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
            width: 70%;
            background: transparent;
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            font-family: "Georgia", serif;
            margin-bottom: 20px;
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
            border: 2px solid black;
            border-radius: 10px;
            background: white;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        }
        table {
            border-collapse: separate; 
            border-spacing: 0;      
            width: 100%;    
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc; 
            text-align: center;
        }
        th {
            background: #e6e6e6;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .sort-link {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .sort-link:hover {
            text-decoration: underline;
        }
        .emoji_button {
            font-size: 2rem;
            text-decoration: none;
            color: black;
        }
        .header-bar {
            display: flex; 
            align-items: center;
            justify-content: space-between; 
            margin-bottom: 20px;
        }
        .header-bar h2 {
            flex-grow: 1; 
            margin-right: 2rem; 
        }
        .status-available {
            color: green;
            font-weight: bold;
        }
        .status-borrowed {
            color: red;
            font-weight: bold;
        }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .borrow-btn {
            background: green;
            color: white;
        }
        .return-btn {
            background: orange;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-bar">
    <a href="login.php" class="emoji_button">🏠</a>
    <h2>Browse Catalog</h2>
    <form action="search_books.php" method="get" style="margin: 0;">
        <button type="submit" class="action-btn" style="background: black-grey; color:black;">🔍 Search</button>
    </form>
</div>


        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <?php
                        foreach ($validColumns as $column) {
                            $nextOrder = ($sort === $column && $order === "ASC") ? "DESC" : "ASC";
                            $arrow = ($sort === $column) ? ($order === "ASC" ? " ▲" : " ▼") : "";
                            echo "<th><a href='?sort=$column&order=$nextOrder' class='sort-link'>" . ucfirst(str_replace("_", " ", $column)) . "$arrow</a></th>";
                        }
                        echo "<th>Action</th>";
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($books && $books->num_rows > 0) {
                        while ($row = $books->fetch_assoc()) {
                            $statusClass = $row["status"] === "available" ? "status-available" : "status-borrowed";

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["year"]) . "</td>";
                            echo "<td class='$statusClass'>" . htmlspecialchars($row["status"]) . "</td>";
                            
                            // Action buttons
                            echo "<td>";
                            if ($row["status"] === "available") {
                                echo "<form method='post' action='transaction.php' style='display:inline;'>
                                        <input type='hidden' name='book_id' value='" . $row["id"] . "'>
                                        <input type='hidden' name='action' value='borrow'>
                                        <button type='submit' class='action-btn borrow-btn'>Borrow</button>
                                      </form>";
                            } else {
                                echo "<form method='post' action='transaction.php' style='display:inline;'>
                                        <input type='hidden' name='book_id' value='" . $row["id"] . "'>
                                        <input type='hidden' name='action' value='return'>
                                        <button type='submit' class='action-btn return-btn'>Return</button>
                                      </form>";
                            }
                            echo "</td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php 
if (isset($mysqli)) {
    $mysqli->close(); 
}
?>
