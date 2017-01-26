<?php

class UserController
{

    public function actionRegister()
    {
        $name = '';
        $surname='';
        $email = '';
        $password = '';
        $phone = '';
        $gender = '';
        $gender1 = '';
        $birthday = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $phone=$_POST['phone'];
            $gender=$_POST['gender'];
            $gender1=0;
            $birthday=$_POST['birthday'];
            $errors = false;
            //echo 'name: '.$name.' surname: '.$surname.' email: '.$email.' password: '.$password.' phone: '.$phone.' gender:'.$gender.' birthday: '.$birthday;

            if($name=='')
            {
                $errors[] = 'Поле имя должно быть заполненно!';
            }
            else
            {
                if (!User::checkName($name)) {
                    $errors[] = 'Имя не должно быть короче 3-х символов';
                }
            }

            if($surname=='')
            {
                $errors[] = 'Поле фамилия должно быть заполненно!';
            }
            else
            {
                if (!User::checkName($surname)) {
                    $errors[] = 'Фамилия не должна быть короче 3-х символов';
                }
            }

            if($email=='')
            {
                $errors[] = 'Поле e-mail должно быть заполненно!';
            }
            else
            {
                if (!User::checkEmail($email)) {
                    $errors[] = 'Неправильный email';
                }
            }

            if($password=='')
            {
                $errors[] = 'Поле пароль должно быть заполненно!';
            }
            else
            {
                if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }
            }
            
            if($phone=='')
            {
                $errors[] = 'Поле телефон должно быть заполненно!';
            }
            else
            {
                if (!User::checkPhone($phone)) {
                    $errors[] = 'Телефон не должен быть короче 12-ти цифр';
                }
            }
            if($birthday=='')
            {
                $errors[] = 'Поле дата рождения должно быть заполненно!';
            }

            if($gender!='')
            {
                if ($gender=='Мужской') {
                    $gender1=0;
                }
                else
                {
                    $gender1=1;
                }
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                
                $result = User::register($name,$surname,$phone, $email, $gender1, $birthday, $password);
            }

        }


        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
                        
            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } 
            else {
                User::auth($userId);
                header("Location: /site/index");
            }

        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }
    

    public function actionLogout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /user/login");
    }

}
