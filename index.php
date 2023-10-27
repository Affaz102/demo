<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dhaka Wander</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

</head>
<body>
    <div class="main_container">

        <div class="header">

            <div class="logo">
                <div class="logo_left">
                    <img class="logo_img" src="img/logo_img.svg" alt="logo">
                </div>
                <div class="logo_right">
                    <img class="logo_dhaka" src="img/logo_dhaka.svg" alt="dhaka">
                    <img class="logo_wander" src="img/logo_wander.svg" alt="wander">
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="#">Category</a>
                        <ul>
                            <li><a href="#">Nature</a></li>
                            <li><a href="#">Entertainment</a>
                                <ul>
                                    <li><a href="#">Shahbag Jadughar</a></li>
                                    <li><a href="#">Novotheator</a></li>
                                    <li><a href="#">Shishu Mela</a></li>
                                    <li><a href="#">Muktijoddha Jadughar</a></li>
                                    <li><a href="#">Nondon</a></li>
                                    <li><a href="#">Jamuna Featur</a>e</li>
                                    <li><a href="#">Sineplex</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Park</a></li>
                            <li><a href="#">Science</a></li>
                            <li><a href="#">Hospital</a></li>
                        </ul>
                    </li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

            </div>

        </div>
        <?php include 'slide.php'?>
        <div class="slide_item_pointer">
            <ul>
                <li><a href="slide.php?s=0"><div class="bullet_point"></div></a></li>
                <li class="special_dot"><a href="slide.php?s=1"><div class="bullet_point special_dot1"></div></a></li>
                <li><a href="slide.php?s=2"><div class="bullet_point"></div></a></li>
                <li><a href="slide.php?s=3"><div class="bullet_point"></div></a></li>
                <li><a href="slide.php?s=4"><div class="bullet_point"></div></a></li>
            </ul>
        </div>
       


    </div>
    
</body>
</html>