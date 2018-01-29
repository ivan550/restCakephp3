<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ContraseniaComponent extends Component {

    public function aleatoria($longuitud)
    {

        $var = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!?.';
        $long = strlen($var);
        $aleatoria = '';
        for ($i = 0; $i < $longuitud; $i++)
        {
            $aleatoria .= $var[rand(0, $long - 1)];
        }
        return $aleatoria;
    }

}
