<?php

use Kaspi\Migration\Migration;

class TasksEmailUniqueIndex extends Migration
{

    public function up(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        $pdo->exec('CREATE UNIQUE INDEX Tasks_email ON Tasks (email)');
    }

    public function down(): void
    {
        /** @var \PDO $pdo */
        $pdo = $this->db;
        if ($pdo->getAttribute(\PDO::ATTR_DRIVER_NAME) === 'mysql')
        {
            $pdo->exec('ALTER TABLE Tasks DROP INDEX Tasks_email;');
        } else {
            $pdo->exec('DROP INDEX IF EXISTS Tasks_email');
        }
    }

}
