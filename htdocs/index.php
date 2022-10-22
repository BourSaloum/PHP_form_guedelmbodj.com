<?php
    $firstname = $name =$email = $phone =$message = "";
    $firstnameError = $nameError =$emailError = $phoneError =$messageError = "";
    $isSuccess = false;
    $emailTo = "macoumba@guedelmbodj.com";

    if ($_SERVER ["REQUEST_METHOD"] == "POST")
    {
        $firstname=$_POST["firstname"];
        $name=$_POST["name"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $message=$_POST["message"];
        $isSuccess = true;
        $emailText="";

        if(empty($firstname))
        {
            $firstnameError = "Halte là ! Déclinez votre identité !";
            $isSuccess = false;
        }
        else
        {    
            $emailText .= "Firstname: $firstname\n";
        }
        
        if (empty($name))
        {
            $nameError = "Oulah ! Votre nom s'il vous plaît ";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Name: $name\n";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {   
            $emailError = "Aucun risque que je vous spamme. Votre email s'il vous plait";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Email: $email\n";
        }

        if(empty($phone))
        {
            $phoneError = "Rassurez-moi, votre numéro n'est pas top secret";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Phone: $phone\n";
        }

        if(empty($message))
        {
            $messageError = "Ca ne tombe pas dans l'oeil d'un aveugle. Dites quelque chose au moins :)";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Message: $message\n";
        }

        if ($isSuccess)
        {
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailTo, "Depuis guedelmbodj.com", $emailText, $headers);
            $firstname = $name =$email = $phone =$message = "";
        }

    }   

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styleform.css">
    </head>
    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="firstname" class="form-label">Prénom <span class="blue">*</span></label>
                        <input id="firstname" type="text" name="firstname" required class="form-control" placeholder="Votre prénom" value=<?php echo $firstname; ?>>
                        <p class="comments"><?php $firstnameError ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="name" class="form-label">Nom <span class="blue">*</span></label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="Votre Nom" value=<?php echo $name; ?>>
                        <p class="comments"><?php $nameError; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="form-label">Email <span class="blue">*</span></label>
                        <input id="email" type="email" required name="email" class="form-control" placeholder="Votre Email" value=<?php echo $email; ?>>
                        <p class="comments"><?php $emailError; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input id="phone" type="tel" name="phone" class="form-control" placeholder="Votre Téléphone" value=<?php echo $phone;?>>
                        <p class="comments"><?php $phoneError; ?></p>
                    </div>
                    <div>
                        <label for="message" class="form-label">Message <span class="blue">*</span></label>
                        <textarea id="message" required name="message" class="form-control" placeholder="Votre Message" rows="4"><?php echo $message; ?></textarea>
                        <p class="comments"><?php $messageError; ?></p>
                    </div>
                    <div>
                        <p class="blue"><strong>* Ces informations sont requises.</strong></p>
                    </div>
                    <div>
                        <input type="submit" class="button1" value="Envoyer">
                    </div>    
                </div>
                <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none'; ?>">Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>
            </form>
        </div>
    </body>
</html>