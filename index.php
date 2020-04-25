<?php  
	session_start();
	// ini_set('sesion.gc.maxlifetime', 3600);

	include_once('conn.php');
	$areaLists = $connection->query('SELECT `ter_name` FROM `t_koatuu_tree` WHERE `ter_type_id`="0"');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>proTest</title>
	<link rel="stylesheet" href="css/chosen.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="" method="post" class="submit_select_city">
		<p class="email_exist">Е-майл: <strong class="email_current"></strong> уже занят. Пожалуйста, выберите другой</p>
		<div class="input-wrap">
			<input type="text" name="full_name" placeholder="Введите ФИО" class="full_name">
		</div>
		<div class="input-wrap">
			<input type="email" name="email" class="email" placeholder="Введите Ваш е-майл" >
		</div>
		
		<div class="input-wrap">
			<select data-placeholder="Выбирите область..." class="chosen-select active" tabindex="1" name="area_list" id="area-list">
				<option value=""></option>
				<?php foreach ($areaLists as $areaList) { ?></div>
					<option value="<?php echo $areaList['ter_name'] ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $areaList['ter_name'] ?></font></font></option>
				<?php } ?>
			</select>
		</div>

		<div class="input-wrap">
			<select data-placeholder="Выбирите город..." id="city-list" class="chosen-select" tabindex="1" name="city_list" data-hidden="true" ></select >
		</div>

		<div class="input-wrap">
			<select data-placeholder="Выбирите район..." id="district-list" class="chosen-select" tabindex="1" name="district_list" data-hidden="true" ></select>
		</div>

		<button type="submit">Отправить</button>
	</form>
	<div id="success-wrap" class="success-wrap">
		<p>Спасибо!</p>
		<p class="success-wrap__text">Ваша заявка успешно принята</p>
		<small>Это поле очиститься через 5 секунд</small>
	</div>
	<div class="error-wrap" id="error-wrap">
		<p>Возникла ошибка :(</p>
		<p class="error-wrap__text">Попробуйте подождать, и повторить попытку позже</p>
	</div>
	
	<script src="js/jquery.min.js"></script>
  <script src="js/chosen.jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>

