<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\RulesChecker;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('NAME');
        $this->setPrimaryKey('id');

        // 他のテーブルとの関連付け
        $this->belongsTo('KaisyaMst', [
            'foreignKey' => 'KAISYA_CODE',
            'bindingKey' => 'KAISYA_CODE',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('TaisyoSoshiki', [
            'foreignKey' => 'SOSHIKI_CODE',
            'bindingKey' => 'SOSHIKI_CODE',
            'joinType' => 'LEFT'
        ]);

        // timestamp behaviorを追加すると、created_atとupdated_atフィールドが自動的に管理される
        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => 'updated_at',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 10, '氏名は10文字以内で入力してください。')
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME', '氏名は必須です。');

        $validator
            ->scalar('EMAIL')
            ->maxLength('EMAIL', 20)
            ->allowEmptyString('EMAIL')
            ->add('EMAIL', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('USER_ID')
            ->maxLength('USER_ID', 10 , '社員IDは10文字以内で入力してください。')
            ->requirePresence('USER_ID', 'create')
            ->notEmptyString('USER_ID', '社員IDは必須です。');

        $validator
            ->scalar('KAISYA_CODE')
            ->maxLength('KAISYA_CODE', 6)
            ->requirePresence('KAISYA_CODE', 'create')
            ->notEmptyString('KAISYA_CODE', '会社名は必須です。');

        $validator
            ->scalar('SOSHIKI_CODE')
            ->maxLength('SOSHIKI_CODE', 69)
            ->requirePresence('SOSHIKI_CODE', 'create')
            ->notEmptyString('SOSHIKI_CODE', '組織名は必須です。');

        $validator
            ->scalar('KENGEN_KUBUN')
            ->requirePresence('KENGEN_KUBUN', 'create', '全社または自社を選択してください。')
            ->notEmptyString('権限区分チェックをして下さい。');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->dateTime('email_verified_at')
            ->allowEmptyDateTime('email_verified_at');

        $validator
            ->scalar('remember_token')
            ->maxLength('remember_token', 100)
            ->allowEmptyString('remember_token');

        $validator
            ->integer('current_team_id')
            ->allowEmptyString('current_team_id');

        $validator
            ->scalar('profile_photo_path')
            ->maxLength('profile_photo_path', 2048)
            ->allowEmptyFile('profile_photo_path');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->isUnique(['EMAIL'], ['allowMultipleNulls' => true]), ['errorField' => 'EMAIL']);

    //     return $rules;
    // }
}
