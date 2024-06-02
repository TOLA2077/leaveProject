<ul>
                    <li><a href="index.php" class="menu"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                    <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    
                    <li><a href="add_staff.php" class="menu"><i class="fas fa-user-plus"></i> បន្ថែមអ្នកអនុញ្ញាត</a></li>
                    
                    <li><a href="add_user.php" class="menu"><i class="fas fa-user-graduate"></i> បន្ថែមគ្រូបង្រៀន</a></li>
                    
                    <li class="menu">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users"></i> បញ្ជីអ្នកប្រើប្រាស់
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="view_staff.php"><i class="fas fa-list"></i> បញ្ជីអ្នកអនុញ្ញាត</a>
                            <a class="dropdown-item" href="view_user.php"><i class="fas fa-list"></i> បញ្ជីគ្រូបង្រៀន</a>
                            <!-- Add more dropdown items if needed -->
                        </div>
                    </li>
                </ul>
                <style>ul{
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
    color: #21618C;
}
li:hover{
    background: #2471A3 ;
}
.menu:hover{
    width: 100%;
    color: #ffff;
    text-align: center;
}
/* Style the dropdown button */
.dropbtn {
    background-color: #21618C; 
    color: #ffffff;  
    font-size: 16px;
    border: none;
    cursor: pointer;
    list-style: none;
    width: 150px;
    display: flex;
    justify-content: center;
    margin-top: 10px;
    /* margin-left: 17px; */
    padding: 5px;
    border-radius: 15px;
}
  
  /* Dropdown button on hover & focus */
  .dropbtn:hover, .dropbtn:focus {
    background-color: #ffffff;
    color: #000;

  }
.active {
    background-color: #2E86C1; /* Change this color to your desired color */
    color: #ffffff; /* Change this color to your desired color */
}
  </style>