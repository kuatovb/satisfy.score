<?php
$recaptcha = new library\Recaptcha();

 ?>
 <style type="text/css">
     .form-signin{
        max-width: 330px;
        padding: 1rem;
        border-radius: 7px;
        margin-right: auto;
        margin-left: auto;
        margin-top: 100px;
     }
 </style>
    <!-- <div id="server_mess"></div> -->
    <!-- Flexbox container for aligning the toasts -->


    <form class="form-signin bg-light text-center shadow-lg" method="POST" action="/mvc/app.php">
        <img class="mb-4" src="../assets/img/logo.svg" alt="" width="200">
       
        <label class="sr-only" for="inlineFormInputGroupUsername">Login</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" minlength="4" required="" name="login" class="form-control" id="inlineFormInputGroupUsername" placeholder="Login" autofocus="" >
        </div>


        <label class="sr-only" for="inlineFormInputGroupPassword">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" minlength="8" required="" name="password" class="form-control" id="inlineFormInputGroupPassword" placeholder="Password" >
        </div>

        <div class="input-group mt-2">
            <div class="g-recaptcha" width="200" data-sitekey="<?php echo $recaptcha->g_public_key; ?>"></div>
        </div>
        
        <input class="btn btn-lg btn-primary btn-block mt-4" type="submit" id="submit" value="Войти">
        <p class="mt-5 mb-3 text-muted">© <?php echo date('Y'); ?> Bikada</p>
    </form>

<script type="text/javascript">
	$(document).ready(function() {
         
        $('#server_mess').toast('hide');

		$('form').submit(function(event) {  
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: 'text',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#submit').prop("disabled", true);
                },
                success: function(result){
                    if (result == 'true') {
                        window.location.href = '/mvc/panel';
                        $('#server_mess').toast('hide');
                        return true;
                    }
                 $('#server_mess').toast('show');
                    // $("#server_mess").data('autohide', 'false');
                    $('#server_mess_text').html(result);
                    // if (result == 'ok') {
                    // 	alert('123');
                    // }
                    
                    setTimeout(function(){
                    	$('#submit').prop("disabled", false);             
                    	// $("#server_mess").hide(800);
                        $("#server_mess").data('autohide', 'true');
                    }, 3 * 1000);                        
                    
                }
            });
            
        });


      
	});
</script>