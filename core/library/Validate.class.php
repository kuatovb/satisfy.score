<?php 

namespace library;

class Validate
{

	private $_passed = false,
			$_errors = array(),
			$_db = null;
	
	public function __construct()
	{
		$this->_db = Db::getInstance();
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $source
	 * @param array $items
	 * @return void
	 */
	public function check($source, $items = array())
	{
		// echo "<pre>";
		// var_dump($items);
		// echo "</pre>";

		// в цикле разбираем массив данных
		// $validate = new Validate();
        // $validation = $validate->check($_POST, array(
        //         'username' => array(
        //             'input_name' => 'Username',
        //             'required' => true,
        //             'min' => 2,
        //             'max' => 30,
        //         ), 

        //         'login' => array(
        //             'input_name' => 'Login',
        //             'required' => true, 
        //             'min' => 4,
        //             'max' => 10,
        //             'unique' => 'users'
        //         ), 

        //         'password' => array(
        //             'input_name' => 'Password',
        //             'required' => true, 
        //             'min' => 8, 
        //         ),
        //         'password_again' => array(
        //             'input_name' => 'Password confirmation',
        //             'required' => true, 
        //             'matches' => 'password', 
        //         ), 
        //     ));

		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);
				$item = $this->escape($item);
				
				if ($rule === 'required' && empty($value) ) {
					$this->addError("{$rules['input_name']} требуется заполнить ", $item);

				}elseif(!empty($value)){
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$rules['input_name']} должен состоять минимум {$rule_value} символов.", $item);
							}
						break;						
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$rules['input_name']} должен состоять максимум {$rule_value} символов.", $item);
							}
						break;
						case 'matches':
							if ($value != $source[$rule_value]) {
								// $this->addError("{$rule_value} должен совпадать {$item}");
								$this->addError($rules['errorMessage'], $item);
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$value} уже существует", $item);
								// $this->addError("{$rules['input_name']} уже существует");
							}
						break;
					}
				}
			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;

	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $error
	 * @return void
	 */
	private function addError($error, $name)
	{
		$this->_errors[$name] = $error;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function errors()
	{
		return $this->_errors;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function passed()
	{
		return $this->_passed;
	}

	/**
	 * 
	 *
	 * @param string $string
	 * @return void
	 */
	public function escape($string)
	{
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}

}




 ?>