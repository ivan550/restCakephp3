<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AccionTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('accion');
        $this->setDisplayField('accion_id');
        $this->setPrimaryKey('accion_id');

        $this->belongsTo('Accions', [
            'foreignKey' => 'accion_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
                ->requirePresence('acn_nombre', 'create')
                ->notEmpty('acn_nombre')
                ->add('acn_nombre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['acn_nombre']));
        $rules->add($rules->existsIn(['accion_id'], 'Accions'));

        return $rules;
    }

}
