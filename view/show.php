<?
/*
echo '沒整理過的資料<br/>';
print_r($data);

echo '<br/><br/><br/>整理過後的資料 如下↓';
*/
?>
<table cellpadding="1" cellspacing="1" border="1">
	<thead>
    	<tr>
        	<td>姓名</td>
        	<td>Email</td>
        	<td>性別</td>
        	<td>留言內容</td>
        	<td>留言時間</td>
        	<td>留言IP</td>
			<td>刪除留言</td>
        </tr>
    </thead>
<?
	if($data['record'] > 0){
		foreach($data['data'] as $key => $value){
?>
	<tbody>
    	<tr>
        	<td><?=$value['name']?></td>
        	<td><?=$value['email']?></td>
        	<td>
			<?
				if($value['sex'] == 0){
					echo '女生';
				}else{
					echo '男生';
				}
            ?></td>
        	<td><?=$value['content']?></td>
        	<td><?=date('Y-m-d H:i:s',$value['create_time'])?></td>
        	<td><?=$value['ip']?></td>
			<td><a href="?action=delete&id=<?=$value['id']?>">刪除</a></td>
        </tr>
    </tbody>

<?
		}
	}
?>
</table>
<a href="?action=add">新增</a>