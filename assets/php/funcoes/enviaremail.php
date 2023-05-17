 <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    function enviarEmail($nome, $email, $msg)
    {
        require '../lib/vendor/autoload.php';

        $mail = new PHPMailer(true); //utilizando PHPMailer para envio de email

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('junior.js87@gmail.com');
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'junior.js87@gmail.com';
        $mail->Password = 'xiccbkvhskwrtqds';
        $mail->Port = 587;

        $mail->setFrom('junior.js87@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Mensagem de: $nome";
        $mail->Body = $msg;

        if ($mail->send()) { //se a função send do PHPMailer não for definida, apresenta erro
            return $nome;
        } else { // se a função send realizar o envio sem problemas, mostra um agradecimento
            return $mail->ErrorInfo;
        }
    }
    ?>