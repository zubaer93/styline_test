<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Webhook Model
 *
 * @method \App\Model\Entity\Webhook get($primaryKey, $options = [])
 * @method \App\Model\Entity\Webhook newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Webhook[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Webhook|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Webhook|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Webhook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Webhook[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Webhook findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WebhookTable extends Table
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

        $this->setTable('webhook');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }
    public function afterSave($entity)
    {
        $searchSummaryObj = TableRegistry::get('WebhookData');
        $entityData = json_decode($entity->data['entity']['body']);
        $data = (array)$entityData;
        $author = (array) $data['commits'][0];
        $data2 = [
            'author_name' =>$author['author']->name,
            'author_email' => $author['author']->email,
            'commit' => $author['message'],
            'repository' => $data['repository']->name,
            'id' => $entity->data['entity']->id
        ];
        $this->WebhookData->save($data2);
    }
}
