<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grades Controller
 *
 * @property \App\Model\Table\GradesTable $Grades
 */
class GradesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Assignments']
        ];
        $this->set('grades', $this->paginate($this->Grades));
        $this->set('_serialize', ['grades']);
    }

    /**
     * View method
     *
     * @param string|null $id Grade id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grade = $this->Grades->get($id, [
            'contain' => ['Students', 'Assignments']
        ]);
        $this->set('grade', $grade);
        $this->set('_serialize', ['grade']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grade = $this->Grades->newEntity();
        if ($this->request->is('post')) {
            $grade = $this->Grades->patchEntity($grade, $this->request->data);
            if ($this->Grades->save($grade)) {
                $this->Flash->success(__('The grade has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grade could not be saved. Please, try again.'));
            }
        }
        $students = $this->Grades->Students->find('list', ['limit' => 200]);
        $assignments = $this->Grades->Assignments->find('list', ['limit' => 200]);
        $this->set(compact('grade', 'students', 'assignments'));
        $this->set('_serialize', ['grade']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grade id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grade = $this->Grades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grade = $this->Grades->patchEntity($grade, $this->request->data);
            if ($this->Grades->save($grade)) {
                $this->Flash->success(__('The grade has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grade could not be saved. Please, try again.'));
            }
        }
        $students = $this->Grades->Students->find('list', ['limit' => 200]);
        $assignments = $this->Grades->Assignments->find('list', ['limit' => 200]);
        $this->set(compact('grade', 'students', 'assignments'));
        $this->set('_serialize', ['grade']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grade id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grade = $this->Grades->get($id);
        if ($this->Grades->delete($grade)) {
            $this->Flash->success(__('The grade has been deleted.'));
        } else {
            $this->Flash->error(__('The grade could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}