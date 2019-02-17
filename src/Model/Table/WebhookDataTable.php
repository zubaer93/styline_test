<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WebhookData Model
 *
 * @property \App\Model\Table\WebhooksTable|\Cake\ORM\Association\BelongsTo $Webhooks
 *
 * @method \App\Model\Entity\WebhookData get($primaryKey, $options = [])
 * @method \App\Model\Entity\WebhookData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WebhookData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WebhookData|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WebhookData|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WebhookData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WebhookData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WebhookData findOrCreate($search, callable $callback = null, $options = [])
 */
class WebhookDataTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('webhook_data');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Webhook', [
            'foreignKey' => 'webhook_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('author_name')
            ->maxLength('author_name', 111)
            ->requirePresence('author_name', 'create')
            ->allowEmptyString('author_name', false);

        $validator
            ->scalar('author_email')
            ->maxLength('author_email', 111)
            ->requirePresence('author_email', 'create')
            ->allowEmptyString('author_email', false);

        $validator
            ->scalar('commit')
            ->maxLength('commit', 111)
            ->requirePresence('commit', 'create')
            ->allowEmptyString('commit', false);

        $validator
            ->scalar('repository')
            ->maxLength('repository', 111)
            ->requirePresence('repository', 'create')
            ->allowEmptyString('repository', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['webhook_id'], 'Webhooks'));

        return $rules;
    }
}
