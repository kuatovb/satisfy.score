<h2 align="center">Старница авторизации</h2>

<div class="row justify-content-center">
    <form class="col-md-6 p-4 form-auth" action="/act/login" method="POST">
      <div class="row mb-4 mt-3">
        <div class="col-md-12">
            <span></span>
            <div class="input-field">
              <input id="login" placeholder="Логин" name="login" type="text" class="_req" autocomplete="off">
            </div>            
        </div>
      </div>
      <div class="row mb-4 mt-4">
        <div class="col-md-12">
            <div class="input-field">
              <input id="password" placeholder="Пароль" type="password" max="5" min="3" name="password" class="_req" autocomplete="off">
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="input-field input-check">
               <label>
                <input type="checkbox" name="remember" id="remember" />
                <span>Запомнить меня</span>
              </label>
            </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-3">
            <div class="input-field">
              <button class="waves-effect waves-light btn blue accent-4" type="submit">Войти</button>
            </div>            
        </div>
        <div class="col-md">
          <ul class="form__footer-list center-align">
            <li><a href="/main/register">Регистрация</a></li>
          </ul>
        </div>
      </div>
    </form>
</div>