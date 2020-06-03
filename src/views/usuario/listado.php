<?php
    include_once '../../services/UsuarioService.php';
    $usuarioService = new UsuarioService();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../resources/barra-navegacion.css">
</head>
<body>
    <div class="topnav">
        <a href="../administrador/centro-mensajes.php">Centro de mensajes</a>
        <a class="active" href="../usuario/listado.php">Gestionar usuarios</a>
        <a href="../habitacion/habitaciones.php">Gestionar habitaciones</a>
        <a href="../paciente/pacientes.php">Gestionar pacientes</a>
        <a href="../recurso/gestionar.php">Gestionar recursos</a>
        <a href="../equipos/gestionar-equipos.php">Gestionar equipos</a>
        <a href="../usuario/logout.php" >Cerrar sesion</a>
    </div>

    <h1>Lista de usuarios</h1>
    <a href="registrar-admin.php"><button>Registar nuevo admin</button></a>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($usuarioService->getAll() as $i => $usuario) {
                    echo "<tr>";
                    echo "<td>".$usuario->getUsuario()."</td>";
                    echo "<td>".$usuario->getNombre()."</td>";
                    echo "<td>".$usuario->getEmail()."</td>";
                    echo "<td>".$usuario->getRol()."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>