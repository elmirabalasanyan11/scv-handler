<?php
require_once 'config.php';
require_once 'functions.php';

set_time_limit(120);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_data'])) {
    handleInsertData();
} elseif (isset($_GET['page']) || isset($_POST['display_data'])) {
    require_once 'view/index.php';
} elseif (isset($_POST['export_data'])) {
    require_once 'export/index.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management</title>
</head>
<body>
<!-- Form with two buttons -->
<form method="post">
    <input type="submit" name="insert_data" value="Insert Data">
    <input type="submit" name="display_data" value="Display Data">
    <input type="submit" name="export_data" value="Export Data">
</form>
<!-- JavaScript for handling pagination links -->
</body>
</html>




