<?php
namespace App\Model\Table;
use App\Model\Entity\Grade;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Grades Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Assignments
 */
class GradesTable extends Table
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

        $this->table('grades');
        $this->displayField('value');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Assignments', [
            'foreignKey' => 'assigment_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Proffer.Proffer', [
            'file' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'url',   // The name of the field to store the folder
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
            ->notEmpty('student_id');
        
        $validator
            ->notEmpty('assigment_id');

        $validator
            ->add('value', 'valid', ['rule' => 'numeric'])
            ->requirePresence('value', 'create')
            ->notEmpty('value')
            ->add('value', 'validValue', ['rule' => function ($data, $provider) {
                    if ($data >= 0 && $data <= 10) 
                        return TRUE;
                    return FALSE;
                },'message' => __('El valor debe estar entre 0 y 10')]);

        $validator
            ->add('upload_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('upload_date');

        $validator //Es el enlace del archivo adjunto que sube el alumno
            ->allowEmpty('file')
            ->add('file', [
                'maxLength' => [
                    'rule' => ['maxLength', 200],
                    'message' => 'El nombre del archivo no debe ser mayor a 200 caracteres'
                ]]);

        $validator
            ->allowEmpty('student_comment');

        $validator
            ->allowEmpty('professor_comment');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['assigment_id'], 'Assignments'));
        return $rules;
    }
}