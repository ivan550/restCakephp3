<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

/*
 * Para hacer la petición Rest se utiliza la siguiente 
 * URL:http://132.248.63.217/evaluaciond/api/colaborador/listar.json
 * En el cuerpo de la petición la siguiente autenticación para todos los servicios:
 * {
  "username":"OHAA@unam.mx",
  "password":"hola"
  }
 * Headers -> Content-Type: application/json
 */

class ColaboradorController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Colaborador');
        $this->loadModel('Bitacora');
        $this->loadComponent('Autenticacion');
        $this->loadComponent('GeneraArreglo');
    }

    /* Microservicio para validar el acceso a la API desde otras aplicaciones */

    public function acceso()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador)
        {
            $this->set(['colaborador_id' => $colaborador,
                '_serialize' => ['colaborador_id']]);
        }
    }

    /* Listar colaboradores http://localhost/colaborador/api/colaborador/listar.json */

    public function listar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador)
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora))
            {
                $colaboradores = $this->Colaborador->find('all');
                $this->set([
                    'colaboradores' => $colaboradores,
                    '_serialize' => ['colaboradores']
                ]);
            }
        }
    }

    /* Acceso http://localhost/colaborador/api/colaborador/ver.json incluir id 
     * del colaborador al cual se desea acceder ("colaborador_id":21) */

    public function ver()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere ver */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora))
            {
                $colaborador = $this->Colaborador->get($colaborador_id);
                $this->set([
                    'colaborador' => $colaborador,
                    '_serialize' => ['colaborador']
                ]);
            }
        }
    }

    /* Registrar un nuevo colaborador http://localhost/colaborador/api/colaborador/registrar.json 
      envíar parámetroe en el cuerpo de la petición */

    public function registrar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador)
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 2);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $colaborador = $this->request->getData();
            unset($colaborador['username']);
            unset($colaborador['password']);
            if (isset($colaborador['col_contrasenia']) && !empty($colaborador['col_contrasenia']))
            {
                $colaborador['col_contrasenia'] = hash('sha256', $colaborador['col_contrasenia']);
            }
            $colaborador = $this->Colaborador->newEntity($colaborador);
            if ($this->Colaborador->save($colaborador) && $this->Bitacora->save($bitacora))
            {
                $message = 'Colaborador guardado con éxito';
            }
            else
            {
                $message = 'Error intentelo nuevamente';
            }
            $this->set([
                'message' => $message,
                'colaborador' => $colaborador,
                '_serialize' => ['message', 'colaborador']
            ]);
        }
    }

    /* Editar http://localhost/colaborador/api/colaborador/editar.json
     * envíar parámetros en el cuerpo de la petición e incluir id del colaborador 
     * del cual desea hacer la edición ("colaborador_id":21)    */

    public function editar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere editar */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 3);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $colaborador = $this->Colaborador->get($colaborador_id);
            if ($this->request->is(['post', 'put']))
            {
                $datos = $this->request->getData();
                unset($datos['username']);
                unset($datos['password']);
                if (isset($datos['col_contrasenia']) && !empty($datos['col_contrasenia']))
                {
                    $datos['col_contrasenia'] = hash('sha256', $datos['col_contrasenia']);
                }
                $colaborador = $this->Colaborador->patchEntity($colaborador, $datos);
                if ($this->Colaborador->save($colaborador) && $this->Bitacora->save($bitacora))
                {
                    $message = 'Editado y guardado con éxito';
                }
                else
                {
                    $message = 'Error en la edición, inténtelo nuevamente';
                }
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

    /* Eliminar http://localhost/colaborador/api/colaborador/eliminar.json
     * incluir id del colaborador que se desea eliminar ("colaborador_id":21) en el cuerpo de la petición  */

    public function eliminar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere eliminar */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 5);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $colaborador = $this->Colaborador->get($colaborador_id);
            $message = 'Colaborador con id = ' . $colaborador_id . ' borrado con éxito';
            if (!($this->Colaborador->delete($colaborador) && $this->Bitacora->save($bitacora)))
            {
                $message = 'Error al intentar borrar';
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

    /*  Deshabilitar colaborador http://localhost/colaborador/api/colaborador/deshabilitar.json
     *  incluir id del colaborador que se desea desahibilitar ("colaborador_id":21) en el cuerpo de la petición */

    public function deshabilitar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere deshabilitar */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 4);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $deshabilitar = ['col_estado' => false];
            $colaborador = $this->Colaborador->patchEntity($this->Colaborador->get($colaborador_id), $deshabilitar);
            if ($this->Colaborador->save($colaborador) && $this->Bitacora->save($bitacora))
            {
                $message = 'Colaborador con id = ' . $colaborador_id . ' deshabilitado con éxito';
            }
            else
            {
                $message = 'Error en la deshabilitación, inténtelo nuevamente';
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

    /*  Cambio de contraseña  http://localhost/colaborador/api/colaborador/cambiar_contrasenia.json
     *  incluir id del colaborador que se desea cambiar la contraseña ("colaborador_id":21) 
     * y la contraseña nueva ("col_contrasenia":"xxxxxx") en el cuerpo de la petición */

    public function cambiar_contrasenia()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere cambiar la contraseña */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            /* Verifica que el usuario que desea cambiar la contraseña sea el mismo que se ha autenticado */
            if ($colaborador != $colaborador_id)
            {
                $message = 'No tienes permisos para cambiar la contraseña del usuario con  id: ' . $colaborador_id;
            }
            else
            {
                $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 6);
                $bitacora = $this->Bitacora->newEntity($datos_bitacora);
                if ($this->request->is(['post', 'put']))
                {
                    $colaboradorActual = $this->Colaborador->get($colaborador_id);
                    $datos = $this->request->getData();
                    if (isset($datos['col_contrasenia']) && !empty($datos['col_contrasenia']))
                    {
                        $hashContrasenia = ['col_contrasenia' => hash('sha256', $datos['col_contrasenia'])];
                        $colaborador = $this->Colaborador->patchEntity($colaboradorActual, $hashContrasenia);
                        if ($this->Colaborador->save($colaborador) && $this->Bitacora->save($bitacora))
                        {
                            $message = 'Cambio de contraseña éxitoso, nueva contraseña: ' . $datos['col_contrasenia'];
                        }
                        else
                        {
                            $message = 'Error en cambio de contraseña, inténtelo nuevamente';
                        }
                    }
                    else
                    {
                        $message = "Falta parámetro \"col_contrasenia\" (nueva contraseña)";
                    }
                }
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

    /*  Cambio de contraseña aleatorio http://localhost/colaborador/api/colaborador/cambiar_contrasenia_automatico.json
     *  incluir id del colaborador que se desea cambiar la contraseña ("colaborador_id":21) en el cuerpo de la petición */

    public function cambiar_contrasenia_automatico()
    {
        $this->loadComponent('Contrasenia');
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere cambiar la contraseña */
        $colaborador_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($colaborador_id))
        {
            /* Verifica que el usuario que desea cambiar la contraseña sea el mismo que se ha autenticado */
            if ($colaborador != $colaborador_id)
            {
                $message = 'No tienes permisos para cambiar la contraseña del usuario con  id: ' . $colaborador_id;
            }
            else
            {
                $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 7);
                $bitacora = $this->Bitacora->newEntity($datos_bitacora);
                if ($this->request->is(['post', 'put']))
                {
                    $colaborador_actual = $this->Colaborador->get($colaborador_id);
                    $contrasenia = $this->Contrasenia->aleatoria(10);
                    $hashContrasenia = ['col_contrasenia' => hash('sha256', $contrasenia)];
                    $colaborador = $this->Colaborador->patchEntity($colaborador_actual, $hashContrasenia);
                    if ($this->Colaborador->save($colaborador) && $this->Bitacora->save($bitacora))
                    {
                        $message = 'Cambio de contraseña éxitoso, nueva contraseña: ' . $contrasenia;
                    }
                    else
                    {
                        $message = 'Error en cambio de contraseña, inténtelo nuevamente';
                    }
                }
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

}
