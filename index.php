<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$database = "webpersonal";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $consulta = "select name_u, password_u FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $consulta);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name_u'];
                $password = $row['password_u'];
                $_SESSION["nombre"] = $name;
                $_SESSION["pass"] = $password;
                echo 'Nombre: ' . $name . '</br>';
                echo 'Contraseña: ' . $password . '</br>';
            }
        }
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $newPass = $_POST['newPass'];
        $_SESSION["id"] = $user_id;
        $id = $_SESSION["id"];
        $consulta = "update users SET password_u = '$newPass' where user_id = '$id'";
        $result = mysqli_query($conn, $consulta);
        if ($result === TRUE) {
            echo '<b>Nueva contraseña:</b> ' . $newPass;
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    </br></br>
    <a href="./greeting.php">Ir a la siguiente página</a>
    <form method="GET">
        <div class="container">
            <h3>Mostrar nombre y contraseña</h3>
            <label for="user_id"><b>ID</b></label></br>
            <input type="text" placeholder="ID de usuario" name="user_id" required></br></br>
            <button type="submit">Buscar</button>

        </div>
    </form>
    </br>
    </br>
    <h3>Cambiar contraseña</h3>
    <form method="POST">
        <div class="container">
            <label for="user_id"><b>ID</b></label></br>
            <input type="text" placeholder="ID de usuario" name="user_id">
            </br>
            <label for="pass"><b>Nueva contraseña</b></label></br>
            <input type="password" placeholder="Nueva contraseña" name="newPass"></br></br>
            <button type="submit">Ejecutar</button>
        </div>
    </form>
    <?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $maxId = "select * from users where user_id = (select max(user_id) from users);";
    $total_info = mysqli_query($conn, $maxId);
    if (mysqli_num_rows($total_info) > 0) {
        while ($row = mysqli_fetch_assoc($total_info)) {
            $GLOBALS['id'] = $row['user_id'];
            $id = $GLOBALS['id'];
            $GLOBALS['name'] = $row['name_u'];
            $GLOBALS['surname'] = $row['surname'];
            $GLOBALS['alias'] = $row['alias'];
            $GLOBALS['password'] = $row['password_u'];
            $pass = $GLOBALS['password'];
            echo '<ul>';
            echo '<li>' . $row['user_id'] . '</li>';
            echo '<li>' . $row['name_u'] . '</li>';
            echo '<li>' . $row['surname'] . '</li>';
            echo '<li>' . $row['alias'] . '</li>';
            echo '<li>' . $row['password_u'] . '</li>';
            echo '</ul>';
        }
        switch (true) {
            case (strlen($pass)) < 5:
                echo (strlen($pass));
                break;
            case (strlen($pass)) < 15:
                echo (strlen($pass));
                break;
            case (strlen($pass)) <  20:
                echo (strlen($pass));
                break;
            default:
                echo "La contraseña es mayor de 20";
        }
        // $delete = "delete from users where user_id = '$id'";
        // $finalDelete = mysqli_query($conn, $delete);
        // if($finalDelete === TRUE){
        //     echo "Usuario borrado";
        // }else{
        //     echo "Error updating password: " . $conn->error;
        // }
    }
}

    ?>

</body>

</html>