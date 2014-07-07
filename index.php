<?
include('cfg/cfg.php');
include('model/WADB.cls.php');
$db = new WADB(db_address,db_name,db_username,db_password);
//之所以不將header放在外面 是因為當執行完動作時 用header轉頁時前方不能輸出html所以搬到內部去
if($_GET['action'] != ''){
	switch($_GET['action']){
		case 'add':	//執行新增留言
			if(count($_POST) > 0){
				$sql = "insert into
						 guestbook
						(
							name,
							email,
							sex,
							content,
							create_time,
							ip
						)
						values
						(
							'" . $_POST['name'] ."',
							'" . $_POST['email'] ."',
							'" . $_POST['sex'] ."',
							'" . $_POST['content'] ."',
							'" . time() ."',
							'" . $_SERVER['REMOTE_ADDR'] . "'
						)";
				$db->insertRecords($sql);
				//新增完之後跳回到 主頁面 
				header('Location:index.php');
				exit();
			}
			include('view/header.php');
			include('view/add.php');
			include('view/footer.php');
		break;
		case 'delete':
			$sql = "delete
					from
					 guestbook
					where
					 id = '" . $_GET['id'] . "'";
			$db->deleteRecords($sql);
			//刪除完之後跳回到 主頁面 
			header('location:index.php');
			exit();
		break;
		default:	//沒收到動作指令,顯示預設頁面
			$sql = "select
					 *
					from
					 guestbook
					order by
					 id desc";
			$data = $db->selectRecords($sql);
			include('view/header.php');
			include('view/show.php');
			include('view/footer.php');
	}
}else{
	//沒收到動作指令,顯示預設頁面
	$sql = "select
			 *
			from
			 guestbook
			order by
			 id desc";
	$data = $db->selectRecords($sql);
	//print_r($data);
	include('view/header.php');
	include('view/show.php');
	include('view/footer.php');
}

?>




