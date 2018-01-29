<?php

namespace App\Controller\Api;

use Cake\Controller\Controller;

class AppController extends Controller {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadModel('Colaborador');
    }

}
