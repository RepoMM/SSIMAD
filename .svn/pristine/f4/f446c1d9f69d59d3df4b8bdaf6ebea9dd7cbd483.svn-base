<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Student Entity.
 */
class Student extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     * Note that '*' is set to true, which allows all unspecified fields to be
     * mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    protected function _getFullName()
    {
        return $this->_properties['names'] . '  ' .
            $this->_properties['paternal_surname'].' '.$this->_properties['maternal_surname'];
    }
    
    protected function _getFullNameA()
    {
        return $this->_properties['paternal_surname'].' '.$this->_properties['maternal_surname']. '  ' .$this->_properties['names'] ;
    }
}
