<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KaisyaMst Model
 *
 * @method \App\Model\Entity\KaisyaMst newEmptyEntity()
 * @method \App\Model\Entity\KaisyaMst newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\KaisyaMst[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KaisyaMst get($primaryKey, $options = [])
 * @method \App\Model\Entity\KaisyaMst findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\KaisyaMst patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\KaisyaMst[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\KaisyaMst|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KaisyaMst saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KaisyaMst[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\KaisyaMst[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\KaisyaMst[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\KaisyaMst[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class KaisyaMstTable extends Table
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

        $this->setTable('kaisya_mst');
        $this->setDisplayField('KAISYA_NAME_JPN');
        $this->setPrimaryKey('KAISYA_CODE');

        // 他のテーブルとの関連付け
        $this->hasMany('Users', [
            'foreignKey' => 'KAISYA_CODE',
            'bindingKey' => 'KAISYA_CODE',
            'joinType' => 'LEFT'
        ]);

         // Timestampにより、created_at、updated_atの自動管理
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
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
            ->date('TOROKU_DATE')
            ->requirePresence('TOROKU_DATE', 'create')
            ->notEmptyDate('TOROKU_DATE');

        $validator
            ->scalar('TOROKU_CN')
            ->maxLength('TOROKU_CN', 16)
            ->allowEmptyString('TOROKU_CN');

        $validator
            ->scalar('TOROKU_TRM')
            ->maxLength('TOROKU_TRM', 23)
            ->allowEmptyString('TOROKU_TRM');

        $validator
            ->date('KOSHIN_DATE')
            ->allowEmptyDate('KOSHIN_DATE');

        $validator
            ->scalar('KOSHIN_CN')
            ->maxLength('KOSHIN_CN', 16)
            ->allowEmptyString('KOSHIN_CN');

        $validator
            ->scalar('KOSHIN_TRM')
            ->maxLength('KOSHIN_TRM', 23)
            ->allowEmptyString('KOSHIN_TRM');

        $validator
            ->date('SAKUJO_DATE')
            ->allowEmptyDate('SAKUJO_DATE');

        $validator
            ->scalar('SAKUJO_CN')
            ->maxLength('SAKUJO_CN', 16)
            ->allowEmptyString('SAKUJO_CN');

        $validator
            ->scalar('SAKUJO_TRM')
            ->maxLength('SAKUJO_TRM', 23)
            ->allowEmptyString('SAKUJO_TRM');

        $validator
            ->scalar('SAKUJO_FLAG')
            ->maxLength('SAKUJO_FLAG', 1)
            ->requirePresence('SAKUJO_FLAG', 'create')
            ->notEmptyString('SAKUJO_FLAG');

        $validator
            ->scalar('KAISYA_NAME_JPN')
            ->maxLength('KAISYA_NAME_JPN', 128)
            ->requirePresence('KAISYA_NAME_JPN', 'create')
            ->notEmptyString('KAISYA_NAME_JPN');

        $validator
            ->scalar('KAISYA_NAME_ENG')
            ->maxLength('KAISYA_NAME_ENG', 128)
            ->requirePresence('KAISYA_NAME_ENG', 'create')
            ->notEmptyString('KAISYA_NAME_ENG');

        return $validator;
    }
}
