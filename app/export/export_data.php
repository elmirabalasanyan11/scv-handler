<?php
require_once '../config.php';

function connectToDatabase($config)
{
    return mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);
}

function buildSqlQuery($formData)
{
    $sql = "SELECT id, category, gender, birthDate FROM users WHERE 1";

    if (!empty($formData['category'])) {
        $sql .= " AND category = '{$formData['category']}'";
    }

    if (!empty($formData['gender'])) {
        $sql .= " AND gender = '{$formData['gender']}'";
    }

    if (!empty($formData['maxBirthDate']) && !empty($formData['minBirthDate'])) {
        $sql .= " AND DATEDIFF(NOW(), STR_TO_DATE(birthDate, '%Y-%m-%d')) BETWEEN '{$formData['minBirthDate']}'*365 AND '{$formData['maxBirthDate']}'*365";
    }

    return $sql;
}

function exportDataToCsv($result)
{
    if ($result->num_rows > 0) {
        // Create a file pointer
        $output = fopen('exported_data.csv', 'w');

        // Output the CSV header
        fputcsv($output, array('ID', 'Category', 'Gender', 'BirthDate', 'Age'));

        // Output the data
        while ($row = $result->fetch_assoc()) {
            $birthDateTime = new DateTime($row['birthDate']);
            $currentDate = new DateTime();
            $ageInterval = $birthDateTime->diff($currentDate);
            $age = $ageInterval->y;
            $row['age'] = $age;

            fputcsv($output, $row);
        }

        // Close the file pointer
        fclose($output);

        echo "Data exported to CSV successfully.";
    } else {
        echo "No records found to export.";
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form
    $formData = [
        'category' => isset($_POST['category']) ? $_POST['category'] : '',
        'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
        'minBirthDate' => isset($_POST['min_birth_date']) ? $_POST['min_birth_date'] : '',
        'maxBirthDate' => isset($_POST['max_birth_date']) ? $_POST['max_birth_date'] : '',
    ];

    // Connect to the database
    $conn = connectToDatabase($databaseConfig);

    // Construct the SQL query based on the form values
    $sql = buildSqlQuery($formData);

    // Execute the SQL query
    $result = $conn->query($sql);

    // Export data to CSV
    exportDataToCsv($result);

    // Close the database connection
    $conn->close();
}
?>
