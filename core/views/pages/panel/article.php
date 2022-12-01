<script src='https://cdn.tiny.cloud/1/06zt0guem8mct3za31dkagvead75njfslytjgnr4cbq2xqlc/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>

<?php 


if (isset($_SESSION['msg'])) {
  echo '

  <div class="alert alert-'.$_SESSION['msg_type'].' alert-dismissible text-center" role="alert">
    '.$_SESSION['msg'].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  ';

  unset($_SESSION['msg']);
  unset($_SESSION['msg_type']);
}


 ?>

<section class="container bg-light shadow pt-3 pb-3">
  <div class="w-100 d-flex align-items-center justify-content-center" style="height: 100px;">
    <button class="btn btn-light" type="button" data-toggle="modal" data-target="#addArticleModal">Добавить статью</button>
  </div>
	<?php $this->getAllNews('panel'); ?> 
</section>

<div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/mvc/app.php" id="getArticle" method="POST" enctype="multipart/form-data">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/mvc/app.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="addArticle">
          <div class="form-group">
            <label for="title">Загаловок</label>
            <input type="text" name="title" class="form-control" id="title">
          </div>
          <select class="form-control" name="type">
            <option value=""></option>
            <option value="1">Акция</option>
            <option value="2">Новость</option>
          </select>
          <div class="form-group">
            <label for="img">Картинка</label>
            <input type="file" name="img" class="form-control-file" id="img">
          </div>
          <div class="form-group">
            <label for="img_for_slide">Картинка для сайдера</label>
            <input type="file" name="img_for_slide" class="form-control-file" id="img_for_slide">
          </div>
          <div class="form-group">
            <label for="text">Текст</label>
             <textarea id="text" name="text"></textarea>
          </div>
          <input type="submit" value="Добавить" class="btn btn-primary">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function getArticle(id) {
  $.ajax({
    url: "/mvc/app.php",
    type: "POST",
    dataType: 'text',
    data: {
      articleId: id,
      action: 'getArticle'
    },
    success: function (result) {
      $('#getArticle').show('slow');                 
      $('#getArticle').html(result);
    }

  });
  
}





  $(document).ready(function() {
    tinymce.init({
      selector: '#text',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
    });
  });
</script>