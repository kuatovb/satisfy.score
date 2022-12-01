
<?php if(isset($FlowersCategories)) :  ?>
<h4><?=$categoryName->category_name ?></h4>

<div class="row">

<?php 

// echo '<pre>';
// var_dump($FlowersCategories);
// echo '</pre>';

?>

  <?php foreach ($FlowersCategories as $data) : ?>
  	
  <article class="col-md-4 col-sm-12">
      
    <div class="card">
      <div class="card-image">
        <img src="/public/uploads/img/<?=$data['img_name']?>" style="object-fit: cover; max-height: 255px;">
          <?php
            if ($user->hasPermission('author')) :					
                if ($data['login'] == $user->data()->login || $user->hasPermission('admin') || $user->hasPermission('moderator')) :
          ?>
              <a class="btn-floating halfway-fab waves-effect waves-light modal-trigger" href="#manageFlowers" onclick="manageData('get', <?=$data['id']?>);"><i class="material-icons">edit</i></a>
                <?php endif;?>
            <?php endif;?>

          <?php if ($user->hasPermission('admin') || $user->hasPermission('moderator')) :?>
              <a class="btn-floating halfway-fab waves-effect waves-light modal-trigger" href="#manageFlowers" onclick="manageData('get', <?=$data['id']?>);"><i class="material-icons">edit</i></a>
        <?php  endif;?>
      </div>
      <div class="card-content">
          <h2 class="card-title" title="<?=$data['title']?>">
              <a href="/main/Flowers?id=<?=$data['id']?>">
                  <?=$data['title']?>
              </a>
          </h2>
          <p class="card-desc" >
              <?=mb_substr($data['text'], 0, 200, 'utf-8')?>...
          </p>
          <br>
      </div>
      <div class="card_footer">
          <ul class="card_data">
              <li class="card_data-item">
                <!-- <time datetime="<?=$data['date']?>"> 
                  <?=date('d F Y г.', strtotime($data['date']))?> 
                </time> -->
                <?=$data['price']?> $
              </li>
          </ul>
          <a href="/main/flowers?id=<?=$data['id']?>" class="card_read">Подробнее</a>
      </div>
    </div>
  </article>
  <?php	endforeach;	?>
</div>
<?php endif; ?>


<?php if(isset($FlowersData)) : ?>

<article class="article">
  <div class="row justify-content-center">
    <div class="col-sm-12">

      <div class="row align-items-center justify-content-between">

        <div class="col">
          <h5><?=$FlowersData->title?></h5>
        </div>
        <div class="col-auto">
          <a href="#modalOneClick" class="btn modal-trigger" onclick="manageData('buy-flower', <?=$FlowersData->id?>);">Купить</a>
        </div>

      </div>
      <ul class="card_data">
        <li class="card_data-item">
          <!-- <time datetime="<?=$FlowersData->date?>"> 
              <?=date('d F Y г.', strtotime($FlowersData->date))?> 
          </time> -->
          
          <?=$FlowersData->price?> $
        </li>
      </ul>
      <img src="/public/uploads/img/<?=$FlowersData->img_name?>" class="left mb-3 mr-3 ml-3 article_img">
      <p style="text-overflow: ellipsis; overflow: hidden white-space: nowrap;">
        <?=$FlowersData->text?>
      </p>
    </div>
  </div>
</article>

<?php endif; ?>

<div id="manageFlowers" class="modal" style="width: 40%">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="form-modal-title">Добавление новости</h5>
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