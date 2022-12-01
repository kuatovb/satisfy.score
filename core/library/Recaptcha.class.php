<?php 

namespace library;

class Recaptcha
{
	public $g_verify_url = "https://www.google.com/recaptcha/api/siteverify";
    public $g_secret_key = "6LcDHOwUAAAAAAvz4y6gTdUr17KbDd27NksIMGcU";
    public $g_public_key = "6LcDHOwUAAAAAODwRambUGgXbD-yiOA2bBtYuG2i";
	function checkCaptcha($responsePOST)
	{
		$g_query = $this->g_verify_url.'?secret='.$this->g_secret_key.'&response='.$responsePOST.'&remoteip='.$_SERVER['REMOTE_ADDR'];
		$g_data = json_decode(file_get_contents($g_query));
		if ($g_data->success == true) {
			return true;
		}else{
			return false;
		}
	}
}

 ?>