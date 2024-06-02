 
<!doctype html>
<html lang="en">
    <head>
        <title>TOLA</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="css/view_detail_staff.css">
        
    </head>

    <body>
        <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                  <h1>KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> -->
                <ul>
    <li><a href="index.php" class="menu">ទំព័រដើម</a></li>
    
    <li>
        <button onclick="window.location.href='add_staff.php'" class="dropbtn">ADD STAFF</button>
    </li>
    
    <li>
        <button onclick="window.location.href='view_staff.php'" class="dropbtn">VIEW STAFF</button>
    </li>
    
    <li>
        <button onclick="window.location.href='add_user.php'" class="dropbtn">ADD USER</button>
    </li>
    
    <li>
        <button onclick="window.location.href='view_user.php'" class="dropbtn">VIEW USER</button>
    </li>
</ul>

<div class="sidebar-pf">
                        <a href="logout.php" class="user">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </div>

            </div>
            <!-- And Sidebar -->
            <!-- Nav bar -->
            <div class="navbar-header1">
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
                </div>
                <div class="containera">
                    <div class="contenta">
                        <div style="color: #3498DB ;">
                            <p>ផ្ទាំងបង្ហាញអំពីព័ត៌មានលម្អិត</p>
                        </div>
                    </div>

    <?php
    
    include ('../conn_db.php');

    // Assuming you have retrieved details from the database and stored them in $row
    $id = $_GET['id']; // Assuming you are passing the ID through the URL

    // Fetch details from the database using $id
    $sql = "SELECT * FROM user_info WHERE id = $id"; // Replace your_table with your actual table name
    $result = $conn->query($sql);

    // Display details
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='details-container'>";


        echo "<div class='details-label'>នាម:</div>";
        echo "<div class='details-value'>" . $row['first_name'] . "</div>";

        echo "<div class='details-label'>គោត្តនាម:</div>";
        echo "<div class='details-value'>" . $row['last_name'] . "</div>";

        echo "<div class='details-label'>ដេប៉ាតឹម៉ង់:</div>";
        echo "<div class='details-value'>" . $row['department'] . "</div>";

        echo "<div class='details-label'>ជំនាញ:</div>";
        echo "<div class='details-value'>" . $row['skills'] . "</div>";

        echo "<div class='details-label'>ឈ្មោះអ្នកប្រើប្រាស់:</div>";
        echo "<div class='details-value'>" . $row['username'] . "</div>";

        echo "<div class='details-label'>អ៊ីម៉ែល:</div>";
        echo "<div class='details-value'>" . $row['gmail'] . "</div>";

        echo "<div class='details-label'>លេខទូរស័ទ្ទ:</div>";
        echo "<div class='details-value'>" . $row['phone_number'] . "</div>";

        echo "</div>";
    } else {
        echo "<p>No details found for the given ID.</p>";
    }

    // Close the connection when you're done
    $conn->close();
    ?>
</body>
</html>
