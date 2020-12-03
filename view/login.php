<!DOCTYPE html>
<html>
<head>
    <title>Login pagina</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Login</h2>
    </div>
    
    <form method="post" action="login">
        
        <div class="input-group">
        <label>Username:</label>
        <input type="text" name="username"> 
        </div>
        
        <div class="input-group">
        <label>Password:</label>
        <input type="password" name="password_1"> 
        </div>
        
        <div class="input_group">
            <button type="submit" action="index.php"  name="login" class="btn">Login</button>
        </div>
        
        <p>
         Not yet a member? <a href="inloggen">Sign up</a>
        </p>
            
    </form>
    
    
    
    </body>
</html>