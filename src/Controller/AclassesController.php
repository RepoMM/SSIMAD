<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Aclasses Controller
 *
 * @property \App\Model\Table\AclassesTable $Aclasses
 */
class AclassesController extends AppController
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
        $this->set('aclasses', $this->paginate($this->Aclasses));
        $this->set('_serialize', ['aclasses']);
    }

    /**
     * View method
     *
     * @param string|null $id Aclass id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aclass = $this->Aclasses->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set('aclass', $aclass);
        $this->set('_serialize', ['aclass']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aclass = $this->Aclasses->newEntity();
        if ($this->request->is('post')) {
            $aclass = $this->Aclasses->patchEntity($aclass, $this->request->data);
            if ($this->Aclasses->save($aclass)) {
                $this->Flash->success(__('The aclass has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The aclass could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Aclasses->Groups->find('list', ['limit' => 200]);
        $this->set(compact('aclass', 'groups'));
        $this->set('_serialize', ['aclass']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Aclass id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aclass = $this->Aclasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $aclass = $this->Aclasses->patchEntity($aclass, $this->request->data);
            if ($this->Aclasses->save($aclass)) {
                $this->Flash->success(__('The aclass has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The aclass could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Aclasses->Groups->find('list', ['limit' => 200]);
        $this->set(compact('aclass', 'groups'));
        $this->set('_serialize', ['aclass']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Aclass id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aclass = $this->Aclasses->get($id);
        if ($this->Aclasses->delete($aclass)) {
            $this->Flash->success(__('The aclass has been deleted.'));
        } else {
            $this->Flash->error(__('The aclass could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
