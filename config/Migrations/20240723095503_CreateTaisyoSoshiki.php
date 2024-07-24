<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTaisyoSoshiki extends AbstractMigration
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
        $table = $this->table('taisyo_soshiki', ['id' => false, 'primary_key' => 'KYOIKU_CODE', 'KAISYA_CODE', 'SOSHIKI_CODE']);
        $table->addColumn('KYOIKU_CODE', 'char', ['limit' => 20, 'null' => false])
                ->addColumn('KAISYA_CODE', 'char', ['limit' => 6, 'null' => false])
                ->addColumn('SOSHIKI_CODE', 'string', ['limit' => 69, 'null' => false])
                ->addColumn('TOROKU_DATE', 'date', ['null' => false])
                ->addColumn('TOROKU_CN', 'string', ['limit' => 16, 'null' => true])
                ->addColumn('TOROKU_TRM', 'string', ['limit' => 23, 'null' => true])
                ->addColumn('KOSHIN_DATE', 'date', ['null' => true])
                ->addColumn('KOSHIN_CN', 'string', ['limit' => 16, 'null' => true])
                ->addColumn('KOSHIN_TRM', 'string', ['limit' => 23, 'null' => true])
                ->addColumn('SAKUJO_DATE', 'date', ['null' => true])
                ->addColumn('SAKUJO_CN', 'string', ['limit' => 16, 'null' => true])
                ->addColumn('SAKUJO_TRM', 'string', ['limit' => 23, 'null' => true])
                ->addColumn('SAKUJO_FLAG', 'char', ['limit' => 1, 'null' => false])
                ->addColumn('KAISYA_NAME_JPN', 'string', ['limit' => 128, 'null' => false])
                ->addColumn('SOSHIKI_NAME_JPN', 'string', ['limit' => 100, 'null' => false])
                ->addColumn('SOSHIKI_NAME_RYAKUSYO1', 'string', ['limit' => 62, 'null' => false])
                ->create();
    }
}
