<?php
namespace App\Model\Table;

use App\Model\Entity\Material;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materials Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MaterialTypes
 * @property \Cake\ORM\Association\BelongsTo $Professors
 * @property \Cake\ORM\Association\BelongsTo $Courses
 */
class MaterialsTable extends Table
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

        $this->table('materials');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaterialTypes', [
            'foreignKey' => 'material_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professors', [
            'foreignKey' => 'professor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);

        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'name' => [    // The name of your upload field
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
            ->notEmpty('material_type_id');
        
        $validator
            ->notEmpty('professor_id');
        
        $validator
            ->notEmpty('course_id');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', [
                'maxLength' => [
                    'rule' => ['maxLength', 200],
                    'message' => 'El nombre no debe ser mayor a 200 caracteres'
                ]]);

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('subject')
            ->add('subject', [
                'maxLength' => [
                    'rule' => ['maxLength', 100],
                    'message' => 'El tema no debe ser mayor a 100 caracteres'
                ]]);

        $validator
            ->allowEmpty('url')
            ->add('url', 'valid', ['rule' => 'url','last'=>true,'message' => __('No es una dirección URL válida')]);//Si manda un error por lo general checa el TLD de la URL

        $validator
            ->add('private', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('private');

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
        $rules->add($rules->existsIn(['material_type_id'], 'MaterialTypes'));
        $rules->add($rules->existsIn(['professor_id'], 'Professors'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        return $rules;
    }
}
