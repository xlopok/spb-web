<?php

namespace Moguta\Services;

use Moguta\Exceptions\DbException;

class Db
{
    private static $instance;

    private $pdo;

    private function __construct()
    {
        try {
            $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );

            $this->pdo->exec('SET NAMES UTF8');
        }  catch (\PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }

    public function query(string $sql, $params =[], string $classname = 'stdClass'): ?array
    {
        $sth=$this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if(false === $result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getInstance(): self
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}