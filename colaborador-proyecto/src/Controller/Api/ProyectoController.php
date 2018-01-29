<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

class ProyectoController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Proyecto');
        $this->loadModel('Bitacora');
        $this->loadComponent('Autenticacion');
        $this->loadComponent('GeneraArreglo');
        $this->loadModel('ProyectoColaborador');
        $this->loadModel('Rol');
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

    public function listar() {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador) {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora)) {
                $proy_col_rol = $this->ProyectoColaborador->find('all');
                $this->set([
                    'proyectos-roles' => $proy_col_rol,
                    '_serialize' => ['proyectos-roles']
                ]);
            }
        }
    }

    /* Acceso http://localhost/colaborador-proyecto/api/proyecto/ver.json incluir id 
     * del colaborador al cual se desea acceder ("proy_col_rol_id":1) */

    public function ver() {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del colaborador al cual se quiere ver */
        $proy_col_rol_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($proy_col_rol_id)) {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 1);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            if ($this->Bitacora->save($bitacora)) {
                $proy_col_rol = $this->ProyectoColaborador->get($proy_col_rol_id);
                $this->set([
                    'proy_col_rol' => $proy_col_rol,
                    '_serialize' => ['proy_col_rol']
                ]);
            }
        }
    }

    /* Registrar un nuevo proyecto http://localhost/proyecto/api/proyecto/registrar.json 
      envíar parámetroe en el cuerpo de la petición */

    public function registrar() {
        $colaborador = $this->Autenticacion->acceso($this);
        if ($colaborador) {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 2);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $datos = $this->request->getData();
            unset($datos['username']);
            unset($datos['password']);
            $proy_col = $this->ProyectoColaborador->newEntity($datos);

            if ($this->ProyectoColaborador->save($proy_col) && $this->Bitacora->save($bitacora)) {
                $message = 'Proyecto, colaborador y rol guardados con éxito';
            } else {
                $message = 'Error inténtelo nuevamente';
            }
            $this->set([
                'message' => $message,
                'proy_col_rol' => $proy_col,
                '_serialize' => ['message', 'proy_col_rol']
            ]);
        }
    }

    /* Editar http://localhost/proyecto/api/proyecto/editar.json
     * envíar parámetros en el cuerpo de la petición, incluyendo además el id 
     * del proyecto que se desea editar ("proyecto_id":21) */

    public function editar() {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del proyecto al cual se quiere editar */
        $proy_col_rol_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($proy_col_rol_id)) {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 3);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $proy_col_rol = $this->ProyectoColaborador->get($proy_col_rol_id);
            $datos = $this->request->getData();
            unset($datos['username']);
            unset($datos['password']);
            if ($this->request->is(['post', 'put'])) {
                $proy_col_rol = $this->ProyectoColaborador->patchEntity($proy_col_rol, $datos);
                if ($this->ProyectoColaborador->save($proy_col_rol) && $this->Bitacora->save($bitacora)) {
                    $message = 'Editado y guardado con éxito';
                } else {
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
     * incluir id del proy_col_rol_id que se desea eliminar ("proy_col_rol_id":21) en el cuerpo de la petición */

    public function eliminar() {
        $colaborador = $this->Autenticacion->acceso($this);
        /* Se obtiene el id del pro_col_rol_id al cual se quiere eliminar */
        $pro_col_rol_id = $this->Autenticacion->verifica_parametro($this);
        if (!empty($colaborador) && !empty($pro_col_rol_id)) {
            $datos_bitacora = $this->GeneraArreglo->llena($colaborador, 4);
            $bitacora = $this->Bitacora->newEntity($datos_bitacora);
            $proy_col_rol = $this->ProyectoColaborador->get($pro_col_rol_id);
            $message = 'Proyecto con id = ' . $pro_col_rol_id . ' borrado con éxito';
            if (!($this->ProyectoColaborador->delete($proy_col_rol) && $this->Bitacora->save($bitacora))) {
                $message = 'Error al intentar borrar';
            }
            $this->set([
                'message' => $message,
                '_serialize' => ['message']
            ]);
        }
    }

}
