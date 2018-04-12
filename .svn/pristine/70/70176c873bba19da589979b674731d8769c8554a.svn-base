<?php
namespace App\Model\Table;

use App\Model\Entity\Student;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Students Model
 *
 * @property \Cake\ORM\Association\HasMany $Attendances
 * @property \Cake\ORM\Association\HasMany $Grades
 * @property \Cake\ORM\Association\HasMany $Registrations
 */
class StudentsTable extends Table
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

        $this->table('students');
        $this->displayField('full_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Attendances', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('Grades', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('Registrations', [
            'foreignKey' => 'student_id'
        ]);
        
        $this->hasMany('InfoGrades', [
            'foreignKey' => 'student_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => __('El número de cuenta ya fue usado')])
            ->add('username', 'valid', ['rule' => 'numeric','last'=>true,'message' => __('Sólo se permite caracteres numéricos')])
            ->add('username', ['minLength' => [
                'rule' => ['minLength', 9],
                'last' => true,
                'message' => 'El número de cuenta no debe ser menor a 9 caracteres'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 9],
                    'message' => 'El número de cuenta no debe ser mayor a 9 caracteres'
                ]]);
        $validator
            ->requirePresence('names', 'create')
            ->notEmpty('names')
            ->add('names', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'El nombre no debe ser mayor a 50 caracteres'
                ]]);

        $validator
            ->allowEmpty('paternal_surname')
            ->add('paternal_surname', [
                'maxLength' => [
                    'rule' => ['maxLength', 40],
                    'message' => 'El apellido paterno no debe ser mayor a 40 caracteres'
                ]]);

        $validator
            ->allowEmpty('maternal_surname')
            ->add('maternal_surname', [
                'maxLength' => [
                    'rule' => ['maxLength', 40],
                    'message' => 'El apellido materno no debe ser mayor a 40 caracteres'
                ]]);

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => __('Este correo ya fue usado')])
            ->add('email', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'El correo no debe ser mayor a 50 caracteres'
                ]]);
        
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'create')
            ->allowEmpty('password', 'update');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('photo_mime')
            ->add('photo_mime', [
                'maxLength' => [
                    'rule' => ['maxLength', 100],
                    'message' => 'El tipo de archivo no debe ser mayor a 100 caracteres'
                ]]);

        $validator
            ->allowEmpty('photo_size');

        $validator
            ->add('last_login', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('last_login');

        return $validator;
    }
    
    /**
     * AddProf validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationAddProf(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => __('El número de cuenta ya fue usado')])
            ->add('username', 'valid', ['rule' => 'numeric','last'=>true,'message' => __('Sólo se permite caracteres numéricos')])
            ->add('username', ['minLength' => [
                'rule' => ['minLength', 9],
                'last' => true,
                'message' => 'El número de cuenta no debe ser menor a 9 caracteres'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 9],
                    'message' => 'El número de cuenta no debe ser mayor a 9 caracteres'
                ]]);
        $validator
            ->requirePresence('names', 'create')
            ->notEmpty('names')
            ->add('names', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'El nombre no debe ser mayor a 50 caracteres'
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
        $rules->add($rules->isUnique(['email']));
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            if($entity->foto['size'] < 10485760){
                return TRUE;
            }
            return FALSE;
            
            }, 'size',[
            'errorField' => 'foto',
            'message' => __('The image size exceeds 10MB')
        ]);
        
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            if($entity->foto['type'] != ''){
                if(substr($entity->foto['type'], 0,5) == 'image'){
                    return TRUE;
                }
                return FALSE;
            }
            return TRUE;
            
            }, 'mime',[
            'errorField' => 'foto',
            'message' => __('It is not an image')
        ]);
        
        $rules->add(function ($entity, $options) {
        // Return a boolean to indicate pass/failure 
        //Tells whether the file was uploaded via HTTP POST
            if($entity->foto['type'] != ''){
                if(is_uploaded_file($entity->foto['tmp_name'])) {
                        return TRUE;
                }else{
                    return FALSE;
                }
            }
            return TRUE;
            }, 'http_post',[
            'errorField' => 'foto',
            'message' => __('It´s file wasn\'t via HTTP POST')
        ]);
            
        return $rules;
    }
    
    
    public function beforeSave(Event $event, Professor $entity)
    {
        if ((isset($entity->foto['error']) && $entity->foto['error'] == 0) ||
                (!empty( $entity->foto['tmp_name']) && $entity->foto['tmp_name'] != 'none')) {

                // prepare the image for insertion
                $imgData = file_get_contents($entity->foto['tmp_name']);

                // get the image info..
                $entity->photo_mime = $entity->foto['type'];
                $entity->photo_size = $entity->foto['size'];
                unset($entity->foto);
                $entity->photo = $imgData;

        }else{
            if(is_null($entity->id)){
                $entity->photo = null;
                $entity->photo_size = null;
                $entity->photo_mime = null;
            }
        }
        return true;
    }
}
