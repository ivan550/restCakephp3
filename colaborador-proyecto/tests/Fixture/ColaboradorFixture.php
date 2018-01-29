<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ColaboradorFixture
 *
 */
class ColaboradorFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'colaborador';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'colaborador_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'area_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'col_iniciales' => ['type' => 'string', 'length' => 10, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_nombre' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_primer_apellido' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_segundo_apellido' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_correo' => ['type' => 'string', 'length' => 150, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_contrasenia' => ['type' => 'string', 'length' => 250, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_ruta_foto' => ['type' => 'string', 'length' => 150, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'col_estado' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['colaborador_id'], 'length' => []],
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
            'colaborador_id' => 1,
            'area_id' => 1,
            'col_iniciales' => 'Lorem ip',
            'col_nombre' => 'Lorem ipsum dolor sit amet',
            'col_primer_apellido' => 'Lorem ipsum dolor sit amet',
            'col_segundo_apellido' => 'Lorem ipsum dolor sit amet',
            'col_correo' => 'Lorem ipsum dolor sit amet',
            'col_contrasenia' => 'Lorem ipsum dolor sit amet',
            'col_ruta_foto' => 'Lorem ipsum dolor sit amet',
            'col_estado' => 1
        ],
    ];
}
