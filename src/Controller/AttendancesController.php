<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 */
class AttendancesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Aclasses', 'Students']
        ];
        $this->set('attendances', $this->paginate($this->Attendances));
        $this->set('_serialize', ['attendances']);
    }

    /**
     * View method
     *
     * @param string|null $id Attendance id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($class_id = null, $student_id = null)
    {
        $attendance = $this->Attendances->get([$class_id , $student_id], [
            'contain' => ['Aclasses', 'Students']
        ]);
        $this->set('attendance', $attendance);
        $this->set('_serialize', ['attendance']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attendance = $this->Attendances->newEntity();
        if ($this->request->is('post')) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->data);
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
            }
        }
        $aclasses = $this->Attendances->Aclasses->find('list', ['limit' => 200]);
        $students = $this->Attendances->Students->find('list', ['limit' => 200]);
        $this->set(compact('attendance', 'aclasses', 'students'));
        $this->set('_serialize', ['attendance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($class_id = null, $student_id = null)
    {
        $attendance = $this->Attendances->get([$class_id , $student_id], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance->class_id =   $this->request->data['aclass_id'];
            $attendance->student_id =   $this->request->data['astudent_id'];
            $attendance->value =   $this->request->data['value'];
            
            if($this->Attendances->checkRules($attendance)){
                $query = $this->Attendances->query();
                $result = $query->update()
                    ->set(['class_id' => $this->request->data['aclass_id'],'student_id' => $this->request->data['astudent_id'],'value'=>$this->request->data['value']])
                    ->where(['class_id' => $this->request->data['class_id'],'student_id' => $this->request->data['student_id']])
                    ;
                if ($result->execute()->count() == 1) {
                    $this->Flash->success(__('The attendance has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
                }
            }  else {
                $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
            }
        }
        $aclasses = $this->Attendances->Aclasses->find('list', ['limit' => 200]);
        $students = $this->Attendances->Students->find('list', ['limit' => 200]);
        $this->set(compact('attendance', 'aclasses', 'students'));
        $this->set('_serialize', ['attendance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($class_id = null, $student_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get([$class_id , $student_id]);
        if ($this->Attendances->delete($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
