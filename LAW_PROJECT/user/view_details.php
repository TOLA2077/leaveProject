<!DOCTYPE html>
<html lang="en">

<head>
    <title>TOLA</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Add your custom stylesheet link here -->
    <!-- <link rel="stylesheet" href="your-custom-styles.css"> -->
    <style>
        /* Common Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            font-size: 17px;
            line-height: 1.7;
        }

        /* Sidebar Styles */
        .container1 {
            display: flex;
        }

        .sidebar {
            background: #21618C;
            width: 17%;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 10px;
        }

        .logo {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 70px;
        }

        .sidebar-item,
        .sidebar-subtext {
            color: #fff;
            font-size: 20px;
            margin-top: 20px;
        }

        ul {
            width: 100%;
            height: 70vh;
            border-radius: 10px;
            padding-top: 10px;
        }

        li {
            list-style: none;
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
            padding: 5px;
            border-radius: 15px;
        }

        .menu {
            text-decoration: none;
            font-family: 'Romnea';
            color: #D5D8DC;
        }

        li:hover {
            background: #FDFEFE;
        }

        .menu:hover {
            width: 100%;
            color: #000;
            text-align: center;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 768px) {
            .sidebar {
                width: 17%;
                padding: 6px 5px;
            }

            .logo img {
                width: 40px;
            }

            .sidebar-item,
            .sidebar-subtext {
                font-size: 10px;
            }

            li {
                width: 80%;
            }
        }

        /* Navbar Styles */
        .navbar-header1 {
            width: 83%;
            font-family: Khmer OS Muol Light;
            color: rgb(241, 241, 241);
            margin-left: 17%;
        }

        .text_navbar {
            font-size: 25px;
            width: 100%;
            height: 15vh;
            background: #FDFEFE;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: sticky;
            top: 0;
            left: 0;
            box-shadow: 0 6px 15px #808B96;
            color: #2553dc;
            font-family: 'Romnea';
        }

        /* Responsive Styles */
        @media only screen and (max-width: 768px) {
            .text_navbar {
                font-size: 13px;
                height: 7vh;
                box-shadow: 0 3px 8px #808B96;
            }
        }

        .containera {
            width: 100%;
            height: auto;
            background-color: #D5D8DC;
            padding: 25px;
        }

        /* Details Container Styles */
        .details-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .details-label {
            font-weight: bold;
            color: #21618C;
        }

        .details-value {
            margin-bottom: 16px;
            color: #2553dc;
        }
        .details-field {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-bottom: 30px;
        color: #2980b9;
        
    }

    .details-label {
        font-weight: bold;
        margin-right: 10px;
        
    }

    .details-value {
        flex-grow: 1;
    }

    .details-container {
        margin: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }


        /* Responsive Styles */
        @media only screen and (max-width: 768px) {
            .containera {
                padding: 15px;
            }

            .details-container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container1">
        <div class="sidebar">
            <div class="logo">
                <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo">
                <h1>KSIT</h1>
            </div>
            <ul class="menu-list">
                            <li><a href="index.php" class="menu"><i class="bi bi-house-door"></i> ទំព័រដើម</a></li>
                            <li><a href="send_law.php" class="menu"><i class="bi bi-file-earmark-text"></i> ពាក្យសុំច្បាប់</a></li>
                            <li><a href="view_list_law.php" class="menu"><i class="bi bi-file-earmark-text"></i> បញ្ជីច្បាប់</a></li>
                        </ul>
            <div class="sidebar-pf">
                <a href="logout.php" class="user">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Navbar -->
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
include('../conn_db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve details for the selected record
    $sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='details-container'>";

        echo "<div class='details-field'>
                <div class='details-label'>នាម:</div>
                <div class='details-value'>" . $row['first_name'] . "</div>

                <div class='details-label'>គោត្តនាម:</div>
                <div class='details-value'>" . $row['last_name'] . "</div>

                
              </div>";
             

        echo "<div class='details-field'>
                

                <div class='details-label'>ចាប់ពីថ្ងៃ:</div>
                <div class='details-value'>" . $row['fromDate'] . "</div>

                <div class='details-label'>ដល់ថ្ងៃ:</div>
                <div class='details-value'>" . $row['toDate'] . "</div>
        </div>";

        echo "<div class='details-field'>
              <div class='details-label'>ចំនួន:</div>
              <div class='details-value'>" . $row['num_days'] . "</div>

              <div class='details-label'>សកម្មភាព:</div>
                <div class='details-value'>" . $row['status'] . "</div>
        </div>";

        echo "<div class='details-field'>
            <div class='details-label'>Stutus_Date:</div>
            <div class='details-value'>" . $row['status_date'] . "</div>
        </div>";

        echo "<div class='details-field'>
                <div class='details-label'>មូលហេតុ:</div>
                <div class='details-value'>" . $row['becuse'] . "</div>

                
                
              </div>";


        
        echo "</div>";
    } else {
        echo "Record not found.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>




</body>
</html>
