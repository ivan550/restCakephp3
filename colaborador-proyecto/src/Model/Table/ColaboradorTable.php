<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ColaboradorTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('colaborador');
        $this->setDisplayField('colaborador_id');
        $this->setPrimaryKey('colaborador_id');

        $this->belongsTo('Colaborador', [
            'foreignKey' => 'colaborador_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Proyecto', [
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
                ->requirePresence('col_iniciales', 'create')
                ->notEmpty('col_iniciales');

        $validator
                ->requirePresence('col_nombre', 'create')
                ->notEmpty('col_nombre');

        $validator
                ->requirePresence('col_primer_apellido', 'create')
                ->notEmpty('col_primer_apellido');

        $validator
                ->allowEmpty('col_segundo_apellido');

        $validator
                ->requirePresence('col_correo', 'create')
                ->notEmpty('col_correo');

        $validator
                ->requirePresence('col_contrasenia', 'create')
                ->notEmpty('col_contrasenia');

        $validator
                ->allowEmpty('col_ruta_foto');

        $validator
                ->boolean('col_estado')
                ->requirePresence('col_estado', 'create')
                ->notEmpty('col_estado');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['colaborador_id'], 'Colaborador'));
        $rules->add($rules->existsIn(['area_id'], 'Areas'));

        return $rules;
    }

}
