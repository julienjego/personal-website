<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
 
    // CONDITIONS NOM
    if ( (isset($_POST['nom'])) && (strlen(trim($_POST['nom'])) > 0) ):
        $nom = stripslashes(strip_tags($_POST['nom']));
    else:
        echo "Merci d'écrire un nom <br />";
        $nom = '';
    endif;
  
    // CONDITIONS EMAIL
    if ( (isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ):
        $email = stripslashes(strip_tags($_POST['email']));
    elseif (empty($_POST['email'])):
        echo "Merci d'écrire une adresse email <br />";
        $email = '';
    else:
        echo 'Email invalide :(<br />';
        $email = '';
    endif;
  
    // CONDITIONS MESSAGE
    if ( (isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0) ):
        $message = stripslashes(strip_tags($_POST['message']));
    else:
        echo "Merci d'écrire un message<br />";
        $message = '';
    endif;
  
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
 
 
    // PREPARATION DES DONNEES
    $ip           = $_SERVER['REMOTE_ADDR'];
    $hostname     = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $destinataire = "jego.jj@gmail.com";
    $objet        = "Contact à partir de julienjego.fr de " . $nom;
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
    $contenu     .= $message."\r\n\n";
    $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
    $contenu     .= "DLSAM : " . $hostname;
  
    $headers  = 'Message provenant' . ' de : ' . $email; // ici l'expediteur du mail
    /*$headers .= 'Content-Type: text/plain; charset="ISO-8859-1"; DelSp="Yes"; format=flowed \r\n';
    $headers .= 'Content-Disposition: inline \r\n';
    $headers .= 'Content-Transfer-Encoding: 7bit \r\n';
    $headers .= 'MIME-Version: 1.0';*/
     
 
    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($nom)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ):
        echo 'echec :( <br /><a href="index.html">Retour au formulaire</a>';
    // ENCAPSULATION DES DONNEES 
    else:
        mail($destinataire,$objet,utf8_decode($contenu),$headers);
        echo 'Message envoyé ! Merci. <a href="http://www.julienjego.fr">Retourner sur le site</a> ';
    endif;
 
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>