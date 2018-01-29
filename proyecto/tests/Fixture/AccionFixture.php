<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccionFixture
 *
 */
class AccionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'accion';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'accion_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'acn_nombre' => ['type' => 'string', 'length' => 100, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['accion_id'], 'length' => []],
            'acn_nombre_uq' => ['type' => 'unique', 'columns' => ['acn_nombre'], 'length' => []],
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
            'accion_id' => 1,
            'acn_nombre' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
