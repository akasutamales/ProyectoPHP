<?php
    include_once '../../services/RecursoService.php';
    $recursoServices = new RecursoService();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peticiones</title>
</head>
<body>
    <?php

        $recursos = $recursoServices->getALL();

        echo "<select>";
        
        foreach ($recursos as $i => $r) {
            echo "<option>". $r->getNombre() ."</option>";
        }
        echo "</select>";

        echo "<input type='text' name='cantidad' placeholder='cantidad'> "; 

        
    
    
    ?>
</body>
</html>