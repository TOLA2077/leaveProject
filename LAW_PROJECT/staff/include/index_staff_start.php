<?php // Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: ../index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>VIEW LAW</title>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    

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
}

.container1 {
    width: 100%;
    height: auto;
    display: flex;
   justify-content: right;
}



/* Your existing CSS */
.sidebar {
    background: #6082ae;
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
.menu-list li{
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
.active {
    text-decoration: none;
    /* font-family: 'Kdam Thmor'; */
    font-family: 'Romnea';
    color: #000;
    background: #fff;
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
    background: #ffffff;
    color: #2a7fb8;
    box-shadow: 0 3px 10px #d7dde2;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: sticky;
    top: 0;
    left: 0;
    font-family: 'Romnea';
    overflow: hidden;
}
.pp{
    background: #000;
}

.containera{
    width: 100%;
    height: auto;
    background-color: #ffffff;
    padding: 10px 30px ;
    
}
.container-a{
    width: 100%;
    height: auto;
    background: #FDFEFE;
    box-shadow: 0 5px 15px #f2efef;
    border-radius: 10px;
    color: #2f66b4;
    padding: 10px;
    font-size: 9px;
}
.contenta h4{
    font-family: Khmer OS Siemreap;
    font-size: 20px;
    color: #2553dc;
}








/* profile */

.profile-details {
    margin: 10px;
    padding: 10px;
    border: 1px solid #21618C;
    border-radius: 5px;
    transition: background-color 0.3s;
    background-color: #618ead;
}

.profile-details:hover {
    background-color: #f0f0f0; /* Change the background color on hover */
}

.profile-content {
    margin-right: 10px;
}

.profile-content img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
}

.name {
    color: #FBFCFC;
}

/* Adjust the link color */
.profile-details a {
    text-decoration: none;
    color: inherit;
}

/* profile */














.text_box{
    color: #2553dc;
    display: flex;
    justify-content: center;
    font-family: Khmer OS Siemreap;
}
.text_navbar {
        font-family: Khmer OS Siemreap, sans-serif; /* Replace 'Your Preferred Font' with the actual font you want to use */
        font-size: 16px; /* Adjust the font size as needed */
        color: #333; /* Set the text color */
    }
  
  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Adjust the top margin as needed */
    
}

.table th,
.table td {
    border: 1px solid #154360;
    background: #AED6F1;
    text-align: left;
    padding: 8px;
    font-family: Khmer OS Siemreap;
    text-align: center;
    color: #1A5276;
    
}

.table th {
    background-color: #2E86C1  ; /* Set the background color for table header cells */
    color: #ffffff; /* Set the text color for table header cells */
    

}



.table-success {
    border-color: #28a745; /* Set border color for success-themed table */
}
.search-form {
        font-family: Khmer OS Siemreap;
    }

    .search-button:hover {
        background-color: #2980b9;
    }
    .details-field {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-bottom: 40px;
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
 
.iteme{
    width: 100%;
    display: flex;
    /* justify-content: space-around; */
    /* float: left; */
}
.item-content{
    width: 250px;
    height: 150px;
    border-radius: 10px;
    box-shadow: 0 6px 15px #808B96;
}
.bg-red{
    background: #ffffff;
}
.bg-dak{
    background: #ffffff;
    margin-left: 30px;
}

.text_box{
    color: #2553dc;
    display: flex;
    justify-content: center;
    margin-top: 8%;
}

.contenta {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-form {
            margin-bottom: 10px;
        }

        .search-label {
            font-weight: bold;
            font-size: 10px;
          
            color: #2980b9;
        }

        .search-input {
            margin-right: 5px;
            font-size: 12px;
        }

        .search-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 6px 6px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 10px;
        }

        #data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #data-table th, #data-table td {
            border: 1px solid #2874A6;
            padding: 8px;
            text-align: center;
        }
        #data-table td {
            background: #e1ecf3;
        }

        #data-table th {
            background-color: #5f9cd9;
            color: #ffffff;
        }
        .container-a {
            max-width: 100%;

            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            border-radius: 8px;
            font-size: 12px;
        }

   


        </style>
    </head>

    <body>
       