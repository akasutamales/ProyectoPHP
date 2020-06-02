<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
    Cedula: <input type="text" name="cedula" >
    <br><br>
    Nombre: <input type="text" name="nombre" >
    <br><br>
    Diagnostico: <input type="text" name="diagnostico" >
    <br><br>
    Prioridad: <input type="text" name="prioridad" >
    <br><br>
    Fecha Ingreso<input type="date" name="fecha_ingreso" >
    <br><br>
    Estadia: <input type="number" name="estadia" >
    <br><br>
    Doctor Asignado: <input type="number" name="medico_id" >
    <br><br>
    Cama Asignada: <input type="number" name="cama_id" >
    <br><br>
    <input type="submit" name="add" value="Agregar Paciente">
    </form>

    <a href="pacientes.php">volver</a>
</body>
</html>