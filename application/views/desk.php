<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main" role="main" class="main main-desk clearfix">
	<section class="content">
		<article>
			<h2>SERVICII VIRTUAL DESK</h2>
			<h3 class="h3-desk">Formular de înregistrare</h3>
			<div class="loading"></div>
			<p class="inregistrare-mesaj">Mesaj</p>
			<form action="" id="form-inregistrare" method="post">
				<label for="nume">Nume</label><br>
				<input type="text" name="nume" id="nume" value=""><br>
				<label for="prenume">Prenume</label><br>
				<input type="text" name="prenume" id="prenume" value=""><br>
				<label for="telefon">Telefon</label><br>
				<input type="text" name="telefon" id="telefon" value=""><br>					
				<label for="email">Email</label><br>
				<input type="text" name="email" id="email" value=""><br>
				<label for="parola">Parola</label><br>
				<input type="password" name="parola" id="parola" value=""><br>
				<label for="captcha">Captcha</label><br>
				<div class="img-captcha"><?php echo $captcha; ?></div>
				<i class="refresh-captcha"><img src="<?php echo base_url('/public/img/refresh.svg'); ?>" width="24" height="24" alt="Refresh captcha" title="Refresh captcha" border="0" /></i>
				<input type="text" name="captcha" id="captcha" value=""><br>
				<input type="submit" value="ÎNREGISTREAZĂ">
			</form>	
		</article>
		
		<article>
			<h3 class="h3-desk">Autentificare</h3>
			<p class="autentificare-mesaj error">Mesaj</p>
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