<?php
	session_start();
	include_once('conn.php');

	if(isset($_POST["action"]) == "get_city") {
		$selectCity = $_POST["selectCity"];
		$currentIds = $connection->query("SELECT `reg_id` FROM `t_koatuu_tree` WHERE `ter_name`='$selectCity'");

		foreach ($currentIds as $currentId) { 
			$id =  $currentId['reg_id'];
		}

		if(isset($id)) {
			$query = $connection->query("SELECT `ter_name` FROM `t_koatuu_tree` WHERE `reg_id` = '$id'");
			?><option value=""></option><?php
			foreach ($query as $querys) { 
			 ?>
            		<option value="<?php echo $querys['ter_name']; ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $querys['ter_name']; ?></font></font></option>
     		<?php } 
		}
	}

	if(isset($_POST["action"]) == "get_district") {
		$text = $_POST["cityValue"];
		$selectRegion = $_POST["selectRegion"];
		$query = $connection->query("SELECT `ter_address` FROM `t_koatuu_tree` WHERE `ter_name` = '$text' and `ter_address` LIKE '%$selectRegion%'");
		
		?><option value=""></option><?php
		foreach ($query as $querys) { ?>
        		<option value="<?php echo $querys['ter_address']; ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $querys['ter_address']; ?></font></font></option>
 		<?php } 
	}		


	if ($_POST['email']) {
		$msg = "OK";
		$login = $connection->query('SELECT * FROM `reg_people`');
		
	    foreach($login as $log) {
	        if ($_POST['email'] == $log['email']) {
			    $msg = "email_exists";    
			}
	        if ($_POST['email'] == $log['email'] && $_POST['full_name'] == $log['name']) {
	            $_SESSION['name'] = htmlspecialchars($_POST['full_name']);
	            $_SESSION['email'] = htmlspecialchars($_POST['email']);
	            $_SESSION['district_list'] = htmlspecialchars($log['territory']);
	           	$msg = "";
	        }
	    }

	    if($msg == "OK") {
	    	$fullName = htmlspecialchars($_POST['full_name']);
		    $email = htmlspecialchars($_POST['email']);
		    $territory = htmlspecialchars($_POST['district_list']);

		    // MySQL иньекция
		    $safe = $connection->prepare("INSERT INTO `reg_people` SET name =:username, email=:email, territory=:territory"); 
		    $arr = ['username'=>$fullName, 'email'=>$email, 'territory'=>$territory]; 
		    $safe->execute($arr);
	    }

	    return print_r($msg);
	}

	
