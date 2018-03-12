<?php


class FeedbackController
{

	public function actionIndex()
	{
		
		$name='';
		$errors = false;
		$msg='';
		if(isset($_POST['submit']))
		{


			$name=$_POST['name'];
			$parent_id=$_POST['parent_id'];
			$msg=$_POST['msg'];

			if($msg=='')
			{
				$errors[]="Поле сообшение не должно быть пустым";
			}
			else
			{
				if (!User::checkMsg($msg)) 
				{
					$errors[] = 'Сообшение не должно быть короче 12-х символов';
				}
			}
			if($name=='')
			{
				$errors[]="Поле имя не должно быть пустым";
			}
			else
			{
				if (!User::checkName($name)) 
				{
					$errors[] = 'Имя не должно быть короче 3-х символов';
				}
			}
			if ($errors == false) {
				date_default_timezone_set('Europe/Kiev');
				$date=date('Y-m-d H:i:s');
				User::setSms($msg,$name,$parent_id);
			}
		} 

		View::generate( '/views/feedback/feedback.php', ['name' => $name,'errors'=>$errors]);
	}

	public function actionList()
	{
    	// User::checkLogged();
		$listObjSql=User::getAllObjSms();
		$sorted_list = $this->sort_r($listObjSql,0);

		View::generate( '/views/feedback/list.php', ['listObjSql' =>$sorted_list]);
	}


	public static function showing_list($sorted_list){

$sorted_list = array_reverse($sorted_list);
		foreach ($sorted_list as $key =>$value ) {
			
			echo 
			'<div class="dialog">
			<h2 class="title">'.$value['name'].'</h2>
			<div class="content">&nbsp'.$value['comment'].'</div>';
			echo "<a href='/feedback/index/?parent_id=".$value['id']."'>Ответить</a>";
			if($value['children'])
				FeedbackController::showing_list($value['children']);
			echo '</div>';

		}

	}

	private function sort_r($input, $parentId) {
		$output = array();
		foreach ($input as $key => $item) {
			if ($item['parent_id'] == $parentId) {
				$item['children'] = $this->sort_r($input, $item['id']);
				$output[] = $item;
			}
		}
		return $output;
	}
}