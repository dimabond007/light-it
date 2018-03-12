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
        $errors = false;
        
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

        View::generate( '/views/user/register.php', ['errors'=>$errors, 'result' => $result,'name'=>$name,'surname'=>$surname,'email'=>$email,'password'=>$password,'phone'=>$phone,'birthday'=>$birthday]);

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';
        $errors = false;
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
                        
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
                header("Location: /feedback/index");
            }

        }
        View::generate( '/views/user/login.php', ['errors' => $errors,'email'=>$email,'password'=>$password]);

        return true;
    }
    

    public function actionLogout()
    {
        unset($_SESSION["user"]);
        header("Location: /user/login");
    }

}
