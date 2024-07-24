<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaisyoSoshiki Model
 *
 * @method \App\Model\Entity\TaisyoSoshiki newEmptyEntity()
 * @method \App\Model\Entity\TaisyoSoshiki newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaisyoSoshiki[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TaisyoSoshikiTable extends Table
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

        $this->setTable('taisyo_soshiki');
        $this->setDisplayField('SOSHIKI_CODE');
        $this->setPrimaryKey('KYOIKU_CODE');

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
            ->scalar('KAISYA_CODE')
            ->maxLength('KAISYA_CODE', 6)
            ->requirePresence('KAISYA_CODE', 'create')
            ->notEmptyString('KAISYA_CODE');

        $validator
            ->scalar('SOSHIKI_CODE')
            ->maxLength('SOSHIKI_CODE', 69)
            ->requirePresence('SOSHIKI_CODE', 'create')
            ->notEmptyString('SOSHIKI_CODE');

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
            ->scalar('SOSHIKI_NAME_JPN')
            ->maxLength('SOSHIKI_NAME_JPN', 100)
            ->requirePresence('SOSHIKI_NAME_JPN', 'create')
            ->notEmptyString('SOSHIKI_NAME_JPN');

        $validator
            ->scalar('SOSHIKI_NAME_RYAKUSYO1')
            ->maxLength('SOSHIKI_NAME_RYAKUSYO1', 62)
            ->requirePresence('SOSHIKI_NAME_RYAKUSYO1', 'create')
            ->notEmptyString('SOSHIKI_NAME_RYAKUSYO1');

        return $validator;
    }
}
