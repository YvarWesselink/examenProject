<!DOCTYPE html>
<html>
<head>
    <title>Login pagina</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <p>
            <label>Username:</label>
            <input type="text" id="user" name="user"/>
        </p>
        <p>
            <label>Password:</label>
            <input type="password" id="pass" name="pass"/>
        </p>
        <p>
            <input type="submit" id="btn" value="login"/>
        </p>
    </div>

    <div class="header">
        <h2>Register</h2>
    </div>
<<<<<<< HEAD
    
    <form method="post" action="inloggen">
        <!-- display errors here -->
        <?php include('errors.php'); ?>
        
=======

    <form method="post" action="inloggin.php">

>>>>>>> d05c25a01abb3b8a68057ba5fa630b7326a8015c
        <div class="input-group">
            <label>Username:</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label>Email:</label>
            <input type="text" name="email">
        </div>

        <div class="input-group">
            <label>Password:</label>
            <input type="password" name="password_1">
        </div>

        <div class="input-group">
            <label>Confirm password:</label>
            <input type="password" name="password_2">
        </div>

        <div class="input_group">
            <button type="submit" name="register" class="btn">Register</button>
        </div>

        <p>
<<<<<<< HEAD
         Already a member? <a href="login">Log in</a>
=======
            <input type="submit" id="btn" value="login"/>
            Already a member? <a href="login.php">Log in</a>
>>>>>>> d05c25a01abb3b8a68057ba5fa630b7326a8015c
        </p>
        </div>

    </form>

    </body>
</html>



