<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Colaborador Entity
 *
 * @property int $colaborador_id
 * @property int $area_id
 * @property string $col_iniciales
 * @property string $col_nombre
 * @property string $col_primer_apellido
 * @property string $col_segundo_apellido
 * @property string $col_correo
 * @property string $col_contrasenia
 * @property string $col_ruta_foto
 * @property bool $col_estado
 */
class Colaborador extends Entity {

    protected $_accessible = [
        '*' => true,
        'colaborador_id' => false
    ];

}
