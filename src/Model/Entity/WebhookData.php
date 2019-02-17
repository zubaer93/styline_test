<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WebhookData Entity
 *
 * @property int $id
 * @property string $author_name
 * @property string $author_email
 * @property string $commit
 * @property string $repository
 * @property int $webhook_id
 *
 * @property \App\Model\Entity\Webhook $webhook
 */
class WebhookData extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'author_name' => true,
        'author_email' => true,
        'commit' => true,
        'repository' => true,
        'webhook_id' => true,
        'webhook' => true
    ];
}
