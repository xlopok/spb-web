<?php

namespace Moguta\Models\Users;

use Moguta\Services\Db;

class User
{
    public static function getUserByEmail(string $email = null)
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email = :email',
            [':email' => $email]);
        return $result;
    }

    public static function getUserByEmailPattern(string $email = null)
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM user u JOIN user_info ui ON u.id = ui.user_id WHERE u.email like :email',
            [':email' => $email . '%']);
        return $result;
    }
}