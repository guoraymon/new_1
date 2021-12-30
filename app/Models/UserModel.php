<?php

namespace App\Models;

use Core\Common;
use PDO;

class UserModel
{
    public int $id;
    public int $hp;
    public int $ep;
    public int $mp;
    public array $data;

    /**
     * @param $id
     * @return static
     */
    public static function find($id)
    {
        $sql = 'SELECT * FROM `users` WHERE `id`=?';
        $pdo = Common::getPdo();
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $instance = new static();
            foreach ($result as $k => $v) {
                if ($k === 'data') {
                    $v = json_decode($v);
                }
                $instance->$k = $v;
            }
            return $instance;
        }
        die('user not find');
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $sql = 'UPDATE `users` SET `hp`=?,`ep`=?,`mp`=? WHERE `id`=?;';
        $pdo = Common::getPdo();
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $this->hp, PDO::PARAM_INT);
        $statement->bindValue(2, $this->ep, PDO::PARAM_INT);
        $statement->bindValue(3, $this->mp, PDO::PARAM_INT);
        $statement->bindValue(4, $this->id, PDO::PARAM_INT);
        $statement->execute();
    }
}