<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proyecto Entity
 *
 * @property int $proyecto_id
 * @property int $colaborador_id
 * @property string $pro_nombre
 * @property string $pro_nombre_corto
 */
class Proyecto extends Entity {

    protected $_accessible = [
        '*' => true,
        'proyecto_id' => false
    ];

}
