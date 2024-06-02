<!doctype html>
<html lang="en">
    <head>
        <title>SEND LAW</title>
        <link rel="icon" href="img/Copy-of-Stamp-KSIT.png" />
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
        <style>
            *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;

}
.body{
    font-family: sans-serif;
    font-size: 17px;
    line-height: 1.7;
    background: #ea0000;
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
.sidebar-logo{
    height: 100vh;


}
.logo{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.sidebar-item {
    color: #fff; /* Set the color of the text */
    font-size: 20px; /* Adjust font size as needed */
    margin-top: 20px; /* Add space at the top if necessary */
}

.sidebar-subtext {
    color: #fff; /* Set the color of the text */
    font-size: 14px; /* Adjust font size as needed */
    margin-top: 10px; /* Add space at the top if necessary */
}
ul{
    width: 100%;
    height: 60vh;
    border-radius: 10px;
    padding-top: 10px;
}
li{
    list-style: none;
    width: 150px;
    display: flex;
    justify-content: center;
    margin-top: 10px;
    /* margin-left: 17px; */
    padding: 5px;
    border-radius: 15px;
}
.menu{
    text-decoration: none;
    /* font-family: 'Kdam Thmor'; */
    font-family: 'Romnea';
    color: #D5D8DC;
}
li:hover{
    background: #FDFEFE;
}
.menu:hover{
    width: 100%;
    color: #000;
    text-align: center;
}


.sidebar-pf{
    width: 100%;
    border-radius: 5px;
    padding: 0px 15px;
    background: #FDFEFE;
}
.user{
    font-size: 45px;
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
a{
    text-decoration: none;
}

/* Styles for the box */
.navbar-header1 {
    width: 83%;
    height: auto;
    font-family: Khmer OS Muol Light;
    color: rgb(241, 241, 241);
}
.navbar-header1 .text_navbar {
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
    box-shadow: 0 6px 15px #eff1f4;
    color: #2553dc;
    font-family: 'Romnea';
}
.pp{
    background: #000;
}
.container1 {
    width: 100%;
    height: auto;
    display: flex;
   justify-content: right;
}
/* Content styles */
.containera{
    width: 100%;
    height: auto;
    background-color: #ffffff;
    padding: 20px;
}
.active {
    background-color: #2E86C1; /* Change this color to your desired color */
    color: #ffffff; /* Change this color to your desired color */
}
.container-a {
    margin-top: 20px;
}

.input-box {
    margin-bottom: 15px;
    font-family: Khmer OS Siemreap;
}

.label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #1b84cb;
}

input[type="text"],
input[type="number"],
input[type="date"],
textarea {
    width: 80%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 5px;
    color: #0c4eba;
}

.styled-button {
    background-color: #0c4eba;
    color: white;
    padding: 10px;
    margin-left: 73%;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.styled-button:hover {
    background-color: #0e9cfa;
}

/* Styling for the dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Styling for the dropdown button */
.dropdown-btn {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border: none;
    cursor: pointer;
}
/* Styling for the dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Styling for the dropdown button */
.dropdown-btn {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border: none;
    cursor: pointer}
/* Styling for the dropdown content */
.dropdown-content {
     display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
/* Styling for dropdown options */
.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Styling for dropdown options on hover */
.dropdown-content a:hover {
    background-color: #3498db;
    color: #fff;
}
 /* Show the dropdown content when the button is hovered */
.dropdown:hover .dropdown-content {
    display: block;
}

        </style>
    

    </head>

    <body>
        <div class="container1">
            <div class="sidebar">
                <div class="logo">
                  <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                  <h2 style="color: #FBFCFC;">KSIT</h2>
                </div><br>
                <!-- <div class="sidebar-am"> -->
                    <ul class="menu-list">
                            <li><a href="index.php" class="menu"><i class="bi bi-house-door"></i> ទំព័រដើម</a></li>
                            <li><a href="send_law.php" class="menu"><i class="bi bi-file-earmark-text"></i>ស្នើសុំច្បាប់</a></li>
                            <li><a href="view_list_law.php" class="menu"><i class="bi bi-file-earmark-text"></i> បញ្ជីច្បាប់</a></li>
                    </ul>
                 <!-- Dropdown container -->
            <div class="dropdown">
                <!-- Dropdown button with icon -->
                <button class="dropdown-btn">
                    <span class="icon">&#128100;</span> Profile
                </button>

                <!-- Dropdown content with icons -->
                <div class="dropdown-content">
                    <!-- Option 1: View Profile with user icon -->
                    <a href="#"><span class="icon">&#128100;</span> View Profile</a>
                    <!-- Option 2: Logout with sign-out icon -->
                    <a href="../index.php"><span class="icon">&#128076;</span> Logout</a>
                </div>
            </div>

            </div>
            <!-- And Sidebar -->
            <!-- Nav bar -->
            <div class="navbar-header1">
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
                </div>
    </body>
</html>