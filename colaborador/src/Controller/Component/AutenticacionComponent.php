<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class AutenticacionComponent extends Component {
    /* Se pasa el controlador donde será ocupado el componente para poder utilizar el método set */

    public function acceso($controller)
    {
        if ($this->request->is(['post', 'put', 'delete']))
        {

            /* Se hace la peticion del usuario y la contraseña para acceder al microservicio */
            $datos = $this->request->getData();
            /* Se verifica si el body de la petición no está vacía */
            if (!empty($datos))
            {
                /* Se verifican que las variables que vienen en el body sean llamadas "username" y "password". */
                if (isset($datos['username']) && isset($datos['password']))
                {
                    /* Se guardan los valores enviados del body de la petición,"username" y "password" 
                     * y se hace el query para verificar que exista el usuario */
                    $correo = $datos['username'];
                    $contrasenia = $datos['password'];

                    $colaboradores = TableRegistry::get('Colaborador');
                    $usuario = $colaboradores->find()->select(['colaborador_id'])
                                    ->where(['col_correo' => $correo, 'col_contrasenia' => hash('sha256', $contrasenia),
                                        'col_estado' => 1, //si es usuario activo
                                    ])->first();

                    /* Si existe el usuario se da acceso al microservicio solicitado */
                    if ($usuario)
                    {
                        return $usuario['colaborador_id'];
                    }
                    else
                    {
                        $error = "Usuario o password incorrectos";
                        $controller->set([
                            'message' => $error,
                            '_serialize' => ['message']
                        ]);
                        return false;
                    }
                }
                else
                {
                    $error = "Debe enviar username y password para autenticarse";
                    $controller->set([
                        'message' => $error,
                        '_serialize' => ['message']
                    ]);
                    return false;
                }
            }
            else
            {
                $error = "Se debe enviar username y password para solicitar el microservicio";
                $controller->set([
                    'message' => $error,
                    '_serialize' => ['message']
                ]);
                return false;
            }
        }
    }

    /*Se verifica que se envíe el parámetro proyecto_id en los microservicios que lo requieran */
    public function verifica_parametro($controller)
    {
        $datos = $this->request->getData();
        if (isset($datos['colaborador_id']) && !empty($datos['colaborador_id']))
        {
            return $datos['colaborador_id'];
        }
        else
        {
            $message = "Falta el parámetro \"colaborador_id\" al que quiere ".$controller->request->action;
            $controller->set(['message' => $message,
                '_serialize' => ['message']]);
            return false;
        }
    }    


}
