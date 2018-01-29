<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;

class AutenticacionComponent extends Component {
    /* Se pasa el controlador donde será ocupado el componente para poder utilizar el método set */

    public function acceso($controller)
    {
        if ($this->request->is(['post', 'put', 'delete']))
        {
            $http = new Client();
            /* Se hace la petición a la API "colaborador" para validar el acceso a los microservicios de la API "proyecto" */
            $colaborador = $http->post('http://localhost/colaborador/api/colaborador/acceso.json', json_encode($this->request->getData()), ['type' => 'json']);
            $colaborador = $colaborador->json;
            /* Si se autenticó correctamente la variable colaborador_id debe estar definida */
            if (isset($colaborador['colaborador_id']))
            {
                return $colaborador['colaborador_id'];
            }
            /* De lo contrario se manda el mensaje que regresa la petición */
            else
            {
                $controller->set([
                    'message' => $colaborador['message'],
                    '_serialize' => ['message']
                ]);
                return false;
            }
        }
    }

    /* Se verifica que se envíe el parámetro proyecto_id en los microservicios que lo requieran */

    public function verifica_parametro($controller)
    {
        $datos = $this->request->getData();
        if (isset($datos['proyecto_id']) && !empty($datos['proyecto_id']))
        {
            return $datos['proyecto_id'];
        }
        else
        {
            $message = "Falta el parámetro \"proyecto_id\" al que quiere ".$controller->request->action;
            $controller->set(['message' => $message,
                '_serialize' => ['message']]);
            return false;
        }
    }

}
