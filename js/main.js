window.addEventListener('DOMContentLoaded', (event) => {
	$(".chosen-select").chosen({
		max_shown_results: 50,
		no_results_text: "нет в списке: ",
		 // allow_single_deselect: true,
		width: "100%",
	});

	$('#area-list').on('change', function(e) {
		let target = e.target;
		getCity(target);
		
	});

	$('#city-list').on('change', function(e) {
		let target = e.target;
		getDistrict(target);
	});

	function showElem(elem) {
		elem.classList.add('active');
	}

	function hideElem(elem) {
		elem.classList.remove('active');
	}

	function getCity(target) {
		let selectCity = target.parentElement.querySelector('.chosen-single span').innerHTML,
			hiddenSelect = document.querySelector('#city-list'),
			action = 'get_city';

		$.ajax({
			url: "fetch.php",
			method: "POST",
			data: {
				selectCity:selectCity,
				action: action,
			},
			success: function (data) {
				$('#city-list').html(data);
				showElem(hiddenSelect);
				console.log("success");
				$('#city-list').trigger("chosen:updated");
			},
			error: function () {
				console.log('Error');
			}
		});
	}

	function getDistrict(target) {
		let cityValue = target.value,
			action = "get_district",
			hiddenSelect = document.querySelector('#district-list'),
			selectRegion = target.parentElement.previousElementSibling.querySelector('.chosen-single span').innerHTML;
			
		$.ajax({
		url: "fetch.php",
			method: "POST",
			data: {
				action: action,
				cityValue:cityValue,	
				selectRegion:selectRegion,	
			},
			success: function (data) {
				$('#district-list').html(data);
				showElem(hiddenSelect);
				console.log("success");
				$('#district-list').trigger("chosen:updated");
			},
			error: function () {
				console.log('Error');
			}
		});
	}

	//Show hidden elem for chosen
	$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" })

	// Submit Form
	$('.submit_select_city').validate({
		rules: {
			full_name: {
				required: true,
				minlength: 2,
				maxlength: 80
			},
			email: {
				required: true,
				email: true
			},
			area_list: {
				required: true,
			},
			city_list: {
				required: true,
			},
			district_list: {
				required: true,
			}
		},
		messages: {
			full_name: {
				required: "Поле \"ФИО\" обязательное для заполнения",
				minlength: "Поле \"ФИО\" должно содержать минимум 2 символа",
				maxlength: "Не больше 80 символов"
			},
			email: {
				required: "Поле е-майл обьязательное для заполнения",
				email: "Введите Ваш е-майл"
			}, 
			area_list: {
				required: "Поле \"Выбирите область\" обязательное для заполнения",
			},
			city_list: {
				required: "Поле \"Выбирите город\" обязательное для заполнения",
			},
			district_list: {
				required: "Поле \"Выбирите район\" обязательное для заполнения",
			}
		},
		submitHandler: function (form) {
			let hiddenSelectCity = document.querySelector('#city-list');
			let hiddenSelectDistrict = document.querySelector('#district-list');
			let emailValue = document.querySelector('.email').value;
			let emailElem =  document.querySelector('.email_current');
			let errorEmailText =  document.querySelector('.email_exist');


			$.ajax({
				type: 'POST',
				url: 'fetch.php',
				data: $('.submit_select_city').serialize(),
				success: function (msg) {
					if (msg == 'OK') {
						form.reset();
						$(".chosen-select").trigger('chosen:updated');
						$('.submit_select_city').hide(200);
						$('#success-wrap').show(200);
						hideElem(hiddenSelectCity);
						hideElem(hiddenSelectDistrict);

						setTimeout(function() {
							$('.submit_select_city').show(200);
							$('#success-wrap').hide(200);
						}, 5000);
					} else if (msg == 'email_exists') {
						emailElem.innerHTML = emailValue;
						showElem(errorEmailText);
						console.log(msg);
					} else {
						// console.log(msg);
						$(document).ajaxStop(function(){
							setTimeout("window.location = 'content.php'",100);
						});
					}
					
				},
				error: function () {
					form.reset();
					$(".chosen-select").trigger('chosen:updated');
						$('.submit_select_city').hide(200);
					$('#error-wrap').show(200);
					setTimeout(function() {
						$('.submit_select_city').show(200);
						$('#error-wrap').hide(200);
					}, 5000);
				}
			});
		}

	});


	
});
