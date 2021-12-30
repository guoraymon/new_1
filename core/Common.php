<?php

namespace Core;

use Dotenv\Dotenv;
use PDO;

class Common
{
    /**
     * TODO::待优化为从容器中取
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        $dotenv = Dotenv::createImmutable(ROOT_DIR);
        $dotenv->load();

        $dsn = "{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}";
        return new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }
}