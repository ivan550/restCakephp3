<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProyectoFixture
 *
 */
class ProyectoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'proyecto';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'proyecto_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'colaborador_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'pro_nombre' => ['type' => 'string', 'length' => 500, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'pro_nombre_corto' => ['type' => 'string', 'length' => 50, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['proyecto_id'], 'length' => []],
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
            'proyecto_id' => 1,
            'colaborador_id' => 1,
            'pro_nombre' => 'Lorem ipsum dolor sit amet',
            'pro_nombre_corto' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
