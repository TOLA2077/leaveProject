
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<form action="your_php_script.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="first_name" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="last_name" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required>

        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="gmail">Gmail:</label>
        <input type="email" id="gmail" name="gmail" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phone_number" required>

        <button type="submit">Register</button>
    </form>

    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            // You can add JavaScript validation here if needed
            // For a production environment, consider adding server-side validation as well
            // to ensure data integrity and security.
            alert("Form submitted!");
            event.preventDefault(); // Prevents the default form submission
        });
    </script>
</body>
</html>
