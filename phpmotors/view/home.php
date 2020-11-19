

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MOTORS</title>
    <link rel="stylesheet" href="  /phpmotors/css/main.css" media="screen">


</head>

<body>

    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>

    <nav id="page_nav">
       <!-- <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> -->
       <?php echo $getnavigation; ?> 
    </nav>

    <h1 id="title">
Welcome to PHP MOTORS 
</h1>


    <main>
        <h2 id="DMC"> DMC Delorean </h2>
        <p> 3 Cup holders </p>     
        <p> Superman doors </p>
        <p> Fuzzy dice! </p>
        <div id="delorean">
            <img id="car" src="/phpmotors/vehicles/images/delorean.jpg" alt="Picture of a cartoon Delorean">
            <img id="own" src="/phpmotors/images/site/own_today.png" alt="The words Own Today on top of a blue background">



        </div>
<div id="section"> 
        <div id="container_1">
            <h2 class="upgrades_2"> DMC Delorean Reviews </h2>
            <div id="reviews_1">
                <ul id="reviews_2">
                    <li class="reviews"> "So fast it's almost like traveling in time." (4/5)</li>
                    <li class="reviews"> "Coolest ride on the road." (4/5)</li>
                    <li class="reviews"> "I'm feeling Marty McFly!" (5/5) </li>
                    <li class="reviews"> "The most futuristic ride of our day." (4.5/5) </li>
                    <li class="reviews"> "80's living and I love it!" (5/5) </li>
                </ul>
            </div>

        </div>
        <div id="container_2">
        <h2 class="upgrades_1"> Delorean Upgrades </h2>


        <div id="upgrades_3">
            <div id="a">
                <img id="flux" src="/phpmotors/images/upgrades/flux-cap.png" alt="icon of a flux capicitor">

            </div>
            <div id="b">
                <img id="flame" src="/phpmotors/images/upgrades/flame.jpg" alt="icon of a flame">
            </div>
        </div>
        <div id="links_1">
            <a href=" "> Flux Capacitor </a>
            <a href=" "> Flame Decals </a>
        </div>
        <div id="upgrades_4">
            <div id="c">
                <img id="bumper" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="icon of bumper sticker">
            </div>
            <div id="d">
                <img id="hub" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="icon of a hub cap">

            </div>
        </div>
        <div id="links_2">
            <a href=" "> Bumper Stickers </a>
            <a href=" "> Hub Caps </a>
        </div>

        </div>
</div>
    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>