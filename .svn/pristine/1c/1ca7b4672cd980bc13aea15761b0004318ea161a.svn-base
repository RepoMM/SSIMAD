<?php
namespace App\Model\Table;

use App\Model\Entity\Course;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Courses Model
 *
 * @property \Cake\ORM\Association\HasMany $Groups
 * @property \Cake\ORM\Association\HasMany $Materials
 */
class CoursesTable extends Table
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

        $this->table('courses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Groups', [
            'foreignKey' => 'course_id'
        ]);
        $this->hasMany('Materials', [
            'foreignKey' => 'course_id'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->add('code', 'alphaNumeric', ['rule' => 'alphaNumeric','last'=>true,'message' => __('Sólo se permite caracteres alfanuméricos')])
            ->add('code', [
            'maxLength' => [
                'rule' => ['maxLength', 5],
                'message' => 'La clave no debe ser mayor a 5 caracteres'
            ]]);
           
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', [
            'maxLength' => [
                'rule' => ['maxLength', 100],
                'message' => 'El nombre no debe ser mayor a 100 caracteres'
            ]]);    

        $validator
            ->add('credits', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('credits')
            ->add('credits', 'validCredits', ['rule' => function ($data, $provider) {
                    if(isset($data)){
                        if($data >= 0)
                            return TRUE;
                        return FALSE;
                    }else {
                        return TRUE;
                    }
                },'message' => __('No debe de ser negativo')]);
            

        $validator
            ->allowEmpty('syllabus_url')
            ->add('syllabus_url', 'valid', ['rule' => 'url','last'=>true,'message' => __('No es una dirección URL válida')])//Si manda un error por lo general checa el TLD de la URL
            ->add('syllabus_url', [
            'maxLength' => [
                'rule' => ['maxLength', 200],
                'message' => 'La url del temario no debe ser mayor a 200 caracteres'
            ]]); 

        return $validator;
    }
}
