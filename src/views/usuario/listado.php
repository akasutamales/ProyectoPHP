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
</head>
<body>
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