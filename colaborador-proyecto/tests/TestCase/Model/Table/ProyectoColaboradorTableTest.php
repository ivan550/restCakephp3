<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProyectoColaboradorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProyectoColaboradorTable Test Case
 */
class ProyectoColaboradorTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProyectoColaboradorTable
     */
    public $ProyectoColaborador;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.proyecto_colaborador',
        'app.rol',
        'app.proyectos',
        'app.colaboradors',
        'app.proy_col_rols'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProyectoColaborador') ? [] : ['className' => ProyectoColaboradorTable::class];
        $this->ProyectoColaborador = TableRegistry::get('ProyectoColaborador', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProyectoColaborador);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
