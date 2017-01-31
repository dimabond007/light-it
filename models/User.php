<?php

class User
{
    public static function register($name,$surname,$phone, $email,$gender,$birthday, $password) {
        
        $password=password_hash($password,PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (firstname,lastname,phone, email, gender,birthday, password) VALUES (?,?,?,?,?,?,?)';
        $db = Db::run($sql,[$name,$surname,$phone,$email,$gender,$birthday,$password]);
        return $db;
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
    
    public static function checkPhone($string) 
    {
        $pattern = "/^\d{12}$/";
        if(preg_match($pattern, $string)) 
        {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email) 
    {
        
        $sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
        $db = Db::run($sql,[$email]);
        $db->execute();

        if($db->fetchColumn())
            return true;
        return false;
    }
    
    public static function checkUserData($email, $password)
    {
        
        $sql = 'SELECT * FROM users WHERE email = ?';
        $db = Db::run($sql,[$email]);
        $db->execute();

        $user = $db->fetch();
        if ($user) {
            if(password_verify($password, $user['password']))
            {
                return $user['id'];
            }   
            
        }

        return false;
    }

   
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
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
            
            $sql = 'SELECT * FROM users WHERE id = ?';
            $db = Db::run($sql,[$id]);

            $db->setFetchMode(PDO::FETCH_ASSOC);
            $db->execute();


            return $db->fetch();
        }
    }

    public static function setSms($message,$nameUser,$email,$date) 
    {
        $sql = 'INSERT INTO inmessage (message,nameUser,email, date) VALUES (?,?,?,?)';
        $db = Db::run($sql,[$message,$nameUser,$email,$date]);

        return $db->execute();
    }

    public static function getAllObjSms()
    {
        $sql = 'SELECT * FROM inmessage ';
        $db = Db::run($sql);
        return $db->fetchAll();
    }

}