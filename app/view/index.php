<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Data Display</title>
</head>
<body>
<div id="app">
    <table>
        <!-- Table header -->
        <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Gender</th>
            <th>Date of Birth</th>
        </tr>
        </thead>
        <!-- Table body will be populated using PHP -->
        <tbody>
        <?php include 'display_data.php'; ?>
        </tbody>
    </table>
    <div id="pagination">
        <?php include 'pagination.php'; ?>
    </div>
</div>
</body>
</html>
