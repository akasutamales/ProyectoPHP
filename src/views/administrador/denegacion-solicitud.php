<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  include_once '../../../vendor/phpmailer/phpmailer/src/Exception.php';
  require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
  include_once '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

  $mail = new PHPMailer();

  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "akasutamales@gmail.com";
  $mail->Password   = "ByakuganHachibi";
  $mail->IsHTML(true);
  
?>

<?php

    include_once '../../services/SolicitudService.php';
    include_once '../../services/PacienteService.php';
    include_once '../../services/UsuarioService.php';
    include_once '../../services/EquipoService.php';
    $solicitudService = new SolicitudService();
    $pacienteService = new PacienteService();
    $medicoService = new UsuarioService();
    $equipoService = new EquipoService();

    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $params);

    $solicitud = $solicitudService->findById( $params['solicitud']);
    $paciente = $pacienteService->findById( $solicitud->getPaciente());
    $medico = $medicoService->findById( $solicitud->getMedico());
    $equipo = $equipoService->findById( $solicitud->getEquipo());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $exito = $solicitudService->rechazar($solicitud->getId());
        if( $exito ){ 

            // Método 1
            $mensaje = "La solicitud del equipo " . $equipo->getCodigo() . " fue rechazada."
            . "\n\nAtentamente, Akasutamales.";
            $mensaje=wordwrap($mensaje,70,"\n");
            if(mail($medico->getEmail(),"Solicitud rechazada",$mensaje)){
                echo "La solicitud fue rechazada, se notifico al correo " . $medico->getEmail()."<br>";
            }else{
                echo "Error en el envío del correo<br>";
            }

            /** Método 2 */
            /*$mail->AddAddress($medico->getEmail(), $medico->getNombre());
            $mail->SetFrom("akasutamales@gmail.com", "Akasutamales");
            $mail->Subject = "Solicitud rechazada";
            $content = $mensaje;

            $mail->MsgHTML($content); 
            if($mail->Send()) {
                echo "La solicitud fue rechazada, se notifico al correo " . $medico->getEmail()."<br>";
            } else {
                echo "Error en el envío del correo<br>";
            }*/

        }else{
            echo "ERROR: no se pudo procesar la solicitud<br>";
        }
    ?>
</body>
</html>