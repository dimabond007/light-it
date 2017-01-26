<?php


class FeedbackController
{

    public function actionIndex()
    {
    	
		$name='';
    	$email='';
    	if(!User::isGuest())
    	{
	        $id=$_SESSION['user'];
			$user=User::getUserById($id);
			$name = $user['firstName']; 
			$email=$user['email'];
		}
		else
		{
			$name='';
			$email='';
		}

    	$msg='';
		if(isset($_POST['submit']))
		{
			$name=$_POST['name'];
			$email=$_POST['email'];
			$msg=$_POST['msg'];
            $errors = false;

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
			if($email=='')
			{
				$errors[]="Поле email не должно быть пустым";
			}
			else
			{
                if (!User::checkEmail($email)) 
                {
                    $errors[] = 'Неправильный email';
				}
			}
			if ($errors == false) {
				date_default_timezone_set('Europe/Kiev');
				$date=date('Y-m-d H:i:s');
                $res=User::setSms($msg,$name,$email,$date);
            }
            else
            {
            }
		}


        require_once(ROOT . '/views/feedback/feedback.php');
    }

    public function actionList()
    {
    	User::checkLogged();
    	$listObjSql=User::getAllObjSms();
        require_once(ROOT . '/views/feedback/list.php');
    }

}