<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProyectoTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('proyecto');
        $this->setDisplayField('proyecto_id');
        $this->setPrimaryKey('proyecto_id');

        $this->belongsTo('Proyecto', [
            'foreignKey' => 'proyecto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Colaborador', [
            'foreignKey' => 'colaborador_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
                ->requirePresence('pro_nombre', 'create')
                ->notEmpty('pro_nombre');

        $validator
                ->requirePresence('pro_nombre_corto', 'create')
                ->notEmpty('pro_nombre_corto');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['proyecto_id'], 'Proyecto'));
        $rules->add($rules->existsIn(['colaborador_id'], 'Colaborador'));

        return $rules;
    }

}
