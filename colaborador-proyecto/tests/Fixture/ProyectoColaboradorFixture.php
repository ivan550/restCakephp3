<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProyectoColaboradorFixture
 *
 */
class ProyectoColaboradorFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'proyecto_colaborador';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'rol_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'proyecto_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'colaborador_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'proy_col_rol_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['proy_col_rol_id'], 'length' => []],
            'proyecto_colaborador_rol_id_proyecto_id_colaborador_id_key' => ['type' => 'unique', 'columns' => ['rol_id', 'proyecto_id', 'colaborador_id'], 'length' => []],
            'rol_id_fk' => ['type' => 'foreign', 'columns' => ['rol_id'], 'references' => ['rol', 'rol_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'rol_id' => 1,
            'proyecto_id' => 1,
            'colaborador_id' => 1,
            'proy_col_rol_id' => 1
        ],
    ];
}
