<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory as Faker;

/**
 * TaisyoSoshiki seed.
 */
class TaisyoSoshikiSeed extends AbstractSeed
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

        $soshikiNames = [
            '営業組', 
            '総務組', 
            '人事組', 
            '経理組', 
            '開発組', 
            '企画組', 
            '広報組', 
            '法務組', 
            '品質管理組', 
            '購買組'
        ];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'KYOIKU_CODE' => 'E' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'KAISYA_CODE' => 'K' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'SOSHIKI_CODE' => 'S' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
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
                'SOSHIKI_NAME_JPN' => $soshikiNames[$i - 1],
                'SOSHIKI_NAME_RYAKUSYO1' => $faker->word
            ];
        }

        $table = $this->table('taisyo_soshiki');
        $table->insert($data)->save();
    }
}
