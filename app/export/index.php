<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
</head>
<body>
<h2>User Information Form</h2>
<form action="export/export_data.php" method="post">
    <!-- Category Name -->
    <label for="category">Category:</label>
    <input type="text" id="category" name="category" required>
    <br>

    <!-- Gender -->
    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
    <br>

    <label for="min_birth_date">Min Birth Date:</label>
    <input type="text" value="" id="min_birth_date" name="min_birth_date" required>
    <br>

    <label for="max_birth_date">Max Birth Date:</label>
    <input type="text" value="" id="max_birth_date" name="max_birth_date" required>
    <br>

    <!-- Submit Button -->
    <input type="submit" value="Submit">
</form>
</body>
</html>
