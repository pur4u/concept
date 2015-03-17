<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main" role="main" class="main main-desk clearfix">
	<section class="content">
		<article>
			<h3 class="h3-desk">Autentificare</h3>
			<?php echo (isset($error) && $error != NULL) ? '<p style="display: block;" class="autentificare-mesaj error">' . $error . '</p>' : '' ; ?>
			<form action="<?php echo base_url('/autentificare/autentificare_process'); ?>" id="form-autentificare" method="post">					
				<label for="email">Email</label><br>
				<input type="text" name="email" id="email" value=""><br>
				<label for="parola">Parola</label><br>
				<input type="password" name="parola" id="parola" value=""><br>
				<input type="submit" value="AutentificĂ-te">
			</form>	
		</article>		
	<br>
	</section>
	<aside class="sidebar">
		<div class="sidebar-office365 clearfix">
			<img alt="Office365" src="<?php echo base_url('/public/img/office365.png'); ?>" width="157" height="36" />
			<p class="text1">PENTRU FIRME MEDII</p>
			<p class="text2">€12,30</p>
			<p class="text3">LUNAR / UTILIZATOR</p>
			<p class="text4">Maxim 300 de utilizatori<br>Serviciu de e-mail găzduit<br>Conferințe web<br>Mesagerie instant</p>
			<p class="text5"><a target="_blank" href="#">VREAU O OFERTĂ</a></p>
		</div>
		<p class="text6"><a target="_blank" href="#">Versiune de test gratuită</a></p>
					
		<div class="sidebar-player clearfix">
			<h4>Urmărește cum îți <br>poți simplifica afacerea!</h4>
			<p class="player"></p>
		</div>
	</aside>	
</div>