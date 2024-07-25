<?php
declare(strict_types=1);

use Cake\Log\Log;
use Migrations\AbstractSeed;
use Faker\Factory as Faker;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
        $usedEmails = [];

        /**
         * 重複しないようにするために、使用済みのメールアドレスを保持する
         * 
         */
        for ($i = 1; $i < 11; $i++) {
            do {
                $emailUser = substr($faker->unique()->userName, 0, 8);  
                $emailDomain = 'stress.com';  
                $email = $emailUser . '@' . $emailDomain;
            } while (in_array($email, $usedEmails));
            $usedEmails[] = $email;
            
            $data[] = [
                /**
                 * 重要なカラム
                 */
                'NAME' => $faker->name,
                'EMAIL' => $email,
                'USER_ID' => 'U' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'KAISYA_CODE' => 'K' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'SOSHIKI_CODE' => 'S' . str_pad((string)$i, 3, '0', STR_PAD_LEFT),
                'KENGEN_KUBUN' => $faker->randomElement(['01', '02']),
                /**
                 * その他のカラム
                 */
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'email_verified_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'remember_token' => $faker->sha256,
                'current_team_id' => $faker->numberBetween(1, 10),
                'profile_photo_path' => $faker->imageUrl(640, 480, 'people'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
