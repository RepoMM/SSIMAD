<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Weights Controller
 *
 * @property \App\Model\Table\WeightsTable $Weights
 */
class WeightsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $this->set('weights', $this->paginate($this->Weights));
        $this->set('_serialize', ['weights']);
    }

    /**
     * View method
     *
     * @param string|null $id Weight id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weight = $this->Weights->get($id, [
            'contain' => ['Groups', 'Assignments']
        ]);
        $this->set('weight', $weight);
        $this->set('_serialize', ['weight']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weight = $this->Weights->newEntity();
        if ($this->request->is('post')) {
            $weight = $this->Weights->patchEntity($weight, $this->request->data);
            if ($this->Weights->save($weight)) {
                $this->Flash->success(__('The weight has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weight could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Weights->Groups->find('list', ['limit' => 200]);
        $this->set(compact('weight', 'groups'));
        $this->set('_serialize', ['weight']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weight id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weight = $this->Weights->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weight = $this->Weights->patchEntity($weight, $this->request->data);
            if ($this->Weights->save($weight)) {
                $this->Flash->success(__('The weight has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weight could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Weights->Groups->find('list', ['limit' => 200]);
        $this->set(compact('weight', 'groups'));
        $this->set('_serialize', ['weight']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weight id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weight = $this->Weights->get($id);
        if ($this->Weights->delete($weight)) {
            $this->Flash->success(__('The weight has been deleted.'));
        } else {
            $this->Flash->error(__('The weight could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
