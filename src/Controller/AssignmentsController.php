<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 */
class AssignmentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Weights']
        ];
        $this->set('assignments', $this->paginate($this->Assignments));
        $this->set('_serialize', ['assignments']);
    }

    /**
     * View method
     *
     * @param string|null $id Assignment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => ['Weights']
        ]);
        $this->set('assignment', $assignment);
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assignment = $this->Assignments->newEntity();
        if ($this->request->is('post')) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $weights = $this->Assignments->Weights->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'weights'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assignment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $weights = $this->Assignments->Weights->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'weights'));
        $this->set('_serialize', ['assignment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assignment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assignment = $this->Assignments->get($id);
        if ($this->Assignments->delete($assignment)) {
            $this->Flash->success(__('The assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The assignment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
