<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bitacora Entity
 *
 * @property int $bitacora_id
 * @property \Cake\I18n\FrozenTime $bit_fecha
 * @property int $colaborador_id
 * @property int $accion_id
 */
class Bitacora extends Entity {

    protected $_accessible = [
        '*' => true,
        'bitacora_id' => false
    ];

}
