<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * KaisyaMstFixture
 */
class KaisyaMstFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'kaisya_mst';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'KAISYA_CODE' => '',
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
                'KAISYA_NAME_ENG' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
