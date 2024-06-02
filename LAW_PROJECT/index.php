<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="icon" href="user/img/Copy-of-Stamp-KSIT.png"/>
<style>
    body {
        background-image: url(''); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Adjust the shadow values as needed */
        max-width: 380px;
        width: 100%;
        height: 60%;
        text-align: center;
    }
    h1 {
        font-size: 22px;
        color: #1877f2;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        color: #65676b;
        margin-right: 100%;
    }
    input {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 16px;
        border: 1px solid #ccd0d5;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #1877f2;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #166fe5;
    }
    p {
        color: #65676b;
    }
    p.error {
        color: #dc143c;
        margin-top: 16px;
    }
</style>
</head>
<body>
    <form action="login_process.php" method="post">
        <h1>LEAVE MANAGRGMENT SYSTEM</h1><br><br>
        <p><?php
        // Display error message if present in the URL
        if (isset($_GET['error'])) {
            echo '<p class="error">' . $_GET['error'] . '</p>';
        }
        ?></p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br><br>

        <input type="submit" value="LOGIN">
    </form>

</body>
</html>
