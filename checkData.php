<?php
$path = "scriptCredenziali.php";
include($path);
include("login.php");
echo "Ciao ". $_COOKIE["user"] ."<br/>";
echo "visite: ". $_COOKIE["session"] ."<br/>";
?>
<html>
<head>
    <title>Verifica delle credenziali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="stileLogin.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Pagina di verifica credenziali.</h1>
    <form>
        <div class="container">
            <?php
            if (isset($_CREDENZIALI[$_POST["username"]])) {
                if ($_POST["psw"] == $_CREDENZIALI[$_POST["username"]]) {
                    echo "<div class=\"container\"><h2>Benvenuto nella tua area dedicata, </h2>";
                    echo "<h1 style=\"color:green\">" . $_POST["username"] . "</h1>";
                    echo "</div>";

/*                  if(exist("voti.txt") == true){
                        $handle = fopen("voti.txt",'r');
                        $voti = split(fread($handle, filesize("voti.txt")),"\n");
                        for(n=0 ; n<$voti.length()) ; n++){
                            if(strstr($voti[n],':',true) == $_POST["username"]){
                                echo "<h2 style=\"color:orange\>Voti". strstr($voti[n],':') ."</h2>"
                            }
                        }
                    }
*/
            $path = "voti.txt";
            $voti;
            if ($file = fopen($path, "r")) {
                while (!feof($file)) {
                    $line = fgets($file);
                    $user = substr($line, 0, strpos($line, ":"));
                    $loggedUser;
                    if (isset($_COOKIE["user"])) {
                        $loggedUser = $_COOKIE["user"];
                    } else {
                        $loggedUser = $_POST["username"];
                    }
                    if ($user == $loggedUser) {
                        $voti = substr($line, strpos($line, ":") + 1, strlen($line));
                        $arrayStr = explode(';' , $voti);
                        for(n=0 ; n<$arrayStr.lenght() ; n++ )
                        $arrayVoti = strstr($arrayStr[n],'-', true); //prende ciò che si trova prima del carattere selezionato
                        $arrayDate = strstr($arrayStr[n],'-'+1); //prende ciò che si trova dopo del carattere selezionato
                        break;
                    }
                }
                fclose($file);
            } else {
                echo "Impossibile aprire il file";
            }

            if (isset($_COOKIE["user"])) {
                echo "<div class=\"container\"><h2>Benvenuto nella tua area dedicata, </h2>";
                echo "<h1 style=\"color:green\">" . $_COOKIE["user"] . "</h1>";
                echo "<table><tr><th>Voto</th></tr>";
                foreach($arrayVoti as $voto && $arrayDate as $data){
                    echo "<tr>";
                    echo "<td>";
                    echo $voto;
                    echo "</td>";
                    echo "<td>";
                    echo $data;
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>"
                echo "<h2 style=\"color:orange\>Voti: ". $voti ."</h2>"
                echo "</div>";
            } else {
                if (isset($_CREDENZIALI[$_POST["username"]])) {
                    if ($_POST["psw"] == $_CREDENZIALI[$_POST["username"]]) {
                        setcookie("user", $_POST["username"], time() + (60 * 60));
                        echo "<div class=\"container\"><h2>Benvenuto nella tua area dedicata, </h2>";
                        echo "<h1 style=\"color:green\">" . $_POST["username"] . "</h1>";
                        echo "</div>";
                    } else {
                        echo "<img src=\"https://i0.wp.com/vincenttechblog.com/wp-content/uploads/2018/02/lock-pc-wrong-password.jpg?ssl=1\" class =\"avatar\">";
                        echo "<h2 style=\"color:red\">Password errata!</h4>";
                    }
                } else {
                    echo "<img src=\"https://i0.wp.com/vincenttechblog.com/wp-content/uploads/2018/02/lock-pc-wrong-password.jpg?ssl=1\" class =\"avatar\">";
                    echo "<h2 style=\"color:red\">Password errata!</h4>";
                    echo "<img src=\"https://roundhouse-assets.s3.amazonaws.com/assets/Image/15214-fitandcrop-1200x681.jpg\" class =\"avatar\">";
                    echo "<h2 style=\"color:orange\">Utente non trovato!</h4>";
                }
            } else {
                echo "<img src=\"https://roundhouse-assets.s3.amazonaws.com/assets/Image/15214-fitandcrop-1200x681.jpg\" class =\"avatar\">";
                echo "<h2 style=\"color:orange\">Utente non trovato!</h4>";
            }

            echo "<div class=\"container\" style=\"background-color:#f1f1f1\"";
            echo "<span class=\"psw\">Torna al <a href=\"/esercizi/loginForm.php\">login</a></span></div>";
            echo "<span class=\"psw\">Esegui <a href=\"logout.php\">logout</a></span></div>";
            ?>
        </div>

    </form>
</body>
</html>