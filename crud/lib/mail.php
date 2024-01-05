<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $mensagemHTML)
{

    require '../vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'carloseduardoorso1@gmail.com';
    $mail->Password = 'pbtf vlit ztcf rqbj';

    $mail->SMTPSecure = false;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('carloseduardoorso1@gmail.com', 'Carlos Orso');
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        echo 'email enviado';
        return true;
    } else {
        echo 'falha ao enviar o email';
        return false;
    }
}
?>