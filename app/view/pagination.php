<?php
include 'config.php'; // Include your database configuration

function connectToDatabase($config)
{
    $conn = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function tableExists($conn)
{
    $tableExistsQuery = "SHOW TABLES LIKE 'users'";
    $tableExistsResult = $conn->query($tableExistsQuery);

    return $tableExistsResult->num_rows != 0;
}

function calculateTotalPages($conn, $itemsPerPage)
{
    $sqlCount = "SELECT COUNT(*) as total FROM users WHERE DATEDIFF(NOW(), STR_TO_DATE(birthDate, '%Y-%m-%d')) BETWEEN 25*365 AND 30*365";
    $resultCount = $conn->query($sqlCount);

    // Check if the query was successful
    if ($resultCount === false) {
        die("Error in counting records: " . $conn->error);
    }

    $rowCount = $resultCount->fetch_assoc();
    return ceil($rowCount['total'] / $itemsPerPage);
}

function displayPaginationButtons($totalPages)
{
    if ($totalPages > 0) {
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='index.php?page=$i'>$i</a> ";
        }
    } else {
        echo "No records found.";
    }
}

// Check if the 'users' table exists
$conn = connectToDatabase($databaseConfig);

if (tableExists($conn)) {
    // Calculate total pages
    $itemsPerPage = 50;
    $totalPages = calculateTotalPages($conn, $itemsPerPage);

    // Display pagination buttons
    displayPaginationButtons($totalPages);

    // Close the database connection
    $conn->close();
}
?>
