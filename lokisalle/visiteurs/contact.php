
<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');

if(isset($_POST['mailform']))
{
	if(!empty($_POST['message']))
	{
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Lokisalle.com"<support@Lokisalle.com>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					
					<br />
					<u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
					<u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
					<br />
					'.nl2br($_POST['message']).'
					<br />
					
				</div>
			</body>
		</html>
		';

		mail("clemence.larrouy@gmail.com", "CONTACT - Lokisalle.com", $message, $header);
		$msg="<span style='color:green'>Votre message a bien été envoyé !</span>";
	}
	else
	{
		$msg="Tous les champs doivent être complétés !";
	}
}
?>


<div class="nouveauclient">
<h2>Contact</h2>

<p> Vous avez une question ou une demande spécial ? n'hesitez pas à vous envoyer un mail via ce formulaire </p>
    <form method="post" action="">

    
       
 
        
			<input type="text" name="nom" placeholder="Votre nom" value="<?php 
                if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />

            <input type="email" name="mail" placeholder="Votre email" value="<?php 
                if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />

            <textarea name="message" placeholder="Votre message"><?php 
            if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />

            

			<input type="submit" value="Envoyer !" name="mailform"/>

    </form>
		<?php
		if(isset($msg))
            {
	            echo $msg;
            }
	
		?>
	</div>


<?php 
include('../templates/footer.php');
?>
