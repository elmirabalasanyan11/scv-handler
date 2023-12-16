<?php

function handleInsertData() {
    createDatabase($GLOBALS['databaseConfig']);

    $fileId = "1Dwb1alDAQCAPwz7Eg306BVbWtGdfkUCy";
    $url = "https://drive.google.com/uc?id=" . $fileId;

    $csvText = file_get_contents($url);
    $rows = explode("\n", $csvText);
    $columns = str_getcsv($rows[0]);

    createTable($GLOBALS['databaseConfig'], $columns);
//    insertData($GLOBALS['databaseConfig'], $columns, $rows);
}

/**
 * @param mysqli $config
 */
function createDatabase($config)
{
    $conn = mysqli_connect($config['host'], $config['user'], $config['password']);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS `{$config['database']}`";

    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully\n";
    } else {
        echo "Error creating database: " . $conn->error . "\n";
        die();
    }

    mysqli_close($conn);
}

/**
 * @param $columns
 * @param mysqli $config
 */
function createTable($config, $columns)
{
    $conn = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS `users` (`id` INT AUTO_INCREMENT PRIMARY KEY,`" . implode("` VARCHAR(255) NULL, `", $columns) . "` VARCHAR(255) NULL)";

    if ($conn->query($sqlCreateTable) === TRUE) {
        echo "Table created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
        die();
    }
    echo '<pre> Database created successfully Table created successfully';

    mysqli_close($conn);
}

/**
 * @param $rows
 * @param $columns
 * @param mysqli $config
 */
function insertData($config, $columns, $rows)
{
    $conn = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

    extracted($rows, $columns, $conn);
}

/**
 * @param $rows
 * @param $columns
 * @param mysqli $conn
 */
function extracted($rows, $columns, mysqli $conn)
{
    foreach ($rows as $i => $row) {
        $data = str_getcsv($row);

        if (strlen($row) && $i !== 0) {
            $data = array_map(function ($item) {
                return str_replace("'", ",", $item);
            }, $data);

            $sqlInsertData = "INSERT INTO `users` (`" . implode("`, `", $columns) . "`)
                VALUES ('" . implode("', '", $data) . "')";

            if ($conn->query($sqlInsertData) !== TRUE) {
                echo "Error inserting data: " . $conn->error . "\n";
                die();
            }
        }
    }

    mysqli_close($conn);
}

