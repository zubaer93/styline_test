<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WebhookTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WebhookTable Test Case
 */
class WebhookTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WebhookTable
     */
    public $Webhook;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Webhook'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Webhook') ? [] : ['className' => WebhookTable::class];
        $this->Webhook = TableRegistry::getTableLocator()->get('Webhook', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Webhook);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
