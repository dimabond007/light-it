<?php

class User
{
    public static function register($name,$surname,$phone, $email,$gender,$birthday, $password) {
        
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (firstname,lastname,phone, email, gender,birthday, password) '
                . 'VALUES (:name, :surname, :phone, :email, :gender, :birthday, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':gender', $gender, PDO::PARAM_STR);
        $result->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkName($name) {
        if (strlen($name) >= 3) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkPhone($string) {
        $pattern = "/^\d{12}$/";
        if(preg_match($pattern, $string)) 
        {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }
    
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {

            return $_SESSION['user'];
        }
        else
        {
           header("Location: /user/login");
        }
    }
    
    public static function checkMsg($msg)
    {
        if (strlen($msg) >= 12) {
            return true;
        }
        return false;
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM users WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }

    public static function setSms($message,$nameUser,$email,$date) 
    {
        
        $db = Db::getConnection();
        $sql = 'INSERT INTO inmessage (message,nameUser,email, date) '
                . 'VALUES (:message, :nameUser, :email, :date)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        $result->bindParam(':nameUser', $nameUser, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getAllObjSms()
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM inmessage ';

        $result = $db->prepare($sql);
        $result->execute();

        return $result->fetchAll();
    }

}