<?php 
include 'db.php';

$validColumns = ["id", "title", "author", "year", "status"]; 
$sort = isset($_GET["sort"]) && in_array($_GET["sort"], $validColumns) ? $_GET["sort"] : "id";
$order = isset($_GET["order"]) && $_GET["order"] === "ASC" ? "ASC" : "DESC";

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