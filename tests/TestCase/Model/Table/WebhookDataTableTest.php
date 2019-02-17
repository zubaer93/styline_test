<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WebhookDataTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WebhookDataTable Test Case
 */
class WebhookDataTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WebhookDataTable
     */
    public $WebhookData;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.WebhookData',
        'app.Webhooks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WebhookData') ? [] : ['className' => WebhookDataTable::class];
        $this->WebhookData = TableRegistry::getTableLocator()->get('WebhookData', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WebhookData);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
