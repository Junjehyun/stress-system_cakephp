<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateKaisyaMst extends AbstractMigration
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
        $table = $this->table('kaisya_mst', ['id' => false, 'primary_key' => 'KAISYA_CODE']);
        $table->addColumn('KAISYA_CODE', 'char', ['limit' => 6, 'null' => false])
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
                ->addColumn('KAISYA_NAME_ENG', 'string', ['limit' => 128, 'null' => false])
                ->create();
    }
}
