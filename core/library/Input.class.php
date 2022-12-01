<?php 

namespace library;

class Input
{

	/**
	 * Этот метод провияет на наличие post или get данных
	 *
	 * @param string $type
	 * @return void
	 */
	public static function exists($type = 'post')
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
			break;

			case 'get':
				return (!empty($_GET)) ? true : false;
			break;
			
			default:
				return false;
			break;
		}
	}

	/**
	 * Этот метод получает $_POST или $_GET данные
	 *
	 * @param $item
	 * @return void
	 */
	public static function get($item)
	{
		if (isset($_POST[$item])) {
			return $_POST[$item];
		}elseif (isset($_GET[$item])) {
			return $_GET[$item];
		}elseif (isset($_FILES[$item])){
			return $_FILES[$item];
		}

		return null;
	}

}


 ?>