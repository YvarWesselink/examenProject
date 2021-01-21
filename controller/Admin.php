<?php


class Admin extends controller
{

    public static function uploadHomeTXT($titel, $tussenkop, $txthome)
    {
        $pdo = self::connect();

        $st = $pdo->prepare("UPDATE texthome SET titel=:titel, tussenkopje=:tussenkopje, home=:txthome WHERE id = 1");

        $st->bindParam(":titel", $titel,PDO::PARAM_STR);
        $st->bindParam(":tussenkopje", $tussenkop,PDO::PARAM_STR);
        $st->bindParam(":txthome", $txthome,PDO::PARAM_STR);
        $st->execute();

        header("Location: /txthome");
    }

    public static function uploadImage($album) {
        try {
            $pdo = self::connect();

            // get school info
            $st = $pdo->prepare("SELECT school FROM albums WHERE naam = :naam");
            $st->bindParam(":naam", $album);
            $st->execute();
            $school = $st->fetch(PDO::FETCH_ASSOC);

            $name = $_FILES['file']['name'];
            $target_dir = "public/uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){

                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                // Insert record
                $data = [
                    'image' => $image,
                    'album' => $album,
                    'school' => $school['school'],
                ];

                $stmt = $pdo->prepare("insert into images(image, album, school) values(:image, :album, :school)");
                $stmt->execute($data);

                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
            }

            echo "<script> location.href='/foto-uploaden'; </script>";

        } catch (PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public static function downloadAlbums() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM albums");
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<option> - Maak eerst een album aan - </option>";
        } else {
            foreach ($albums as $album) {
                print_r("<option value='".$album['naam']."'>".$album['naam']."</option>");
            }
        }
    }

    public static function downloadFotos() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM albums");
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<p>Er zijn nog geen albums</p>";
        } else {
            foreach ($albums as $album) {
                try {
                    $naam = $album['naam'];
                    $id = $album['id'];
                    $homepage = $album['homepage'];
                    $st = $pdo->prepare("SELECT * FROM images WHERE album = :album");
                    $st->bindParam(':album', $naam);
                    $st->execute();

                    $foto = $st->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($foto)) {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "Nog geen foto's in dit album geplaatst";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' name='delete-album' value='Album Verwijderen'>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "<img style='height: 100px; width: auto' src='".$foto[0]['image']."'>";
                        echo "<form method='post' action='/album-weergeven'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' name='album-weergeven' value='Album Weergeven'>";
                        echo "</form>";

                        echo "<form method='post'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' name='delete-album' value='Album Verwijderen'>";
                        echo "</form>";

                        if ($homepage == false) {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='album' value='$id'>";
                            echo "<input type='submit' name='homepage' value='als homepage slide selecteren'>";
                            echo "</form>";
                        }

                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    echo '{"error":{"text":'. $e->getMessage() .'}}';
                }
            }
        }
    }

    public static function downloadFotosSchool($school) {
        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM albums WHERE school = :school");
        $st->bindParam(":school", $school);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<p>Er zijn nog geen albums</p>";
        } else {
            foreach ($albums as $album) {
                try {
                    $naam = $album['naam'];
                    $st = $pdo->prepare("SELECT * FROM images WHERE album = :album");
                    $st->bindParam(':album', $naam);
                    $st->execute();

                    $foto = $st->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($foto)) {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "Nog geen foto's in dit album geplaatst";
                        echo "</div>";
                    } else {
                        echo "<div class='album'>";
                        echo "<img src='".$foto[0]['image']."'>";
                        echo "<form method='post' action='/album-weergeven-school'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' class='album-but' name='album-weergeven' value='".$naam." Weergeven'>";
                        echo "</form>";
                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    echo '{"error":{"text":'. $e->getMessage() .'}}';
                }
            }
        }
    }

    public static function downloadFotosHome($school) {
        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM images WHERE school = :school ORDER BY id DESC");
        $st->bindParam(":school", $school);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        return $albums;
    }

    public static function downloadAlbumImages($album) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $album);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($albums as $album) {
            $id = $album['id'];
            echo "<div class='image-album'>";
            echo "<img src='".$album['image']."'>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='album' value='$id'>";
            echo "<input type='submit' value='Verwijder Plaatje' name='delete-image'";
            echo "</form";
            echo "</div>";
        }
    }

    public static function downloadAlbumImagesSchool($album) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $album);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($albums as $album) {
            $id = $album['id'];
            echo "<div class='image-album'>";
            echo "<img src='".$album['image']."'>";
            echo "</div>";
        }
    }

    public static function deleteAlbum($naam) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $naam);
        $st->execute();
        $selected = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($selected)) {
            // verwijder album uit database
            $query = $pdo->prepare("SELECT id FROM albums WHERE naam = :naam");
            $query->bindParam(":naam", $naam);
            $query->execute();

            $id = $query->fetchAll(PDO::FETCH_ASSOC);

            $st = $pdo->prepare("DELETE FROM albums WHERE naam = :naam");
            $st->bindParam(":naam", $naam);
            $st->execute();
        } else {
            foreach ($selected as $select) {
                // verwijder image uit database
                $id = $select['id'];
                $st = $pdo->prepare("DELETE FROM images WHERE id = :id");
                $st->bindParam(":id",$id);
                $st->execute();

                // verwijder album uit database
                $query = $pdo->prepare("SELECT id FROM albums WHERE naam = :naam");
                $query->bindParam(":naam", $naam);
                $query->execute();

                $id = $query->fetchAll(PDO::FETCH_ASSOC);

                $st = $pdo->prepare("DELETE FROM albums WHERE naam = :naam");
                $st->bindParam(":naam", $naam);
                $st->execute();
            }
        }

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function deleteImage($id) {
        $pdo = self::connect();

        $st = $pdo->prepare("DELETE FROM images WHERE id = :id");
        $st->bindParam(":id", $id);
        $st->execute();

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function uploadAlbum($naam, $school) {
        $pdo = self::connect();

        $naamAlbum = $naam."-".$school;

        $st = $pdo->prepare("INSERT INTO albums(naam, school) values(:naam, :school)");
        $st->bindParam(":naam", $naamAlbum);
        $st->bindParam(":school", $school);
        $st->execute();

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function homepageImage($id) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT id FROM albums WHERE homepage = true ");
        $st->execute();
        $hID = $st->fetch(PDO::FETCH_ASSOC);

        if (!empty($hID['id'])) {
            $st = $pdo->prepare("UPDATE albums SET homepage = false WHERE id = :id");
            $st->bindParam(":id", $hID['id']);
            $st->execute();

            $st = $pdo->prepare("UPDATE albums SET homepage = true WHERE id = :id");
            $st->bindParam(":id", $id);
            $st->execute();
        } else {
            $st = $pdo->prepare("UPDATE albums SET homepage = true WHERE id = :id");
            $st->bindParam(":id", $id);
            $st->execute();
        }

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function downloadTXT() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM texthome WHERE id = 1");
        $st->execute();

        $home = $st->fetch(PDO::FETCH_ASSOC);

        return $home;
    }

    public static function editUser($username, $voornaam, $achternaam, $email, $straat, $plaats, $postcode, $mobiel, $website, $id)
    {
        $pdo = self::connect();

        $_SESSION['username']=$username;
        $st = $pdo->prepare("update users set username=:username, voornaam=:voornaam, achternaam=:achternaam, email=:email, straat=:straat, plaats=:plaats, postcode=:postcode, mobiel=:mobiel, website=:website where uid=:id");

        $st->bindParam(":username", $username, PDO::PARAM_STR);
        $st->bindParam(":voornaam", $voornaam, PDO::PARAM_STR);
        $st->bindParam(":achternaam", $achternaam, PDO::PARAM_STR);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->bindParam(":straat", $straat, PDO::PARAM_STR);
        $st->bindParam(":plaats", $plaats, PDO::PARAM_STR);
        $st->bindParam(":postcode", $postcode, PDO::PARAM_STR);
        $st->bindParam(":mobiel", $mobiel, PDO::PARAM_STR);
        $st->bindParam(":website", $website, PDO::PARAM_STR);

        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        header("Location: /acgegevens");
    }

    public static function downloadUser($id) {
        $pdo=self::connect();

        $st = $pdo->prepare("SELECT username, voornaam, achternaam, email, straat, plaats, postcode, mobiel, website FROM users WHERE uid=:id");
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        $user = $st->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function logout() {
        session_start();
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        header('Location: /index.php');
    }

    public static function uploadElementOp($titel, $inputType, $type) {
        $pdo = self::connect();

        // check if there are any spaces
        $titel = str_replace(' ', '_', $titel);

        // upload elements voor salland
        $table = $type."s";

        switch ($inputType) {
            case "date":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel date");
                break;
            case "time":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel time");
                break;
            case "txt":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel varchar(255)");
                break;
            case "valuta":
            case "int":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel int(255)");
                break;
        }

        $st->execute();

        // upload elements voor zwolle
        $table = $type."z";

        switch ($inputType) {
            case "date":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel date");
                break;
            case "time":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel time");
                break;
            case "txt":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel varchar(255)");
                break;
            case "valuta":
            case "int":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel int(255)");
                break;
        }

        $st->execute();

        echo "<script> location.href='formulier'; </script>";
    }

    // get elements from opdrachten
    public static function getElementsForm() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtens");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['Field']);
            echo "<div class='add-form-3'>".$table." <form class='move-element' method='post'><input type='submit' value='🠕' name='up'><input type='submit' value='🠗' name='down'><input type='hidden' value=''> <button type='button' class='deleteRow'>-</button></div>"."<br>";
            $i ++;
        }
    }

    // get elements from contact bedrijfgegevens
    public static function getElementsFormCont() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevenss");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['Field']);
            echo "<div class='add-form-3'>".$table."<button type='button' class='deleteRowC'>-</button></div>"."<br>";
            $i ++;
        }
    }

    // get elements from verborgenwaarden
    public static function getElementsFormVerb() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM verborgenwaardens");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['Field']);
            echo "<div class='add-form-3'>".$table."<button type='button' class='deleteRowV'>-</button></div>"."<br>";
            $i ++;
        }
    }

    public static function deleteElementOp($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE projectenopdrachtens DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE projectenopdrachtenz DROP COLUMN $column");
        $st->execute();
    }

    public static function deleteElementCo($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE contactbedrijfgegevenss DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE contactbedrijfgegevensz DROP COLUMN $column");
        $st->execute();
    }

    public static function deleteElementVe($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE verborgenwaardens DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE verborgenwaardenz DROP COLUMN $column");
        $st->execute();
    }

    public static function deleteElementExc($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM projectenopdrachtens WHERE project_id = $id");
        $st->execute();

        $st = $pdo->prepare("DELETE FROM projectenopdrachtenz WHERE project_id = $id");
        $st->execute();
    }

    public static function deleteElementUser($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM users WHERE uid = $id");
        $st->execute();
    }

    public static function deleteElementNews($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM feedback WHERE userID = $id");
        $st->execute();
    }    
    
    public static function deleteElementOldExc($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM oudeopdrachten WHERE project_id = $id");
        $st->execute();
    }


    public static function downloadEditUserLV(){    
        $pdo = self::connect();
        $st =  $pdo->prepare("SELECT * FROM users");
        $st->execute();

        $user=  $st->fetchAll(PDO::FETCH_ASSOC);


    return $user;
    }

    public static function editUserLV($uid, $user_lv){
        $pdo = self::connect();
        $st = $pdo->prepare("UPDATE users SET user_lv=:userlv WHERE uid=:id");
        $st->bindParam(":id", $uid, PDO::PARAM_STR);
        $st->bindParam(":userlv", $user_lv, PDO::PARAM_STR);
        $st->execute();
        header("Location: /adminpanel");
        }

}