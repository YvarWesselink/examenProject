<?php

class login extends controller {
    // Schrijf hier je functies
    public static function userLogin($usernameEmail, $password) {
        try {
            session_start();
            // hash het wachtwoord zo dat die matcht met het wachtwoord in de database
            $hash_password = hash('sha256', $password);

            // maak connectie met de database
            $pdo = self::connect();

            // zoek in de database naar de ingevulde gegevens uit de form.
            $stmt = $pdo->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");
            $user = $pdo->prepare("SELECT username FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");

            // bindParam zet de ingevulde gegevens in de sql query.
            $stmt->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            $user->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $user->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            // voer de query uit
            $stmt->execute();
            $user->execute();

            // tel hoe veel users er zijn gevonden met de gegeven gegevens
            $count=$stmt->rowCount();

            // haal de gegevens uit de database
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $username = $user->fetch(PDO::FETCH_ASSOC);

            $pdo = null;

            // als er meer dan 1 gebruiker is met de juiste gegevens > sla die gegevens op in de session.
            if ($count) {
                $_SESSION['uid'] = $data->uid;; // Storing user session value
                $_SESSION['username'] = $username['username'];
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
      $stmt = $pdo->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
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
