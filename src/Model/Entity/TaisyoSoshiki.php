<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaisyoSoshiki Entity
 *
 * @property string $KYOIKU_CODE
 * @property string $KAISYA_CODE
 * @property string $SOSHIKI_CODE
 * @property \Cake\I18n\FrozenDate $TOROKU_DATE
 * @property string|null $TOROKU_CN
 * @property string|null $TOROKU_TRM
 * @property \Cake\I18n\FrozenDate|null $KOSHIN_DATE
 * @property string|null $KOSHIN_CN
 * @property string|null $KOSHIN_TRM
 * @property \Cake\I18n\FrozenDate|null $SAKUJO_DATE
 * @property string|null $SAKUJO_CN
 * @property string|null $SAKUJO_TRM
 * @property string $SAKUJO_FLAG
 * @property string $KAISYA_NAME_JPN
 * @property string $SOSHIKI_NAME_JPN
 * @property string $SOSHIKI_NAME_RYAKUSYO1
 */
class TaisyoSoshiki extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'KAISYA_CODE' => true,
        'SOSHIKI_CODE' => true,
        'TOROKU_DATE' => true,
        'TOROKU_CN' => true,
        'TOROKU_TRM' => true,
        'KOSHIN_DATE' => true,
        'KOSHIN_CN' => true,
        'KOSHIN_TRM' => true,
        'SAKUJO_DATE' => true,
        'SAKUJO_CN' => true,
        'SAKUJO_TRM' => true,
        'SAKUJO_FLAG' => true,
        'KAISYA_NAME_JPN' => true,
        'SOSHIKI_NAME_JPN' => true,
        'SOSHIKI_NAME_RYAKUSYO1' => true,
    ];
}
