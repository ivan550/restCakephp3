<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

class ProyectoController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Proyecto');
        $this->loadModel('Bitacora');
        $this->loadComponent('Autenticacion');
        $this->loadComponent('GeneraArreglo');
    }

    /*
     * Para hacer la petición Rest se utiliza la siguiente 
     * URL:http://132.248.63.217/proyecto/api/proyecto/listar.json
     * En el cuerpo de la petición la siguiente autenticación:
     * {
      "username":"OHAA@unam.mx",
      "password":"hola"
      }
     * Headers -> Content-Type: application/json
     */

    public function listar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador)
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora))
            {
                $proyectos = $this->Proyecto->find('all');
                $this->set([
                    'proyectos' => $proyectos,
                    '_serialize' => ['proyectos']
                ]);
            }
        }
    }

    /* Acceso http://localhost/proyecto/api/proyecto/ver.json 
     * incluir id del proyecto que se desea ver ("proyecto_id":21) en el cuerpo de la petición     */

    public function ver()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del proyecto al cual se quiere ver */
        $proyecto_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($proyecto_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora))
            {
                $proyecto = $this->Proyecto->get($proyecto_id);
                $this->set([
                    'proyecto' => $proyecto,
                    '_serialize' => ['proyecto']
                ]);
            }
        }
    }

    /* Registrar un nuevo proyecto http://localhost/proyecto/api/proyecto/registrar.json 
      envíar parámetroe en el cuerpo de la petición */

    public function registrar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador)
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 2);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $datos = $this->request->getData();
            unset($datos['username']);
            unset($datos['password']);
            $proyecto = $this->Proyecto->newEntity($datos);

            if ($this->Proyecto->save($proyecto) && $this->Bitacora->save($bitacora))
            {
                $message = 'Proyecto guardado con éxito';
            }
            else
            {
                $message = 'Error inténtelo nuevamente';
            }
            $this->set([
                'message' => $message,
                'proyecto' => $proyecto,
                '_serialize' => ['message', 'proyecto']
            ]);
        }
    }

    /* Editar http://localhost/proyecto/api/proyecto/editar.json
     * envíar parámetroe en el cuerpo de la petición, incluyendo además el id 
     * del proyecto que se desea editar ("proyecto_id":21) */

    public function editar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del proyecto al cual se quiere editar */
        $proyecto_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($proyecto_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 3);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $proyecto = $this->Proyecto->get($proyecto_id);
            $datos = $this->request->getData();
            unset($datos['username']);
            unset($datos['password']);
            if ($this->request->is(['post', 'put']))
            {
                $proyecto = $this->Proyecto->patchEntity($proyecto, $datos);
                if ($this->Proyecto->save($proyecto) && $this->Bitacora->save($bitacora))
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

    /* Eliminar http://localhost/proyecto/api/proyecto/eliminar.json  
     * incluir id del proyecto que se desea eliminar ("proyecto_id":21) en el cuerpo de la petición */

    public function eliminar()
    {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del proyecto al cual se quiere eliminar */
        $proyecto_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($proyecto_id))
        {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 4);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $proyecto = $this->Proyecto->get($proyecto_id);
            $message = 'Proyecto con id = ' . $proyecto_id . ' borrado con éxito';
            if (!($this->Proyecto->delete($proyecto) && $this->Bitacora->save($bitacora)))
            {
                $message = 'Error al intentar borrar';
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

}
