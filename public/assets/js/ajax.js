$(document).ready(function() {

	// console.log(Number($('#password').attr("max")));
	// return;
	// 
	
	getFlowers();
	// setInterval(function () {
	// 	getNews();
	// }, 10000);

	function getFlowers() {
		$.ajax({
			url: '/act/getFlowers',
			type: 'POST',
			success: function (data) {
				if (data != '') {
					$('#product').html(data);
				}else{
					$('#product').html('<h6>Записий нет!</h6>');
				}
			}
		});
	}
	

	function formValidate(form) {
		let error = 0;
		let formReq = $('._req');

		for (let index = 0; index < formReq.length; index++) {
			const input = formReq[index];

			formRemoveError(input);

			if (input.classList.contains('_email')) {
				if (emailTest(input)) {
					formAddError(input);
					error++;
				}
			}else if(input.getAttribute("type") === "checkbox" && input.checked === false){
				formAddError(input);
				error++;
			}else{
				if (input.value === '') {
					formAddError(input);
					error++;
				}
			}
		}

		if (error == 0) {
			return true;
		}

		return false;
	}

	function formAddError(input) {
		input.parentElement.classList.add('invalid');
		input.classList.add('invalid');
	}

	function formRemoveError(input) {
		input.parentElement.classList.remove('invalid');
		input.classList.remove('invalid');
	}

	function emailTest(input) {
		return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
	}


	let form = $("form");

	form.submit(function(event) {
	  event.preventDefault();
	  
	  	// let error = formValidate(form);
	  		
	  	// if (error) {

		  $.ajax({
		  	url: $(this).attr('action'),
		  	type: $(this).attr('method'),
		  	data: new FormData(this),
		  	contentType: false,
		  	cache: false,
		  	processData: false,
		  	success: function (result) {

		  		if (result == "auth success!") {
		  			alert('Logged in!');
		  			window.location.reload();
		  		}

		  		console.log(result);
		  		

		  		$(".alert").slideToggle('fast');
		        $('.alert-msg').html(result);
		          
		        setTimeout(function(){
		            $('#submit').prop("disabled", false);             
		        	$(".alert").slideUp('400');
		        }, 3 * 1000);
		  		
		  	}
		  });	  		
	  	// }	

	});



});


// $.ajax({
// 	url: '/act/getnews',
// 	type: 'POST',
// 	success: function (data) {
// 		// data = $.parseJSON(data);

// 		article = $('#article');

// 		console.log(article);


// 		// $.each(data, function(i, val) {
// 		// 	$('#article').append();
// 		// });
// 	}
// });
