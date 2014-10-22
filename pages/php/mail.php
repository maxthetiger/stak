<?php

    function sendResetPassword($email, $pseudo, $token){
        include("phpMailer/PHPMailerAutoload.php"); //chargera les fichiers nécessaires

        $mail = new PHPMailer();        //Crée un nouveau message (Objet PHPMailer)
        $mail->CharSet = 'UTF-8';       //Encodage en utf8

        //INFOS DE CONNEXION
        $mail->isSMTP();                                    //On utilise SMTP
        $mail->Username = "machinchoseformation@gmail.com"; //nom d'utilisateur
        $mail->Password = "38Utc_Sd5KdI4sz0Gr2Y4g";         //mot de passe
        $mail->Host = 'smtp.mandrillapp.com';               //smtp.gmail.com pour gmail
        $mail->Port = 587;                                  //Le numéro de port
        $mail->SMTPAuth = true;                             //On utilise l'authentification SMTP ?
        //$mail->SMTPSecure = 'tls';                        //décommenter pour gmail

        //CONFIGURATION DES PERSONNES
        $mail->setFrom('account@stackode.com', 'Stackode !');                   //qui envoie ce message ? (email, noms)
        $mail->addReplyTo('account@stackode.com', 'Stackode !');        //à qui répondre si on clique sur "reply" (email, noms)
        $mail->addAddress($user['email'], $user['pseudo']);   //destinataire
        
        //CONFIGURATION DU MESSAGE
        $mail->isHTML(true);                                // Contenu du message au format HTML
        $mail->Subject = 'Réinitialisation de password sur Stackode !';         
        

        //le message
// URGENT
// Trouver le lien de la page
            $resetUrl = "http://localhost/stak/password_reset_2.php?email="
             . urlencode($email) . '&token=' . urlencode($token);

                                   //le sujet
            $mail->Body = 'Bonjour,<br /> Veuillez clicker sur le lien ci-dessous pour réinitialiser votre password:<br /><a href="'.$resetUrl.'">'.$resetUrl.'</a>';
            
        //envoie le message
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message envoyé!";
        }
    }
?>