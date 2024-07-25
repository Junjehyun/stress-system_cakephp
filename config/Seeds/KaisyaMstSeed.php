<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory as Faker;

/**
 * KaisyaMst seed.
 */
class KaisyaMstSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP');
        $data = [];
        /**
         * データを生成する
         * 
         */
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'KAISYA_CODE' => 'K' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'TOROKU_DATE' => $faker->date(),
                'TOROKU_CN' => $faker->randomNumber(3),
                'TOROKU_TRM' => $faker->word,
                'KOSHIN_DATE' => $faker->date(),
                'KOSHIN_CN' => $faker->randomNumber(3),
                'KOSHIN_TRM' => $faker->word,
                'SAKUJO_DATE' => null,
                'SAKUJO_CN' => null,
                'SAKUJO_TRM' => null,
                'SAKUJO_FLAG' => '0',
                'KAISYA_NAME_JPN' => $faker->company,
                'KAISYA_NAME_ENG' => Faker::create('en_US')->company
                ];
            }
            $table = $this->table('kaisya_mst');
            $table->insert($data)->save();
    }
}
