<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accion Entity
 * @property int $accion_id
 * @property string $acn_nombre
 */
class Accion extends Entity {

    protected $_accessible = [
        '*' => true,
        'accion_id' => false
    ];

}
