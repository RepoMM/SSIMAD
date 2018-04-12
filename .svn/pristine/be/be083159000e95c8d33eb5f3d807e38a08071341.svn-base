<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Registrations Controller
 *
 * @property \App\Model\Table\RegistrationsTable $Registrations
 */
class RegistrationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups', 'Students']
        ];
        $this->set('registrations', $this->paginate($this->Registrations));
        $this->set('_serialize', ['registrations']);
    }

    /**
     * View method
     *
     * @param string|null $id Registration id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($student_id = null,$group_id = null)
    {
        $registration = $this->Registrations->get([$student_id,$group_id], [
            'contain' => ['Groups', 'Students']
        ]);
        $this->set('registration', $registration);
        $this->set('_serialize', ['registration']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registration = $this->Registrations->newEntity();
        if ($this->request->is('post')) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->data);
            
            if ($this->Registrations->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The registration could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Registrations->Groups->find('list', ['limit' => 200]);
        $students = $this->Registrations->Students->find('list', ['limit' => 200]);
        $this->set(compact('registration', 'groups', 'students'));
        $this->set('_serialize', ['registration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Registration id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($student_id = null,$group_id = null)
    {
        $registration = $this->Registrations->get([$student_id,$group_id], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration->group_id =   $this->request->data['agroup_id'];
            $registration->student_id =   $this->request->data['astudent_id'];
            if($this->Registrations->checkRules($registration)){
                $query = $this->Registrations->query();
                $result = $query->update()
                    ->set(['group_id' => $this->request->data['agroup_id'],'student_id' => $this->request->data['astudent_id']])
                    ->where(['group_id' => $this->request->data['group_id'],'student_id' => $this->request->data['student_id']])
                    ;
                if ($result->execute()->count() == 1) {
                    $this->Flash->success(__('The registration has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The registration could not be saved. Please, try again.'));
                }
            }  else {
                $this->Flash->error(__('The registration could not be saved. Please, try again.'));
            }
            
        }
        $groups = $this->Registrations->Groups->find('list', ['limit' => 200]);
        $students = $this->Registrations->Students->find('list', ['limit' => 200]);
        $this->set(compact('registration', 'groups', 'students'));
        $this->set('_serialize', ['registration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Registration id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($student_id = null,$group_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registrations->get([$student_id,$group_id]);
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    
}
