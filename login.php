<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Simple POS</title>
        <meta name="description" content="Custom Login Form Styling with CSS3">
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder">
        <meta name="author" content="Codrops">
        <link rel="shortcut icon" href="http://localhost/favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-1.js"></script>
		<style>
			body {
				background: #e1c192 url(images/wood_pattern.jpg);
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			<!-- Codrops top bar -->
			
			
			<section class="main">
			
				<form class="form-2" id="formlogin" action='login_validasi.php' method="POST">
				    <img src="images/logo.png" style="padding:20px" width="300px">
					<?php 
					if($_GET['error']==1)
					{
						echo "<div class='mssgBox'>";
						echo "Username dan Password Tidak Boleh Kosong!<br>";	
							
						echo "</div> <br>"; 
				
					}
					else if($_GET['error']==2)
					{
						echo "<div class='mssgBox'>";
						echo "<img src='images/attention.png'> <br><hr>";
						echo "Periksa Kembali Username dan Password Anda!<br>";	
							
						echo "</div> <br>"; 
				
					}
					?>
					<h1>
					<span class="sign-up">Login</span>
					<span class="log-in">Simple POS Management System</span></h1>
					<p class="clearfix uiBoxRed" background="pink" style="display:none;">
					   
					</p>
					
					<p class="clearfix">
					    <input name="username" id="username" placeholder="Username" type="text">
					</p>
					<p class="clearfix">
						<input name="password" id="password" placeholder="Password" class="showpassword" type="password">
					</p>
					<p class="opt">
					    
					</p>
					<p class="clearfix">   
						<input name="submit" value="Log in" type="submit">
					</p>
				</form>​​
			</section>
			
			
        </div>
		<!-- jQuery if needed -->
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>
    
</body></html>