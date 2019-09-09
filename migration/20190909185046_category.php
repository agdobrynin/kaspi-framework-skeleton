<?php

use Kaspi\Migration\Migration;

class Category extends Migration
{

    public function up(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec('CREATE TABLE Category(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name varchar(255)
            )');
        $pdo->exec('CREATE TABLE TaskToCategory(
                task_id integer,
                category_id integer
            )');
        $pdo->exec('CREATE UNIQUE INDEX TaskCategory ON TaskToCategory (task_id, category_id)');
    }

    public function down(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec('DROP TABLE TaskToCategory');
        $pdo->exec('DROP TABLE Category');
    }

}
