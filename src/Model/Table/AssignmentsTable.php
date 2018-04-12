<?php
namespace App\Model\Table;

use App\Model\Entity\Assignment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assignments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Weights
 */
class AssignmentsTable extends Table
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

        $this->table('assignments');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Weights', [
            'foreignKey' => 'weight_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Grades', [
            'foreignKey' => 'assigment_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->addBehavior('Proffer.Proffer', [
            'file_name' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'attachment',   // The name of the field to store the folder
            ]
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
            ->notEmpty('weight_id');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', [
                'maxLength' => [
                    'rule' => ['maxLength', 100],
                    'message' => 'El nombre no debe ser mayor a 100 caracteres'
                ]]);

        $validator
            ->allowEmpty('description');

        $validator
            ->add('publication', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('publication');

        $validator
            ->add('due', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('due');

        $validator //Es el enlace del archivo adjunto que sube el profesor
            ->allowEmpty('attachment')
            ->add('attachment', [
                'maxLength' => [
                    'rule' => ['maxLength', 200],
                    'message' => 'El nombre del archivo no debe ser mayor a 200 caracteres'
                ]]);

        $validator
            ->add('has_upload', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('has_upload');

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
        $rules->add($rules->existsIn(['weight_id'], 'Weights'));
        
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            if(is_null($entity->publication) && is_null($entity->due)){
                return TRUE;
            }
            
            if($entity->publication->toUnixString() <= $entity->due->toUnixString()){
                return TRUE;
            }
            return FALSE;
            
            }, 'compareDates',[
            'errorField' => 'publication',
            'message' => __('La fecha de publicación es mayor que la fecha de entrega')
        ]);
            
        return $rules;
    }
}
