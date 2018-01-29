<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rol Entity
 *
 * @property int $rol_id
 * @property string $rol_nombre
 * @property string $rol_clave
 * @property bool $rol_estado
 * @property string $rol_descripcion
 *
 * @property \App\Model\Entity\Rol $rol
 */
class Rol extends Entity
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
        'rol_id' => false
    ];
}
