<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $NAME
 * @property string|null $EMAIL
 * @property string $USER_ID
 * @property string $KAISYA_CODE
 * @property string $SOSHIKI_CODE
 * @property int|null $KENGEN_KUBUN
 * @property string|null $password
 * @property \Cake\I18n\FrozenTime|null $email_verified_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 */
class User extends Entity
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
        'NAME' => true,
        'EMAIL' => true,
        'USER_ID' => true,
        'KAISYA_CODE' => true,
        'SOSHIKI_CODE' => true,
        'KENGEN_KUBUN' => true,
        'password' => true,
        'email_verified_at' => true,
        'remember_token' => true,
        'current_team_id' => true,
        'profile_photo_path' => true,
        'created_at' => true,
        'updated_at' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
