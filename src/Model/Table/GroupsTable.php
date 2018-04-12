<?php
namespace App\Model\Table;

use App\Model\Entity\Group;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Courses
 * @property \Cake\ORM\Association\BelongsTo $Professors
 * @property \Cake\ORM\Association\BelongsTo $Semesters
 * @property \Cake\ORM\Association\HasMany $Aclasses
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Registrations
 * @property \Cake\ORM\Association\HasMany $Weights
 */
class GroupsTable extends Table
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

        $this->table('groups');
        $this->displayField('group_number');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professors', [
            'foreignKey' => 'professor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Semesters', [
            'foreignKey' => 'semester_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Aclasses', [
            'foreignKey' => 'group_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'group_id'
        ]);
        $this->hasMany('Registrations', [
            'foreignKey' => 'group_id'
        ]);
        $this->hasMany('Weights', [
            'foreignKey' => 'group_id'
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
            ->notEmpty('course_id');
        
        $validator
            ->notEmpty('professor_id');
        
        $validator
            ->notEmpty('semester_id');
        
        $validator
            ->requirePresence('group_number', 'create')
            ->notEmpty('group_number')
            ->add('group_number', [
            'maxLength' => [
                'rule' => ['maxLength', 10],
                'message' => 'El número de grupo no debe ser mayor a 10 caracteres'
            ]]);

        $validator
            ->allowEmpty('class_schedule')
            ->add('class_schedule', [
            'maxLength' => [
                'rule' => ['maxLength', 100],
                'message' => 'El horario del grupo no debe ser mayor a 100 caracteres'
            ]]);

        $validator
            ->allowEmpty('classroom')
            ->add('classroom', [
            'maxLength' => [
                'rule' => ['maxLength', 100],
                'message' => 'El salón del grupo no debe ser mayor a 100 caracteres'
            ]]);

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        $rules->add($rules->existsIn(['professor_id'], 'Professors'));
        $rules->add($rules->existsIn(['semester_id'], 'Semesters'));
        return $rules;
    }
}
