<?php
namespace App\Model\Table;

use App\Model\Entity\MaterialType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaterialTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Materials
 */
class MaterialTypesTable extends Table
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

        $this->table('material_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Materials', [
            'foreignKey' => 'material_type_id'
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
                'rule' => ['maxLength', 100],
                'message' => 'El nombre no debe ser mayor a 100 caracteres'
            ]]);

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
