<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $this->title; ?></title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<link rel="stylesheet" type="text/css" href="/mvc/assetsforpanel/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/mvc/assetsforpanel/css/common.css">
	<link rel="stylesheet" type="text/css" href="/mvc/assetsforpanel/css/loader.css">


    <script src="https://kit.fontawesome.com/ac841d5cc0.js" crossorigin="anonymous"></script>
</head>
<body>
	<script type="text/javascript" src="/mvc/assetsforpanel/js/jquery-3.4.1.min.js"></script>
	<!-- <script type="text/javascript" src="/mvc/assetsforpanel/js/jquery-3.5.1.slim.min.js"></script> -->
	<script type="text/javascript" src="/mvc/assetsforpanel/js/popper.min.js"></script>
	<script type="text/javascript" src="/mvc/assetsforpanel/js/bootstrap.min.js"></script>
	<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
	  <a class="navbar-brand" href="#">Bikada</a>
	  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <?php if (isset($_SESSION['logged'])) : ?>
	  <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="/mvc/panel">Главная</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/mvc/panel/product">Продукты</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/mvc/panel/article">Статьи</a>
	      </li>
	    </ul>
		<div class="btn-group">
		  <button type="button" class="btn p-1">
		  	<div class="media">
		  	  <div class="user_img mr-3" style="background-image: url('https://via.placeholder.com/1000');"></div>
			  <div class="media-body align-self-center">
		    	<?=$this->getEmployee('name', $_SESSION['idEmployee'])?>		    
			  </div>
			</div>
		  </button>
		  <button type="button" class="btn shadow-none dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  </button>
		  <div class="dropdown-menu">
		    <a class="dropdown-item" href="#">Профиль</a>
		    <div class="dropdown-divider"></div>
		    <a class="dropdown-item" href="/mvc/app.php?action=logout">Выйти</a>
		  </div>
		</div>		 	 
	  </div>
	  <?php endif;  ?>
	</nav>
	<div aria-live="polite" aria-atomic="true">

	  <!-- Then put toasts within -->
	  <div style="position: fixed; left: 30px; top: 40%; transform: translate(10px, 10px); z-index: 9999" class="toast" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true" id="server_mess">
	    <div class="toast-header">
	      <strong class="mr-auto">Уведомления</strong>
	      <small></small>
	      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="toast-body" id="server_mess_text"></div>
	  </div>
	</div>
	<?php
        require $this->setBasePath('panel').$tplName.'.php';
    ?>

	
</body>
</html>