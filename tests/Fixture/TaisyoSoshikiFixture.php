<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TaisyoSoshikiFixture
 */
class TaisyoSoshikiFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'taisyo_soshiki';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'KYOIKU_CODE' => '',
                'KAISYA_CODE' => '',
                'SOSHIKI_CODE' => 'Lorem ipsum dolor sit amet',
                'TOROKU_DATE' => '2024-07-23',
                'TOROKU_CN' => 'Lorem ipsum do',
                'TOROKU_TRM' => 'Lorem ipsum dolor sit',
                'KOSHIN_DATE' => '2024-07-23',
                'KOSHIN_CN' => 'Lorem ipsum do',
                'KOSHIN_TRM' => 'Lorem ipsum dolor sit',
                'SAKUJO_DATE' => '2024-07-23',
                'SAKUJO_CN' => 'Lorem ipsum do',
                'SAKUJO_TRM' => 'Lorem ipsum dolor sit',
                'SAKUJO_FLAG' => '',
                'KAISYA_NAME_JPN' => 'Lorem ipsum dolor sit amet',
                'SOSHIKI_NAME_JPN' => 'Lorem ipsum dolor sit amet',
                'SOSHIKI_NAME_RYAKUSYO1' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
