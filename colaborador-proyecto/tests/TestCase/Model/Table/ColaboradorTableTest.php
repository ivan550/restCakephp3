<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ColaboradorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ColaboradorTable Test Case
 */
class ColaboradorTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ColaboradorTable
     */
    public $Colaborador;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.colaborador',
        'app.colaboradors',
        'app.areas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Colaborador') ? [] : ['className' => ColaboradorTable::class];
        $this->Colaborador = TableRegistry::get('Colaborador', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Colaborador);

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
