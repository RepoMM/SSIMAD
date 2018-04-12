<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\MaterialsTable $Materials
 */
class MaterialsController extends AppController
{
    public $components = ['Flash'];
    public function initialize( )
    {
        parent::initialize();
        $this->user = $this->request->session()->read('Auth.User');

        $this->loadModel('Students');
        $this->loadModel('Assignments');
        $this->loadModel('Grades');
        $this->loadModel('Weights');
        $this->loadModel('InfoGrades');
        $this->loadModel('InfoGroups');
        $this->loadModel('Materials');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['MaterialTypes', 'Professors', 'Courses']
        ];

        $professor_id = $this->request->session()->read('Auth.User.id');  
        $this->set('materials', $this->paginate($this->Materials->find('all')
            ->where(['professor_id IN' => $professor_id])
        ));
        $this->set('_serialize', ['materials']);
    }

    /**
     * View method
     *
     * @param string|null $id Material id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function view($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => ['MaterialTypes', 'Professors', 'Courses']
        ]);
        $this->set('material', $material);
        $this->set('_serialize', ['material']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */

    public function add( )
    {
        $this->loadModel('Materials');
        $this->loadModel('MaterialTypes');
        $this->loadModel('Groups');

        //$material_type_id=1;
        $material_type_id = $this->Materials->MaterialTypes->find('list', ['limit' => 200]);
        $professor_id = $this->request->session()->read('Auth.User.id');
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $course_id = $this ->Groups->find('all')
            ->select('course_id')
            ->where(['id IN' => $group_id]);

        $material = $this->Materials->newEntity();
        if ($this->request->is('post')) {
            $material = $this->Materials->patchEntity($material, $this->request->data);
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('material', 'professor_id', 'course_id','material_type_id'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Groups');

        $material = $this->Materials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Materials->patchEntity($material, $this->request->data);
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
        }
        
        $material_type_id=1;
        $materialTypes = $this->Materials->MaterialTypes->find('list', ['limit' => 200]);
        $professor_id = $this->request->session()->read('Auth.User.id');
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $course_id = $this ->Groups->find('all')
            ->select('course_id')
            ->where(['id IN' => $group_id]);

        $this->set(compact('material', 'materialTypes', 'professor_id', 'course_id','material_type_id'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Materials->get($id);
        if ($this->Materials->delete($material)) {
            $this->Flash->success(__('The material has been deleted.'));
        } else {
            $this->Flash->error(__('The material could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}