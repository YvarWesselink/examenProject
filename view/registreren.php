<style>

.register {
    min-height:275px;
}



</style>



<!DOCTYPE html>
<html lang="en">


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
<div class="register"></div>
<!-- End Banner Section -->
<!-- ---------------------------- -->
<!-- Start Signup Section -->
<div id="signup">
    <h3>Registreren</h3>
    <form method="post" action="" name="signup">
        <label>Naam:</label>
        <input type="text" name="nameReg" autocomplete="off" />
        <label>Email:</label>
        <input type="text" name="emailReg" autocomplete="off" />
        <label>Username:</label>
        <input type="text" name="usernameReg" autocomplete="off" />
        <label>Wachtwoord:</label>
        <input type="password" name="passwordReg" autocomplete="off"/>
        <input type="submit" class="button" name="signupSubmit" value="Aanmelden">
    </form>

    <p>Heeft u al een account?</p>
    <a href="/inloggen">klik hier.</a>
</div>
<!-- End Signup Section -->
<!-- ---------------------------- -->
<script src="/public/js/main.js"></script>
</body>
<?php
include_once "includes/footer.php";
?>
<!-- End Footer -->




</html>
