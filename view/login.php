<!-- ---------------------------- -->
<!-- Start Navbar -->
<?php
include_once "includes/header.php"
?>
<!-- End Navbar -->
<!-- ---------------------------- -->
<!-- Start Banner Section -->
<section class="banner">
    <div class="banner-img"></div>
    <div class="banner-svg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                  d="M0,96L80,112C160,128,320,160,480,154.7C640,149,800,107,960,90.7C1120,75,1280,85,1360,90.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,128L120,112C240,96,480,64,720,64C960,64,1200,96,1320,112L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg> -->
    </div>
</section>
<div class="clearfix"></div>
<!-- End Banner Section -->
<!-- ---------------------------- -->
<!-- ---------------------------- -->
<!-- Start Signup Section -->
<div id="signup">
    <h3>Inloggen</h3>
    <form method="post" action="" name="login">
        <label>Username of Email:</label>
        <input type="text" name="usernameEmail" autocomplete="off" />
        <label>Wachtwoord:</label>
        <input type="password" name="password" autocomplete="off"/>
        <input type="submit" class="button" name="loginSubmit" value="Login">
    </form>

    <p>Heeft u nog geen account?</p>
    <a href="/registreren">klik hier.</a>
</div>
<!-- End Signup Section -->
<!-- ---------------------------- -->
<!-- Start Footer -->
<?php
include_once "includes/footer.php";
?>
<!-- End Footer -->

<script src="/public/js/main.js"></script>
</body>

</html>
