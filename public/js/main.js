var navBtn = false;
$(document).ready(function () {
    $(".nav-btn").on('click', function () {
        if (!navBtn) {
            $(".nav-btn").addClass("nav-btn-active");
			$("ul.dropdown, ul.dropdown li").css("display", "block");
			navBtn = true;
        } else {
			 $(".nav-btn").removeClass("nav-btn-active");
			 $("ul.dropdown, ul.dropdown li").css("display", "none");
			 navBtn = false;
		}
    });
	
	$("#form-submit").submit(function(){
		alert('Form is submitting....');
	return false;
	});
	
	
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailAddress);
	};	
	
	function mesaj() { 
		$(".inregistrare-mesaj").css("display", "block");
		$(".inregistrare-mesaj").addClass("error");	
	}
	
	$("#form-inregistrare").submit(function(){
		$(".loading").css("display", "block");
		$(".inregistrare-mesaj").css("display", "none");
		$('#nume, #prenume, #telefon, #email, #parola, #captcha').css("border", "1px solid #333");
		
		var nume = $('#nume').val();
		var prenume = $('#prenume').val();
		var telefon = $('#telefon').val();
		var email = $('#email').val();
		var parola = $('#parola').val();
		var captcha = $('#captcha').val();
		
		if( !nume ) {
			$('#nume').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Numele nu este valid.");
			$(".loading").css("display", "none");
			return false;
		}
		
		if( !prenume ) {
			$('#prenume').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Prenumele nu este valid.");
			$(".loading").css("display", "none");
			return false;
		}		

		if( !telefon || (telefon.length > 10 || telefon.length < 3) || !telefon.match(/^[0-9-+]+$/)) {
			$('#telefon').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Telefonul nu este valid. (maxim 10 caractere, accepta doar numere)");
			$(".loading").css("display", "none");
			return false;
		}	

		if( !email || !isValidEmailAddress( email )) {
			$('#email').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Email nu este valid.");
			$(".loading").css("display", "none");
			return false;
		}
		
		if( !parola || parola.length < 8 || !parola.match(/[0-9]/)) {
			$('#parola').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Parola nu este valida. (8 caractere si minim o cifra)");
			$(".loading").css("display", "none");
			return false;
		}
		
		if( !captcha || parola.captcha < 2 ) {
			$('#captcha').css("border", "1px solid #DC3C00");
			mesaj();
			$(".inregistrare-mesaj").html("Captcha nu este valida.");
			$(".loading").css("display", "none");
			return false;
		}		
		
			
		event.preventDefault();	
		$.ajax({
			'url' : 'desk/inregistrare',
			'type' : 'POST', 
			'data' : { 'action' : 'inregistrare', 'nume' : nume, 'prenume' : prenume, 'telefon' : telefon, 'email' : email, 'parola' : parola, 'captcha' : captcha },
			'success' : function(data){ 
				console.log(data);
				$(".inregistrare-mesaj").css("display", "block");
				var jsonObj = JSON.parse(data);
				$(".inregistrare-mesaj").html(jsonObj['msg']);
					if (jsonObj['result']) {
						$(".inregistrare-mesaj").removeClass("error");
						$(".inregistrare-mesaj").addClass("succes");
						$("#form-inregistrare").css("display", "none");
					} else {
						$(".inregistrare-mesaj").addClass("error");
					}
				$(".loading").css("display", "none");
				return false;				
			},
			'error' : function(data){
				$(".inregistrare-mesaj").css("display", "block");
				$(".inregistrare-mesaj").html("data");
				$(".inregistrare-mesaj").addClass("error");
				$(".loading").css("display", "none");
				return false;
			}
			
			
		});
	return false;
	});	
	
	$('.refresh-captcha').click(function(event){
        event.preventDefault();
        $.ajax({
           url:'desk/refresh_captcha?'+Math.random(),
           success:function(data){
              $('.img-captcha').html(data);
           }
        });            
    });	
});