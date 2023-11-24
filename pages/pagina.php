<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Página</title>
    </head>
    <body>
        <?php
        session_start();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // joel,joel
                $db = new PDO('mysql:host=localhost;dbname=inventariotalaveracollection', 'joel', 'joel');
            } catch (PDOException $e) {
                echo 'La página no está disponible actualmente';
                exit;
            }

            // recogemos los datos de usuario
            $nombre = htmlspecialchars($_POST["username"]);
            // codificar la contraseña a md5 (o utilizar password_hash)
            $password = htmlspecialchars($_POST["password"]);

            // sacar el usuario de la base de datos
            $checkUser = $db->prepare("SELECT codusuario, Nomusuario, Contraseñausuario FROM usuario WHERE Nomusuario = ? AND Contraseñausuario = ?");
            $checkUser->execute([$nombre, $password]);
            
            $count = $checkUser ->rowCount();
           
            if($count > 0){
                echo 'bien';
            } else {
                echo $count;
                echo 'mal';
            }
        } else {
            echo 'No se ha aprendido la página';
        }
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>