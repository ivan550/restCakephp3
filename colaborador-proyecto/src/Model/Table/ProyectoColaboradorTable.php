<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProyectoColaborador Model
 *
 * @property \App\Model\Table\RolTable|\Cake\ORM\Association\BelongsTo $Rol
 * @property \App\Model\Table\ProyectosTable|\Cake\ORM\Association\BelongsTo $Proyectos
 * @property \App\Model\Table\ColaboradorsTable|\Cake\ORM\Association\BelongsTo $Colaboradors
 * @property \App\Model\Table\ProyColRolsTable|\Cake\ORM\Association\BelongsTo $ProyColRols
 *
 * @method \App\Model\Entity\ProyectoColaborador get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProyectoColaborador newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProyectoColaborador[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProyectoColaborador|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProyectoColaborador patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProyectoColaborador[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProyectoColaborador findOrCreate($search, callable $callback = null, $options = [])
 */
class ProyectoColaboradorTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('proyecto_colaborador');
        $this->setDisplayField('proy_col_rol_id');
        $this->setPrimaryKey('proy_col_rol_id');

        $this->belongsTo('Rol', [
            'foreignKey' => 'rol_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Proyecto', [
            'foreignKey' => 'proyecto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Colaborador', [
            'foreignKey' => 'colaborador_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['rol_id'], 'Rol'));
        $rules->add($rules->existsIn(['proyecto_id'], 'Proyecto'));
        $rules->add($rules->existsIn(['colaborador_id'], 'Colaborador'));
        return $rules;
    }
}
