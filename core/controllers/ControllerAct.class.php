<?php

namespace controllers;

use base\View;
use base\Controller;
use library\Config;
use library\Input;
use library\Validate;
use library\Token;
use library\Session;
use library\Hash;
use library\Redirect;
use library\File;
use library\Db;
use models\User;

class ControllerAct extends Controller
{
    private $db;
    public function __construct()
    {
        // подключение к базе данных
        $this->db = Db::getInstance();
    }

    public function actionIndex()
    {
        echo '123';
    }

    // этот метод регистриреут пользователя
    public function actionRegister()
    {
        // Input::exists() проверяет на наличие $_POST или $_GET

        if (Input::exists()) {

            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'full_name' => array(
                        'input_name' => 'Full name',
                        'required' => true,
                        'min' => 2,
                        'max' => 30,
                    ), 
    
                    'login' => array(
                        'input_name' => 'Login',
                        'required' => true, 
                        'min' => 4,
                        'max' => 10,
                        'unique' => 'users'
                    ), 
    
                    'password' => array(
                        'input_name' => 'Password',
                        'required' => true, 
                        'min' => 8, 
                    ),
                    'password_again' => array(
                        'input_name' => 'Pass confirm',
                        'errorMessage' => 'Пароли не совпадают',
                        'required' => true, 
                        'matches' => 'password', 
                    ), 
                ));
    
                
                if ($validation->passed()) {

                    $user = new User();

                    $salt = Hash::salt(32);

                    try {
                        $user->create(array(
                            'full_name' => Input::get('full_name'),
                            'login' => Input::get('login'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'salt' => $salt,
                            'group_id' => 4,
                        ));
                        // Session::flash('home', 'Вы зарегистрировались и теперь можете войти в систему!');
                        echo "Вы зарегистрировались и теперь можете войти в систему!";
                        // Redirect::to('http://satisfy.news/main');
                        
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }

                }else{
    
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
    
                }
            }else{
                echo "Неверный токен!";
            }


        }
    }


    public function actionLogin()
    {

        $user = new User();

        if ($user->isLoggedIn()) {
            exit('Вы уже авторизованы!');
        }

        if (Input::exists()) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'login' => array(
                    'input_name' => 'Login',
                    'required' => true,
                ), 

                'password' => array(
                    'input_name' => 'Password',
                    'required' => true,
                ),
            ));

            if ($validate->passed()) {
                // var_dump(Input::get('remember'));
                // die();
                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('login'), Input::get('password'), $remember);
                // die($login);
                if ($login) {
                    // Redirect::to('/');
                    // $msg =  array('msg' => 'OK!');
                    // echo Session::get(Config::get('session.sesioName'));
                    // echo $user->data()->login;
                    echo "auth success!";

                    // Session::flash('home', 'Вы вошли!');
                    // Redirect::to('/');
                }else {
                    // $msg =  array('msg' => 'Login failed!');
                    echo "Login failed!";
                }

            }else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }
    }

    public function actionUpdate()
    {
        
        
        $user = new User();
        
        if (!$user->isLoggedIn()) {
            Redirect::to('/');
        }
        

        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'full_name' => array(
                        'input_name' => 'Full name',
                        'required' => true,
                        'min' => 2,
                        'max' => 50,
                    )
                ));

                if ($validation->passed()) {
                    try {
                        $user->update(array(
                            'full_name' => Input::get('full_name'),
                        ));

                        // Session::flash('home', 'Ваши контактные данные были обновлены!');
                        // Redirect::to('/');
                        echo "Ваши контактные данные были обновлены!";

                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }
                }else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }
            }
        }
    }

    public function actionChangePassword()
    {
        $user = new User();
        if (!$user->isLoggedIn()) {
            Redirect::to('/');
        }

        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'password_current' => array(
                        'input_name' => 'password_current',
                        'required' => true,
                        'min' => 8,
                    ),
                    'password_new' => array(
                        'input_name' => 'password_new',
                        'required' => true,
                        'min' => 8,                        
                    ),
                    'password_new_again' => array(
                        'input_name' => 'password_new_again',
                        'errorMessage' => 'Пароли не совпадают',
                        'required' => true,
                        'min' => 8,
                        'matches' => 'password_new'            
                    ),
                ));

                if ($validation->passed()) {
                    if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                        echo 'Ваш текущий пароль неверен';
                    }else {
                        $salt = Hash::salt(32);

                        $user->update(array(
                            'password' => Hash::make(Input::get('password_new'), $salt),
                            'salt' => $salt
                        ));

                        // Session::flash('home', 'Ваш пароль был изменен!');
                        // Redirect::to('/');
                        echo "Ваш пароль был изменен!";

                    }
                }else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }

            }
        }
    }

    public function actionLogout()
    {
        $user = new User();

        if ($user->isLoggedIn()) {
            $user->logout();
            Redirect::to('/');
        }else{
            Redirect::to(404);
        }

    }

    
    public function actionManageFlowers()
    {
        $user = new User();

        if (Input::exists()) {
            if (Input::get('manageData') == "addFlowers") {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'title' => array(
                        'input_name' => 'Заголовок новости',
                        'required' => true,
                        'min' => 8,
                        'unique' => 'flowers'
                    ),
                    'text' => array(
                        'input_name' => 'Описание новости',
                        'required' => true,
                        'min' => 300,                        
                    ),
                ));

                if ($validation->passed()) {


                        
                    if ( File::upload('img', 'uploads/img/') ) {

                        

                        $fields = array(
                            'title' => Input::get('title'), 
                            'text' => Input::get('text'), 
                            'img_name' => File::getNewFileName(), 
                            'author_id' => $user->data()->id, 
                            'category_id' => Input::get('category_id'), 
                        );

                        if (!$this->db->insert('flowers', $fields)) {
                            throw new \Exception('Возникла проблема при создании записи!');            
                        }else {
                            echo 'Запись успешно создано';
                        }
                    }else {
                        echo 'err';
                    }
                     


                }else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }

            }

            if (Input::get('manageData') == "updateFlowers") {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'title' => array(
                        'input_name' => 'Заголовок',
                        'required' => true,
                        'min' => 8,
                    ),
                    'text' => array(
                        'input_name' => 'Описание',
                        'required' => true,
                        'min' => 300,                        
                    ),
                ));

                if ($validation->passed()) {


                        
                    if ( File::upload('img', 'uploads/img/') ) {

                        $fields = array(
                            'title' => Input::get('title'), 
                            'text' => Input::get('text'), 
                            'img_name' => File::getNewFileName(), 
                            'author_id' => $user->data()->id, 
                            'category_id' => Input::get('category_id'), 
                        );

                        if ($this->db->update('flowers', Input::get('id'), $fields)) {
                            echo 'Запись успешно обнавлено';
                        \debug($this->db);
                        exit();
                        } else {
                            echo 'возникла проблема при оьновлении данных';
                        }




                    }else {
                        echo 'err';
                    }
                     


                }else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }

            }
            
        }
    }

    public function actionBuyFlower()
    {
        
        $Order = new \models\Order();

        if (Input::exists()) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'full_name' => array(
                    'input_name' => 'Имя',
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                ),

                'tel' => array(
                    'input_name' => 'Телефон',
                    'required' => true,
                    'min' => 10,
                )
            ));

            if ($validation->passed()) {
                try {
                    $Order->create(array(
                        'full_name' => Input::get('full_name'),
                        'tel' => Input::get('tel'),
                        'product_id' => Input::get('product_id'),
                    ));

                    // Session::flash('home', 'Ваши контактные данные были обновлены!');
                    // Redirect::to('/');
                    echo "Ваша заявка отправлена!";

                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }
    }


    public function actionGetFlowers()
    {
        $user = new \models\User();
        $Flowers = new \models\Flowers();

        // \debug($news->get('all_news'));
        // exit();
        
		foreach ($Flowers->get('all_flowers') as $data) : ?>
	
        <article class="col-md-4 col-sm-12">
          <div class="card">
            <div class="card-image">
              <img src="/public/uploads/img/<?=$data['img_name']?>" style="object-fit: cover; max-height: 255px;">


                      <?php
                      //  if ($user->hasPermission('author')) :					
                        //    if ($data['login'] == $user->data()->login) :
                      ?>
                          <!-- <a class="btn-floating halfway-fab waves-effect waves-light modal-trigger" onclick="manageData('get', <?=$data['id']?>);" href="#manageNews"><i class="material-icons">edit</i></a> -->
                              <?php // endif; ?>
                        <?php // endif; ?>

                      <?php if ($user->hasPermission('moderator')) :?>
                          <a class="btn-floating halfway-fab waves-effect waves-light modal-trigger" onclick="manageData('get', <?=$data['id']?>);" href="#manageFlowers"><i class="material-icons">edit</i></a>
                    <?php  endif;?>
            </div>
            <div class="card-content">
                <h2 class="card-title" title="<?=$data['title']?>">
                    <a href="/main/flowers?id=<?=$data['id']?>">
                        <?=$data['title']?>
                    </a>
                </h2>
                <p class="card-desc">
                    <?=mb_substr($data['text'], 0, 200, 'utf-8')?>...
                </p>
                <br>
                <p class="card-category"><?=$data['category_name']?></p>
            </div>
            <div class="card_footer">
                <ul class="card_data">
                    <li class="card_data-item">
                    <!-- <time datetime="<?=$data['date']?>"> 
                        <!-- <?=date('F d, Y ', strtotime($data['date']))?>  
                    </time> -->
                        <?=$data['price']?> $
                    </li>
                </ul>
                <a href="/main/flowers?id=<?=$data['id']?>" class="card_read">Подробнее</a>
            </div>
          </div>
        </article>
        <?php	endforeach;	
    }

    public function actionFindFlowers()
    {
        $id = Input::get('id');
        
        $Flowers = new \models\Flowers($id);

        if (!$Flowers->exists()) {
            $data = array(
                'ok' => false, 
                'error_code' => 400
            );
            echo json_encode($data);
            header("Content-type:application/json"); 
            
            exit();
        }

        $data = array(
            'ok' => true, 
            'error_code' => 200,
            'data' => (array) $Flowers->data()
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        header("Content-type:application/json");


        
    }

    
}


?>