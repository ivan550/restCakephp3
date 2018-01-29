<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BitacoraFixture
 *
 */
class BitacoraFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bitacora';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'bitacora_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'bit_fecha' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'colaborador_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'accion_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['bitacora_id'], 'length' => []],
            'accion_id' => ['type' => 'foreign', 'columns' => ['accion_id'], 'references' => ['accion', 'accion_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'colaborador_id' => ['type' => 'foreign', 'columns' => ['colaborador_id'], 'references' => ['colaborador', 'colaborador_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'bitacora_id' => 1,
            'bit_fecha' => 1498599844,
            'colaborador_id' => 1,
            'accion_id' => 1
        ],
    ];
}
