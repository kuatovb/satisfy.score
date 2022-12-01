
<h1 class="center">Страница регистрации</h1>

<div class="alert"></div>

<div class="row justify-content-center">
   <form class="col-md-6 p-4 form-register" action="/act/register" method="post">
     <div class="row mb-4 mt-3">
       <div class="col-md-12">
           <span></span>
           <div class="input-field">
             <input id="full_name" placeholder="Ваше полное имя" name="full_name" type="text" class="validate" required autocomplete="off">
           </div>            
       </div>
     </div>
     <div class="row mb-4 mt-3">
       <div class="col-md-12">
           <span></span>
           <div class="input-field">
             <input id="login" placeholder="Логин" name="login" type="text" class="validate" required autocomplete="off">
           </div>            
       </div>
     </div>
     <div class="row mb-4 mt-4">
       <div class="col-md-12">
           <div class="input-field">
             <input id="password" placeholder="Пароль" type="password" name="password" required class="validate" autocomplete="off">
           </div>
       </div>
     </div>
     <div class="row mb-4 mt-4">
       <div class="col-md-12">
           <div class="input-field">
             <input id="password_again" placeholder="Повторите пароль" type="password" name="password_again" required class="validate" autocomplete="off">
           </div>
       </div>
     </div>

     <input type="hidden" name="token" value="<?=$Token::generate()?>">
     <div class="row">
       <div class="col-md-3">
           <div class="input-field">
              <button class="waves-effect waves-light btn blue accent-4" type="submit">Зарегистрироватся</button>
           </div>            
       </div>
     </div>
   </form>
 </div>

 <script type="text/javascript"></script>