<?php
require_once('../functions/dbConnection.php');
require '../functions/functions.php';

//inicio de la sesión.
session_start();

//Aquí, se manda a un enlace que cierra la sesión
echo '¿Quieres cerrar la sesión?<a href=../functions/logout.php> Pulsa aquí </a>';

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>Página</title>
    </head>
    <body>

                <div class="container d-flex justify-content-center align-items-center flex-column">
                    <header class="d-flex flex-column">
                     
                        <h1>
                            Bienvenido a tu inventario de, <?php echo "<p class='text-uppercase'>" .$_COOKIE['usercookie'] ."</p>"; ?>
                        </h1>
                        <?php
                        setlocale(LC_TIME, "spanish");
                        $fecha_act = strftime("%A, %d de %B de %Y");
                        ?>
                        <p><?= $fecha_act ?></p> 
                    </header>
                    <main class="">
                        <h2>
                            Estos son tus inventarios:
                        </h2>
                        <section>
                            <table class="table table-striped table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">C.Objeto</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Año</th>
                                        <th scope="col">Comentario</th>
                                        <th scope="col">C.Almacén</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $search = $db->prepare("SELECT * FROM objeto WHERE Codalmacen "
                                            . "IN (SELECT codalmacen FROM almacen WHERE codusuario = "
                                            . "(SELECT Codusuario FROM usuario WHERE Nomusuario = 'joelortiz')) "
                                            . "AND Codalmacen = " .$_GET['id']);

                        
                                    $search->execute();
                                    // Se recoge cada resultado y se lleva a la tabla
                                    while ($fetch = $search->fetch()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['Claveobjeto'] ?></td>
                                            <td><?php echo $fetch['Nombreobjeto'] ?></td>
                                            <td><?php echo $fetch['Estadoobjeto'] ?></td>
                                            <td><?php echo $fetch['Marca'] ?></td>
                                            <td><?php echo $fetch['Stock'] ?></td>
                                            <td><?php echo $fetch['Anio'] ?></td>
                                            <td><?php echo $fetch['Comentario'] ?></td>
                                            <td><?php echo $fetch['Codalmacen'] ?></td>
                                             <td>
                                            <div class="mt-2 text-center">
                                                
                                                 <a href="delete.php?id=<?php echo $id ?>" class="btn btn-danger">X</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-2 text-center">
                                                <button type="submit" class="btn btn-warning">
                                                    Actualizar
                                                </button>
                                            </div>
                                        </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                        <!--    <tr>
                                        <td>Producto 2</td>
                                        <td>Agotado</td>
                                        <td>Marca B</td>
                                        <td>50</td>
                                        <td>2021</td>
                                        <td>Comentario 2</td>
                                        <td>XYZ789</td>
                                        <td>
                                            <div class="mt-2 text-center">
                                                <button type="submit" class="btn btn-danger">
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-2 text-center">
                                                <button type="submit" class="btn btn-warning">
                                                    Actualizar
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-2 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    Entrar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>  --> 

                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>

                <?php
            
        
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>