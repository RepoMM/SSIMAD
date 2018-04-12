<?php
namespace App\Model\Table;

use App\Model\Entity\Attendance;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attendances Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Aclasses
 * @property \Cake\ORM\Association\BelongsTo $Students
 */
class AttendancesTable extends Table
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

        $this->table('attendances');
        $this->displayField('class_id');
        $this->primaryKey(['class_id', 'student_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Aclasses', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
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
            ->add('value', 'valid', ['rule' => 'boolean'])
            ->requirePresence('value', 'create')
            ->notEmpty('value');

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
        $rules->add($rules->existsIn(['class_id'], 'Aclasses'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            $query = $this->find();
            $result = $query->select()
                    ->where(['class_id' => $entity->class_id,'student_id' => $entity->student_id,'value' => $entity->value])
                    ->execute();
            if($result->count() == 0)
                return TRUE;
            return FALSE;
            }, 'isExist',[
            'errorField' => 'status',
            'message' => __('Primary key that already exists')
        ]);
            
            
            
        return $rules;
    }
}
