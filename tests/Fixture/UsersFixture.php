<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'NAME' => 'Lorem ip',
                'EMAIL' => 'Lorem ipsum dolor ',
                'USER_ID' => 'Lorem ipsum ',
                'KAISYA_CODE' => '',
                'SOSHIKI_CODE' => 'Lorem ipsum dolor sit amet',
                'KENGEN_KUBUN' => 1,
                'password' => 'Lorem ipsum dolor sit amet',
                'email_verified_at' => 1721726934,
                'remember_token' => 'Lorem ipsum dolor sit amet',
                'current_team_id' => 1,
                'profile_photo_path' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1721726934,
                'updated_at' => 1721726934,
            ],
        ];
        parent::init();
    }
}
