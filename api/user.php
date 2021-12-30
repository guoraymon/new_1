<?php

use App\Models\UserModel;

class user
{
    /**
     *
     */
    public function login()
    {
        echo 'login';
    }

    /**
     *
     */
    public function register()
    {
        echo 'register';
    }

    /**
     *
     */
    public function data(): void
    {
        $user = UserModel::find(1);
        var_dump($user);
    }
}