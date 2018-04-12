<?php
namespace App\Model\Table;

use App\Model\Entity\Semester;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Semesters Model
 *
 * @property \Cake\ORM\Association\HasMany $Groups
 */
class SemestersTable extends Table
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

        $this->table('semesters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Groups', [
            'foreignKey' => 'semester_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', [
            'maxLength' => [
                'rule' => ['maxLength', 10],
                'message' => 'El nombre no debe ser mayor a 10 caracteres'
            ]]);

        $validator
            ->add('start_date', 'valid', ['rule' => 'date'])
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->add('end_date', 'valid', ['rule' => 'date'])
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        return $validator;
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
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            if($entity->start_date->toUnixString() < $entity->end_date->toUnixString()){
                return TRUE;
            }
            return FALSE;
            
            }, 'compareDates',[
            'errorField' => 'start_date',
            'message' => __('La fecha de inicio es mayor que la fecha de fin')
        ]);
            
        return $rules;
    }
}
