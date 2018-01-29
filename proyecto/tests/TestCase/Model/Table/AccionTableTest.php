<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccionTable Test Case
 */
class AccionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccionTable
     */
    public $Accion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.accion',
        'app.accions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Accion') ? [] : ['className' => AccionTable::class];
        $this->Accion = TableRegistry::get('Accion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accion);

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
