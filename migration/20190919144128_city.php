<?php

use Kaspi\Migration\Migration;

class City extends Migration
{

    public function up(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec('CREATE TABLE City(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name varchar(255)
            )');
        $pdo->exec('CREATE UNIQUE INDEX CitiesName ON City (name)');
        $pdo->exec('INSERT INTO City (name) values("Тольятти"), ("Самара"), ("Москва")');
        // Добавим в таблицу задач city_id
        $pdo->exec('ALTER TABLE Tasks ADD city_id int DEFAULT 0');
        $pdo->exec('CREATE INDEX city_index ON Tasks (city_id)');
    }

    public function down(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        // Удалим колонику из табоицы задач
        // для изменения структуры в sqlite придется переписать всю таблицу :(
        if ('sqlite' === $pdo->getAttribute(\PDO::ATTR_DRIVER_NAME)) {
            $pdo->exec('DROP INDEX city_index');
            $pdo->exec('DROP INDEX Tasks_email');
            $pdo->exec('CREATE TABLE Tasks5bc3
                        (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            userName varchar(255),
                            email varchar(100),
                            content text,
                            editByAdmin INTEGER(1) DEFAULT 0
                        )');
            $pdo->exec('CREATE UNIQUE INDEX Tasks_email ON Tasks5bc3 (email)');
            $pdo->exec('INSERT INTO Tasks5bc3(id, userName, email, content, editByAdmin) SELECT id, userName, email, content, editByAdmin FROM Tasks');
            $pdo->exec('DROP TABLE Tasks');
            $pdo->exec('ALTER TABLE Tasks5bc3 RENAME TO Tasks');
        } else {
            $pdo->exec('DROP INDEX city_index');
            $pdo->exec('ALTER TABLE Tasks DROP COLUMN city_id');
        }
        $pdo->exec('DROP TABLE City');
    }
}
