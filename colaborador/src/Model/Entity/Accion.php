<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Accion extends Entity {

    protected $_accessible = [
        '*' => true,
        'accion_id' => false
    ];

}
