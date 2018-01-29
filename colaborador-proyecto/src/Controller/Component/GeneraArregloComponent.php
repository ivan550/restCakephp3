<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;

class GeneraArregloComponent extends Component {
    /* Se genera un arreglo para llenar la bitácora, el cual se hará en cada una de la acciones */

    public function llena($colaborador_id, $accion_id)
    {
        $fecha = Time::now();
        $fecha->timezone = 'America/Mexico_City';
        return $arreglo_bitacora = [
            "bit_fecha" => $fecha,
            "colaborador_id" => $colaborador_id,
            "accion_id" => $accion_id
        ];
    }

}
