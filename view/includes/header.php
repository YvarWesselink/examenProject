<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktijk Plaza</title>

    <!-- Style CSS Links -->
    <link rel="stylesheet" href="/public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/css/homepage.css">
    <link rel="stylesheet" href="/public/css/aboutus.css">
    <link rel="stylesheet"  href="/public/css/registration.css"/>
    <link rel="stylesheet" href="/public/css/adminpanel.css"/>
    <!--    <link rel="stylesheet" href="{{asset('/public/css/style.css')}}">-->

    <!-- JS Script -->
    <script src="/public/js/jquery-2.1.1.min.js"></script>
    <script src="/public/js/forms.js"></script>
    <script>
        $(document).ready(function() {
            if (window.location.href.match(/(salland)/) != null) {
                $('nav').addClass("blauw");
                $('div.back-red').addClass("b-blauw");
                $('div.border-bottom').addClass("blauw");
                $('.nieuws-container .content a').addClass("blauw");
                $('.nieuws-container .content a i').addClass("blauw");
            }
        });
    </script>
</head>

<body>
<!-- Start Navbar -->
<nav>
    <div class="back-red">
        <ul>
            <li><a href="#">Sites</a></li>
            <li><a href="/voorwaarden">Voorwaarden</a></li>
            <?php
            if (empty($_SESSION)) {
                session_start();
            }

            if (empty($_SESSION['username'])) {
                echo "<li><a href='inloggen'>Login</a></li>";
            }
            $username = $_SESSION['username'];
            echo "<li><a href='/adminpanel'>$username</a></li>";
            ?>
        </ul>
    </div>
    <div class="logo">
        <img src="/public/img/LandstedeL.png" alt="">
    </div>
    <div class="overlay"></div>
    <div class="border-bottom"></div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus">Over ons</a></li>
        <li><a href="/">Foto's</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a href="/opdrachten">Opdracht</a></li>
    </ul>
</nav>