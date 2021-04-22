<!-- ---------------------------- -->
<!-- Start Navbar -->
<?php
include_once "includes/header.php"
?>
<!-- End Navbar -->
<!-- ---------------------------- -->
<!-- Start Banner Section -->
<section class="banner">
</section>
<div class="clearfix"></div>
<!-- End Banner Section -->
<!-- ---------------------------- -->
<style>
    #signup {
        margin-top: 7%;
    }
</style>
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

<script src="/public/js/main.js"></script>
</body>

</html>

