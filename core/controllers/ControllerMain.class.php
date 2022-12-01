<?php

namespace controllers;

use base\View;
use base\Controller;
use library\Redirect;
use library\Input;
use library\Token;
use models\User;


class ControllerMain extends Controller
{

    public $user;
    protected $_view;
    public function __construct()
    {
        $this->_view = new View();
        $this->user = new User();
        $this->_view->setLayout('main');
    }

    public function actionIndex()
    {

        // if (!$this->user->isLoggedIn()) {
        //     Redirect::to('/main/login');
        // }

    	$this->_view->setTitle('Home');
        
        $this->_view->render('index', [
            'Token' => new Token(),
            'user' => new \models\User(),
            'Flowers' => new \models\Flowers()
        ]);

    }

    public function actionRegister()
    {
        if ($this->user->isLoggedIn()) {
            Redirect::to('/');
        }

    	$this->_view->setTitle('Register page');
        
        $this->_view->render('register', [
            'Token' => new Token(),
            'user' => new \models\User(),
            'Flowers' => new \models\Flowers()
        ]);

    }

    public function actionLogin()
    {

        if ($this->user->isLoggedIn()) {
            Redirect::to('/');
        }

    	$this->_view->setTitle('Login page');
        
        $this->_view->render('login', [
            'Token' => new Token(),
            'user' => new \models\User(),
            'Flowers' => new \models\Flowers()
            ]);
            
            
        }
        
    public function actionUpdate()
    {
        if (!$this->user->isLoggedIn()) {
            Redirect::to('/');
        }
        
        $this->_view->render('update', [
            'Token' => new Token(),
            'Validate' => new \library\Validate(),
            'User' => new User(),
            'Flowers' => new \models\Flowers()
            ]);
        }
        
    public function actionProfile()
    {
        if (!$login = Input::get('login')) {
            Redirect::to('/');
        }else {
            $user = new User($login);
            if (!$user->exists()) {
                Redirect::to(404);
                // https://www.youtube.com/watch?v=zvXgsouIzVg  4:28:00
            }else {
                $data = $user->data();
            }
        }

        $this->_view->setTitle('Profile page');
        $this->_view->render('profile', [
            'Token' => new \library\Token(),
            'userData' => $data,
            'user' => new User(),
            'Flowers' => new \models\Flowers()
        ]);

    }

    public function actionFlowers()
    {

        // if (!$this->user->isLoggedIn()) {
        //     Redirect::to('/main/login');
        // }


        $id = Input::get('id');
        $category_id = Input::get('category_id');

        $Flowers = new \models\Flowers($id);

        $user = new \models\User($Flowers->data()->author_id);
        if (isset($id)) {
            
            if (!$Flowers->exists()) {
                Redirect::to(404);
                exit();
            }
            
            $this->_view->setTitle($Flowers->data()->title);
        }


        if (isset($category_id)) {
           $FlowersCategories = $Flowers->get('flowersWithCategory', $category_id);
           $categoryName = $Flowers->get('categoryName', $category_id);
           $this->_view->setTitle($categoryName->category_name);
        }

        $this->_view->render('flowers', [
            'user' => new \models\User(),
            'Flowers' => $Flowers,
            'autor' => $user->data()->login,
            'categoryName' => $categoryName,
            'FlowersData' => $Flowers->data(),
            'FlowersCategories' => $FlowersCategories
        ]);

    }

    public function actionOrders()
    {

        
        if (!$this->user->isLoggedIn()) {
            Redirect::to('/main/login');
        }
        
        $Order = new \models\Order();

        $this->_view->render('order', [
            'user' => new \models\User(),
            'Order' => $Order->get('all_orders'),
            'Flowers' => new \models\Flowers()
        ]);
    }

}


?>