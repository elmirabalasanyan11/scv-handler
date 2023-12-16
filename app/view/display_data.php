<?php
include 'config.php';

function fetchDataFromDatabase($conn, $offset, $itemsPerPage)
{
    $sql = "SELECT * FROM users
            WHERE DATEDIFF(NOW(), STR_TO_DATE(birthDate, '%Y-%m-%d')) BETWEEN 25*365 AND 30*365
            LIMIT $offset, $itemsPerPage";

    return $conn->query($sql);
}

function displayTableRows($result)
{
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['category']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['birthDate']}</td>
              </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
}

// Pagination
$itemsPerPage = 50;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;
$conn = mysqli_connect($databaseConfig['host'], $databaseConfig['user'], $databaseConfig['password'], $databaseConfig['database']);

$result = fetchDataFromDatabase($conn, $offset, $itemsPerPage);
displayTableRows($result);

$conn->close();
?>
