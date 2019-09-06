<?php

use Kaspi\Migration\Migration;

class Tasks extends Migration
{

    public function up(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec(
            'CREATE TABLE Tasks(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                userName varchar(255),
                email varchar(100),
                content text,
                editByAdmin INTEGER(1) DEFAULT 0,
                completed INTEGER(1)
            )');
    }

    public function down(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec('DROP TABLE Tasks');
    }

}
