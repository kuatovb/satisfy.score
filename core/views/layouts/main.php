<!DOCTYPE html>
<html>
<head>

    <title> <?= $this->title; ?> </title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="<?= $this->seo['description']; ?>">
    <meta name="keywords" content="<?= $this->seo['keywords']; ?>">

    <meta property="og:title" content="<?= $this->title; ?>" />
    <meta property="og:description"  content="<?= $this->seo['description']; ?>" />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:site_name" content="<?= $this->seo['site_name']; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/grid.min.css">
    <link rel="stylesheet" href="/public/assets/css/materialize.css">
    <link rel="stylesheet" href="/public/assets/css/common.css">

    
    <script src="/public/assets/js/jquery.min.js"></script>
</head>
<body>

  <script type="text/javascript">
    document.body.onload = function () {
      $(".preloader-wrapper").fadeOut();
      $(".preloader").delay(400).fadeOut("slow");
    }
  </script>

  <div class="preloader">
    <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>


  <div class="alert">
    <div class="alert-msg">
      
    </div>
  </div>
    <header class="navbar-fixed">
        <nav class="nav pr-2 pl-2 z-depth-1">
            <div class="nav-wrapper">
              <a href="/" class="brand-logo pr-2 pl-2">Satisfy.Score</a>
              <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              <a href="/main/profile?login=<?=$user->data()->login?>" class="sidenav-trigger right"><i class="material-icons">account_circle</i></a>
              <ul class="right hide-on-med-and-down">
                <?php
                  if ($user->isLoggedIn()) :
                ?>

                  <li>
                    <a class="dropdown-trigger" href="#!" data-target="dropdownMenu-profile">
                      <img width="40" src="http://via.placeholder.com/640" class="mr-2 circle responsive-img"> 
                     <?=$user->data()->login?>
                     <i class="material-icons right">arrow_drop_down</i>
                    </a>
                  </li>

                <?php else: ?>
                  <li><a href="/main/login" class="waves-effect waves-light btn blue accent-4 modal-trigger">Войти</a></li>
                <?php endif; ?>


              </ul>
            </div>
            <ul id="dropdownMenu-profile" class="dropdown-content">
              <li><a href="/main/profile?login=<?=$user->data()->login?>">Профиль</a></li>
              <li class="divider"></li>
              <li><a href="/act/logout">Выйти</a></li>
            </ul>
        </nav>
    </header>

    <ul class="sidenav sidenav-fixed" id="mobile-demo">
        <li><a href="/" id="logo-container" class="brand-logo p-4">Satisfy.Score</a></li>

        <?php 

        if ($user->isLoggedIn() && $user->hasPermission('moderator')) :

        ?>
        <li><a href="#manageFlowers" class="waves-effect waves-light btn blue modal-trigger" onclick="manageData('addFlowers')"> <i class="material-icons left">add</i> Добавить товар</a></li>
        <li><a href="/main/orders"> Заказы клиентов</a></li>
        <?php endif; ?>        
        <li><a href="/">Главная</a></li>
        <?php foreach ($Flowers->get('all_category') as $data) : ?>
        <li><a href="/main/Flowers?category_id=<?=$data['id']?>"><span><?=$data['category_name']?></span></a></li>
        <?php endforeach; ?>
        <li class="sidenav-footer"></li>
    </ul>

    <div class="page">
      <div class="container mr-0">
        <?php
          require $this->setBasePath('main').$tplName.'.php';
        ?>
      </div>
    </div>
    
<div id="modalOneClick" class="modal" style="width: 40%">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="form-modal-title">Купить в один клик</h5>
      <button type="button" class="modal-close btn waves-effect"><i class="material-icons">close</i></button>
    </div>
    <div class="moadal-body">
      <div class="row justify-content-center">
        <form class="col-md" enctype="multipart/form-data" action="/act/buyFlower" method="POST">

          <div class="row mb-4 mt-3">
            <div class="col-md-12">
              <span></span>
              <div class="input-field">
                <input id="full_name" placeholder="Ваше имя" name="full_name" type="text" class="_req" autocomplete="off">
              </div>            
            </div>
          </div>
          <div class="row mb-4 mt-3">
            <div class="col-md-12">
              <span></span>
              <div class="input-field">
                <input id="tel" placeholder="Ваш телефон" name="tel" type="text" class="_req" autocomplete="off">
              </div>            
            </div>
          </div>

          
          <input type="hidden" name="product_id" id="product_id" value="">

          <div class="row">
            <div class="col-md-12">
              <div class="input-field">
                <button class="waves-effect waves-light btn blue accent-4 right" type="submit">Отправить</button>
              </div>            
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="manageFlowers" class="modal" style="width: 40%">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="form-modal-title"> Добавление товара  </h5>
      <button type="button" class="modal-close btn waves-effect"><i class="material-icons">close</i></button>
    </div>
    <div class="moadal-body">
      <div class="row justify-content-center">
        <form class="col-md" enctype="multipart/form-data" action="/act/manageFlowers" method="POST">
          <div class="row mb-4 mt-3">
            <div class="col-md-12">
              <span></span>
              <div class="input-field">
                <input id="title" placeholder="Заголовок" name="title" type="text" class="_req" autocomplete="off">
              </div>            
            </div>
          </div>
          <div class="row">
            <div class="input-field col-md-12">
              <textarea placeholder="Текст" name="text" id="text"  class="_req materialize-textarea"></textarea>
            </div>
          </div>

          <div class="row">           
            <div class="col-md-12">
              <div class="file-field input-field">
                <div class="btn blue accent-4">
                  <span>Добавить картинку</span>
                  <input type="file" id="fileImage" name="img" accept="image/jpeg,image/png,image/gif,image/heic,image/heif,image/webp">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" id="img_name">
                </div>
                <div class="input-field" id="filePreview">
                  <img width="100" src="" id="form-img">
                </div>
              </div>
            </div>
          </div>

          <div class="input-field col s12">
            <select name="category_id" id="category_id">
              <option value="0" disabled selected>Выберите категию</option>
              <?php foreach ($Flowers->get('all_category') as $data) : ?>
              <option value="<?=$data['id']?>"><?=$data['category_name']?></option>
              <?php endforeach; ?>
            </select>
            <label>Категорий новостей</label>
          </div>

          <input type="hidden" id="manageData" name="manageData" value="">
          <input type="hidden" name="id" id="id" value="">

          <div class="row">
            <div class="col-md-12">
              <div class="input-field">
                <button class="waves-effect waves-light btn blue accent-4 right" type="submit">Сохрнить</button>
              </div>            
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect btn">Закрыть</a>
  </div>
</div>

    





    <script src="/public/assets/js/materialize.min.js"></script>
    <script type="text/javascript">
        M.AutoInit();

        const fileImage = document.getElementById('fileImage');
        const filePreview = document.getElementById('filePreview');

        fileImage.addEventListener('change', () => {
          uploadFile(fileImage.files[0], 2);
        });




        function uploadFile(file, maxSize) {

          if (fileImage.value == '') {
            filePreview.innerHTML = '';
            filePreview.style.boxShadow = "none";
            return;
          }

          var fileExt = ['image/jpeg', 'image/png', 'image/gif', 'image/heic', 'image/heif', 'image/webp'];

          if (!fileExt.includes(file.type)) {

            alert('Разрешены только изображения!');
            fileImage.value = '';
            return;

          }

          if (file.size > maxSize * 1024 * 1024) {
            alert('Файл должен быть менее '+maxSize+' MБ.');
            fileImage.value = '';
            return;
          }

          var reader = new FileReader();

          reader.onload = function (e) {
            filePreview.innerHTML = `<img width="100" src="${e.target.result}">`;
            filePreview.style.boxShadow = "0px 0px 10px black";
          };

          reader.onerror = function (e) {
            alert('Fatal error!');
          };

          reader.readAsDataURL(file);

        }

        function manageData(key, id = null) {
          if (key == 'get') {
            $.ajax({
              url: '/act/findFlowers',
              type: 'GET',
              data: {id: id},
              success: function (result) {
                if (result.ok) {
                  console.log(result.data);

                  $('#title').val(result.data.title);
                  $('#text').val(result.data.text);
                  $('#img_name').val(result.data.img_name);
                  $('#form-img').attr('src', '/public/uploads/img/'+result.data.img_name);
                  $('#manageData').val('updateFlowers');
                  $('#id').val(result.data.id);
                  $('#form-modal-title').text('Изменение записи');
                  // $('#category_id').val(result.data.category_id);

                }else{
                  alert("data not found");
                }
              }
            });
            
          }

          if (key == 'addFlowers') {
            $('#form-modal-title').text('Добавление записи');

            $('#title').val('');
            $('#text').val('');
            $('#img_name').val('');
            $('#form-img').attr('src', '');
            $('#manageData').val(key);
            
          }

          if (key == 'buy-flower') {
            $('#product_id').val(id);
          }
        }



    </script>

    <script type="text/javascript" src="/public/assets/js/ajax.js"></script>
</body>
</html>