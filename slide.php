<?php
include_once 'db.php';

if (isset($_REQUEST['s'])) {
    $new_index = $_REQUEST['s'];
    $new_index = (int) $new_index;
    $ARRAY_INDEX = $new_index;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<div class="slide">
            <div class="slide_left">
                <div class="h_title">
                    <h1><?php echo $d_name[$ARRAY_INDEX];?></h1>
                </div>
                <div class="h_desc">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate enim debitis rem adipisci et aliquid necessitatibus asperiores unde voluptate at reprehenderit eveniet porro voluptatem quo fugit, qui tenetur sapiente! Porro id ad aliquid et dolorem nihil vel placeat dignissimos. <br> <br> Provident id, quam ratione consequatur, voluptatibus reprehenderit dolorum iure sapiente ea debitis doloremque fuga libero cupiditate mollitia impedit numquam minus nihil possimus sunt quo eius? Possimus dolor necessitatibus nemo nisi facere ea, consequuntur reprehenderit rem deserunt ullam. In cupiditate dolorem nesciunt, fugiat illum nam libero ab repellat accusamus saepe dolor quia quos architecto ducimus veniam sit labore incidunt vel deserunt consequatur.</p>
                </div>
                <div class="h_other">
                    <div class="off_day">
                        <h4 class="h_head">Off Day :</h4>
                        <h4 class="h_text">Sature Day</h4>
                    </div>
                    <div class="on_day">
                        <h4 class="h_head">On Day :</h4>
                        <h4 class="h_text">Sun-Fri</h4>
                    </div>
                    <div class="ticket_fare">
                        <h4 class="h_head">Ticket Fare :</h4>
                        <h4 class="h_text">100 BDT/person</h4>
                    </div>
                </div>

            </div>
            <div class="slide_right">
                <div class="slide_right_bottom">
                    <img src="img/lalbagh.jpg" alt="">
                </div>
                <div class="slide_right_top">
                    <div class="slide_right_top_text_area">
                        <h2>Lalbagh Kella</h2>
                        <p>Sit amet consectetur adipisicing elit. Quo accusamus eum nemo error mollitia explicabo.</p>
                    </div>
                    <div class="slide_right_top_arrow">
                        <div class="arrow_left">
                            <img src="img/left_right_arrow.svg" alt="">
                        </div>
                        <div class="arrow_right">
                            <img src="img/left_right_arrow.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<?php 

// header('location:index.php');

?>