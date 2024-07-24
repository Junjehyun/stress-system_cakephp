<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('NAME', 'string', ['limit' => 10])
            ->addColumn('EMAIL', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('USER_ID', 'string', ['limit' => 14])
            ->addColumn('KAISYA_CODE', 'char', ['limit' => 6])
            ->addColumn('SOSHIKI_CODE', 'string', ['limit' => 69])
            ->addColumn('KENGEN_KUBUN', 'tinyinteger', ['null' => true])

            ->addColumn('password', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email_verified_at', 'timestamp', ['null' => true])
            ->addColumn('remember_token', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('current_team_id', 'integer', ['null' => true])
            ->addColumn('profile_photo_path', 'string', ['limit' => 2048, 'null' => true])
            ->addTimestamps('created_at', 'updated_at')
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
