<?php

namespace models;
use library\Db;
use library\Hash;
use library\Config;
use library\Session;
use library\Cookie;

class User
{
    private $_db, $_data, $_sessionName, $_isLoggedIn, $_cookieName;

    public function __construct($user = null)
    {
        $this->_db = Db::getInstance();

        $this->_sessionName = Config::get('session.sessionName');
        $this->_cookieName = Config::get('remember.cookieName');


        // проверяет на наличие авторизации в сессии
        // если есть, то в  isLoggedIn() возвращяет true
        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                }else {
                    # process logout
                }
            }
        }else {
            $this->find($user);
        }
    }

    /**
     * Создает нового пользователя
     *
     * @param array $fields
     * @return void
     */
    public function create($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new \Exception('Возникла проблема при создании учетной записи!');            
        }
    }

    /**
     * Этот метод ищет пользователя
     *
     * @param [type] $user
     * @return void
     */
    public function find($user = null)
    {
        if (!is_null($user)) {
            $field = (is_numeric($user)) ? 'id' : 'login';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }


    /**
     * Эта функция выполняет авторизацию пользователя
     *
     * @param string $login
     * @param string $password
     * @param boolean $remember
     * @return void
     */
    public function login($login = null, $password = null, $remember = false)
    {
        
        if (!$login && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($login);
            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));
    
                        if (!$hashCheck->count()) {
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash,
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
    
                        Cookie::put($this->_cookieName, $hash, Config::get('remember.cookieExpiry'));
    
                    }
                    return true;
                }
            }
        }


        return false;
    }

    /**
     * Обновляет дааные пользователя
     *
     * @param array $fields
     * @param integer $id
     * @return void
     */
    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception("При обновлении возникла проблема");
        }
    }

    public function hasPermission($key = '')
    {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->group_id));
                
        if ($group->count()) {
            $permissions = \json_decode($group->first()->permissions, true);
            
            if ($permissions[$key] == true) {
                return true;
            }
        }

        return false;

    }

    /**
     * Этот метод проверяет на наличие данных,
     * если есть то возвращяет true, в ином случае возвращяет false 
     *
     * @return void
     */
    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    /**
     * Возвращяет данные о пользователе
     *
     * @return void
     */
    public function data()
    {
        return $this->_data;
    }

    /**
     * Если пользватель авторизован то вернёт true
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }

    public function logout()
    {

        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }
}
