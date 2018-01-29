<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProyectoColaborador Entity
 *
 * @property int $rol_id
 * @property int $proyecto_id
 * @property int $colaborador_id
 * @property int $proy_col_rol_id
 *
 * @property \App\Model\Entity\Rol $rol
 * @property \App\Model\Entity\Proyecto $proyecto
 * @property \App\Model\Entity\Colaborador $colaborador
 * @property \App\Model\Entity\ProyColRol $proy_col_rol
 */
class ProyectoColaborador extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'proy_col_rol_id' => false
    ];
}
