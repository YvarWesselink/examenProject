<?php

class login extends controller {
    // Schrijf hier je functies

    public static function userLogin($usernameEmail, $password) {
            if($usernameEmail == "" && $password == ""){
                exit("<div class ='errorLogin'>Vul gegevens in</div>") ;

            }elseif($usernameEmail == ""){
                exit("<div class ='errorLogin'>Voer een email of gebruikersnaam in</div>");
               
            }elseif($password == ""){
                exit("<div class ='errorLogin'>Voer een wachtwoord in</div>");
            }else{        

            // hash het wachtwoord zo dat die matcht met het wachtwoord in de database
            $hash_password = hash('sha256', $password);

            // maak connectie met de database
            $pdo = self::connect();

            // zoek in de database naar de ingevulde gegevens uit de form.
            $stmt = $pdo->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");
            $user = $pdo->prepare("SELECT username FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");
            $userlv = $pdo->prepare("SELECT user_lv FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");

            // bindParam zet de ingevulde gegevens in de sql query.
            $stmt->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            $user->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $user->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            $userlv->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $userlv->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            // voer de query uit
            $stmt->execute();
            $user->execute();
            $userlv->execute();

            // tel hoe veel users er zijn gevonden met de gegeven gegevens
            $count=$stmt->rowCount();
            if($count == null){ 
                exit("<div class = 'errorLogin'>Ongeldige gegevens</div>");
            }else{
            // haal de gegevens uit de database
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $username = $user->fetch(PDO::FETCH_ASSOC);
            $userlevel = $userlv->fetch(PDO::FETCH_OBJ);

            $pdo = null;
            }
        }
        try {
            session_start();
            

            // als er meer dan 1 gebruiker is met de juiste gegevens > sla die gegevens op in de session.
            if ($count) {
                $_SESSION['uid'] = $data->uid;; // Storing user session value
                $_SESSION['username'] = $username['username'];
                $_SESSION['user_lv'] = $userlevel->user_lv;;
                return $_SESSION;
            } else {
                echo "loggin failed";
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
 }

 public static function userRegistration($username, $password, $email, $name) {
   try{
      $pdo = self::connect();

      $st = $pdo->prepare("SELECT uid FROM users WHERE username=:username OR email=:email");

      $st->bindParam("username", $username,PDO::PARAM_STR);
      $st->bindParam("email", $email,PDO::PARAM_STR);
      $st->execute();

      $count=$st->rowCount();
      if($count<1)
      {
      $stmt = $pdo->prepare("INSERT INTO users(username,password,email,voornaam) VALUES (:username,:hash_password,:email,:name)");
      $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
      $hash_password= hash('sha256', $password); //Password encryption
      $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
      $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
      $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
      $stmt->execute();
      $uid=$pdo->lastInsertId(); // Last inserted row id
      $pdo = null;
      $_SESSION['uid']=$uid;
      return true;
      }
      else
      {
      $pdo = null;
      return false;
      }

      }
      catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
 }
}
