<!DOCTYPE html>
<html>
<head>
    <title>Login pagina</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


    <div class="header">
        <h2>Register</h2>
    </div>
    
    <form method="post" action="inloggen">
        <!-- display errors here -->
        <?php include('errors.php'); ?>
        


    <form method="post" action="inloggin.php">

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

         Already a member? <a href="login">Log in</a>

          
            
        </p>
        </div>

    </form>

    </body>
</html>



