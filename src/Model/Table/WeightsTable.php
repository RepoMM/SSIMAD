<?php
namespace App\Model\Table;

use App\Model\Entity\Weight;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Weights Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\HasMany $Assignments
 */
class WeightsTable extends Table
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

        $this->table('weights');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Assignments', [
            'foreignKey' => 'weight_id'
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
            ->notEmpty('group_id');

        $validator
            ->notEmpty('name')
            ->add('name', [
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'El nombre no debe ser mayor a 50 caracteres'
                ]]);

        $validator
            ->allowEmpty('description');

        $validator
            ->notEmpty('weight')
            ->add('weight', 'valid', ['rule' => 'isInteger','message'=>'Debe de ser un número entero'])
            ->add('weight', 'validWeight', ['rule' => function ($data, $provider) {
                    if ($data >= 0 && $data <= 100) 
                        return TRUE;
                    return FALSE;
                },'message' => __('El valor debe estar entre 0 y 100')]);

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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        
        return $rules;
    }
}