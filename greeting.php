<?php
session_start();
$nombre = $_SESSION['nombre'];
$password = $_SESSION["pass"];
define("GREETING", "Hola, " . $nombre);
define("PASS", "Tu contraseña es: " . $password);
define("ADVICE", "Contraseña poco segura, deberías cambiarla");
$array = array(constant("GREETING"), constant("PASS"), constant("ADVICE"));
function replace($array)
{
    if (isset($_GET['letter1']) and isset($_GET['letter2'])) {
        $originalLetter = '/' . $_GET['letter1'] . '/';
        $newLetter = $_GET['letter2'];
        $count = 0;
        foreach ((array) $array as $element) {
            do {
                echo '<ul>';
                echo '<li>' . preg_replace($originalLetter, $newLetter, $element) . '</li>';
                echo '</ul>';
                $count++;
            } while ($count = 0);
        }
    }
}
replace($array);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="GET">
        <div class="container">
            <label for="letter1"><b>Letra original</b></label>
            <input type="text" placeholder="Letra a sustituir" name="letter1" required>
            <label for="letter2"><b>Letra nueva</b></label>
            <input type="text" placeholder="Nueva letra" name="letter2" required>
            <button type="submit">Sustituir</button>
        </div>
    </form>
</body>

</html>