<section class="container bg-light shadow pb-5">
	<div class="pt-4 mb-5">
		<div class="mb-3">
			<h1>Тарифы на интернет, частным лицам</h1>
		</div>
		<div class="mt-5 mb-3" id="b2c">
			<div class="dropdown">
			  <a class="btn btn-link dropdown-toggle shadow-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <?php
			    	if (empty($_GET['city'])) {
                		echo "Актау";
                	}

                  if ($_GET['city'] == 'Актау') {
                    echo "Актау";
                  }

                  if ($_GET['city'] == 'Акшукур-и-Саин-Шапагатова') {
                    echo "Акшукур и Саин Шапагатова";
                  } 
			    ?>
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="?city=Актау#b2c">Актау</a>
			    <a class="dropdown-item" href="?city=Акшукур-и-Саин-Шапагатова#b2c">Акшукур и Саин Шапагатова</a>
			  </div>
			</div> 
		</div>
		<div class="row">
			<?php

				if (empty($_GET['city'])) {          
					$this->getTariffsforPanel('1', '1');
                }
              
                if ($_GET['city'] == 'Актау') {
					$this->getTariffsforPanel('1', '1');
                }
              
                if ($_GET['city'] == 'Акшукур-и-Саин-Шапагатова') {
					$this->getTariffsforPanel('1', '2');
                }

			?>
			<div class="col-md align-self-center">
				<button class="btn btn-light" type="button" data-toggle="modal" data-target="#addProduct">
					<span>
						<svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
						  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
						  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						</svg>
					</span>
					Добавить продукт
				</button>
			</div>
		</div>
	</div>

	<div class="mt-5" id="b2b">
		<div class="mb-3">
			<h1>Тарифы на интернет, для бизнеса</h1>
		</div>
		<div>
			<div class="dropdown">
			  <a class="btn btn-link dropdown-toggle shadow-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <?php

			      if (empty($_GET['person'])) {
                    echo "Для ИП";
                  }

                  if ($_GET['person'] == 'Для-ИП') {
                    echo "Для ИП";
                  }

                  if ($_GET['person'] == 'Для-ТОО-и-АО') {
                    echo "Для ТОО и АО";
                  }

			    ?>
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="?person=Для-ИП#b2b">Для ИП</a>
			    <a class="dropdown-item" href="?person=Для-ТОО-и-АО#b2b">Для ТОО и АО</a>
			  </div>
			</div>
		</div>
		<div class="row">
			<?php

				if (empty($_GET['person'])) {
	              $this->getTariffsforPanel('2', '1');
	            }
	          
	            if ($_GET['person'] == 'Для-ИП') {
	              $this->getTariffsforPanel('2', '1');
	            }
	          
	            if ($_GET['person'] == 'Для-ТОО-и-АО') {
	              unset($_SESSION['types_of_customers']);
	              // $_SESSION['types_of_customers'] = 3;
	              $this->getTariffsforPanel('3', '1');
	              // $this->getTariffs('3', '1');
	            }
           
			?>
			<div class="col-md align-self-center">
				<button class="btn btn-light" type="button" data-toggle="modal" data-target="#addProduct">
					<span>
						<svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
						  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
						  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						</svg>
					</span>
					Добавить продукт
				</button>
			</div>
		</div>
	</div>
</section>



<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="loader"></div>
        <div>
        	<form action="/mvc/app.php" method="POST" id="editTariff">
        	</form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="delMoadal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Внимание!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: var(--orange)"> Вы точно хотите удалить этот тариф?! </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary confirm">ДА</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавления тарифа</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/mvc/app.php" method="POST" id="addTariff">
        	<input type="hidden" name="action" value="addTariff">
		  <div class="form-group">
		    <label for="tariff_name">Название тарифа</label>
		    <input type="text" name="tariff_name" minlength="4" class="form-control" id="tariff_name" required>
		  </div>
		  <div class="form-group">
		    <label for="price">Цена</label>
		    <input type="text" name="price" minlength="3" class="form-control" id="price" required>
		  </div>
		  <div class="form-group">
		    <label for="conn_speed">Скорость</label>
		    <input type="text" name="conn_speed" minlength="4" class="form-control" id="conn_speed" required>
		  </div>
		  <div class="custom-control custom-checkbox mb-4">
		    <input type="checkbox" name="stock_mark" id="stock_mark" class="custom-control-input">
		    <label class="custom-control-label" for="stock_mark">Акция</label>
		  </div>
		  <div class="form-group">
		  	<label>Регион</label>
		  	<select class="form-control" name="supp_region">
		  		<option> -- Не выбрано -- </option>
		  		<option value="1">Актау</option>
		  		<option value="2">Акшукур и Саин Шапагатова</option>
		  	</select>
		  </div>
		  <div class="form-group">
		  	<label>Для каких лиц</label>
		  	<select class="form-control" name="for_whom" required>
		  		<option> -- Не выбрано -- </option>
		  		<option value="1">Для физ. лиц</option>
		  		<option value="2">Для юр. лиц (ИП)</option>
		  		<option value="3">Для юр. лиц (ТОО, АО)</option>
		  	</select>
		  </div>
		  <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function getTariff(id) {
		$.ajax({

            type: "POST",
            url: "/mvc/app.php",
            data: {
                tariffId: id,
                action: 'getTariff'
            },
            dataType: 'text',
            beforeSend: function() {
            	$('.loader').show('slow');
                $('#editTariff').hide('slow');                   
            },
            success: function(result){
                $('.loader').hide('slow');
                $('#editTariff').show('slow');                 
                $('#editTariff').html(result);                   
            }
        });
	}

	$(document).ready(function() {
		$('#server_mess').toast('hide');

		$('#editTariff').submit(function(event) {

            event.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: 'text',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#submit').prop("disabled", true);
                },
                success: function(result){
                    // alert(result);              
                    // $("#modalMessSys").slideToggle('fast');
                    $('#server_mess').toast('show');
                    $('#server_mess_text').html(result);
                    
                    setTimeout(function(){
                      $('#submit').prop("disabled", false);             
                    	// $('#server_mess').toast('hide');
                        $("#modalMessSys").hide(800);
                    }, 3 * 1000);                        
                    
                }
            });
            
        });

        $('#addTariff').submit(function(event) {

            event.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: 'text',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#submit').prop("disabled", true);
                },
                success: function(result){
                    // alert(result);              
                    // $("#modalMessSys").slideToggle('fast');
                    $('#server_mess').toast('show');
                    $('#server_mess_text').html(result);
                    
                    setTimeout(function(){
                      $('#submit').prop("disabled", false);             
                    	// $('#server_mess').toast('hide');
                        $("#modalMessSys").hide(800);
                    }, 3 * 1000);                        
                    
                }
            });
            
        });

		$('.tariffId').click(function() {
        	tariffId = $(this).data('id');
        	$('.confirm').click(function(event) {
        		$.ajax({

		            type: "POST",
		            url: "/mvc/app.php",
		            data: {
		                tariffId: tariffId,
		                action: 'deleteTariff'
		            },
		            dataType: 'text',
		            beforeSend: function() {
		            	// $('.loader').show('slow');
		                // $('#editTariff').hide('slow');                
		            },
		            success: function(result){
		                $('#server_mess').toast('show');
                    	$('#server_mess_text').html(result);

                    	setTimeout(function(){             
	                    	$('#server_mess').toast('hide');
	                    }, 3 * 1000);             
		            }

		        });
        	});

		});

	});
</script>