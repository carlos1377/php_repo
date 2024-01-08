<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'carloseduardoorso1@gmail.com';
$mail->Password = 'fuvd vmzt fdon jedm';

$mail->SMTPSecure = '**tls**';
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->setFrom('carloseduardoorso1@gmail.com', 'Carlos Orso');
$mail->addAddress('yavet26495@watrf.com');
$mail->Subject = 'E-mail de teste';

$mail->Body = '<h1>Email enviado com sucesso!</h1><p>Parabéns, deu tudo certo!</p>';

if($mail->send()){
    echo 'email enviado';
}else{
    echo 'falha ao enviar o email';
}
?>
