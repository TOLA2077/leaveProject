<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
</head>
<body>

<h2>User Registration Form</h2>

<form action="process_registration.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>

    <button type="submit">Register</button>
</form>

</body>
</html>
