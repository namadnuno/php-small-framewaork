<?php

namespace Acme\DB;

class User extends Model
{
    protected $table = 'users';

    public static function all()
    {
        return self::query('select * from users');
    }

    public static function findById($id)
    {
        return self::find('select * from users where id = ?', [ strval($id) ]);
    }
}
