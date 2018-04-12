<?php
namespace App\Model\Table;

use App\Model\Entity\Registration;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Registrations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\BelongsTo $Students
 */
class RegistrationsTable extends Table
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

        $this->table('registrations');
        $this->displayField('student_id');
        $this->primaryKey(['student_id', 'group_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            $query = $this->find();
            $result = $query->select()
                    ->where(['group_id' => $entity->group_id,'student_id' => $entity->student_id])
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
