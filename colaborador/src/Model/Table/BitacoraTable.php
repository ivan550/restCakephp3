<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BitacoraTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('bitacora');
        $this->setDisplayField('bitacora_id');
        $this->setPrimaryKey('bitacora_id');

        $this->belongsTo('Bitacora', [
            'foreignKey' => 'bitacora_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Colaborador', [
            'foreignKey' => 'colaborador_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Accion', [
            'foreignKey' => 'accion_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
                ->dateTime('bit_fecha')
                ->requirePresence('bit_fecha', 'create')
                ->notEmpty('bit_fecha');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bitacora_id'], 'Bitacora'));
//        $rules->add($rules->existsIn(['colaborador_id'], 'Colaborador'));
        $rules->add($rules->existsIn(['accion_id'], 'Accion'));

        return $rules;
    }

}
