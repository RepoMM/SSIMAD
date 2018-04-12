<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * This controller will render views from Template/ListaAlumnos/
 *
 * 
 */

class EntregablesController extends AppController
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


	public function index( )
	{
		$professor_id = $this->request->session()->read('Auth.User.id');
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );

        /*$assignments = $this->Assignments->[
            'contain' => ['Weights']
        ]);
        $query = $this->Weights->find('all')
            ->select('name')
            ->where(['group_id IN' => $group_id]);
        echo $query;
        $this->paginate($query);*/
        $grades = $this->Grades->find('all');
        $assignment_id=NULL;
        function runMyFunction($grades) {
            //echo $_GET['assignment_id'];
            
            $grades = $grades-> find ('all',[
            'contain' => ['Students']])
                //->select(['id','assigment_id','value','upload_date','file','student_comment','professor_comment','Students.username','Students.names','Students.paternal_surname','Students.maternal_surname'])
                ->where(['assigment_id IN'=>$_GET['assignment_id']]);
            return $grades;
        }

        $grades_update = $this->Grades->find('all');
        
        if(isset($_GET['assignment_id'])){
            runMyFunction($grades);
            $assignment_id=1;
        }

        $this->paginate = [
            'contain' => ['Weights'],
            'conditions'=> ['Weights.group_id IN' => $group_id]   
        ];
        
        $this->set('assignments', $this->paginate($this->Assignments->find('all')
        ));
    	$this->set('_serialize',['assignments']);
        $this->set('grades_info',$grades);
        $this->set('grades',$grades_update);
        $this->set('assignment_id',$assignment_id);

        //PARA REALIZAR EL UPDATE
        if ($this->request->is(['patch', 'post', 'put'])) {
        $data=$this->request->data;
            foreach ($data as $data) {
                echo $data;
            }
            
            /*foreach ($grades as $g) {
                $gradesTable = TableRegistry::get('Grades');
                $entities = $gradesTable->newEntities($this->request->getData());
            }

            foreach ($entities as $entity) {
                $articles->save($entity);
            }
            $grades_upload->value = $this->request->data['student_comment'];
            $grades_upload->proffesor_comment = $this->request->data['student_comment'];*/
            


        /*
        if ($this->Grades->checkRules($grades_upload)) {    
            $grades_upload->student_comment = $this->request->data['student_comment'];
            $fecha_actual = date('Y-m-d H:i:s');
            $grades_upload->upload_date = $fecha_actual;
            $grades_upload->file = $this->request->data['file'];
            $gradesTable->save($grades_upload);
                        return $this->redirect(['action' => 'entregables']);
                        if ($gradesTable->save($grades_upload)==1) {
                            $this->Flash->success(__('The Grades has been upload.'));
                            return $this->redirect(['action' => 'entregables']);
                        } else {
                            $this->Flash->error(__('The Grades could not be saved. Please, try again.'));
                        }
                    }  else {
                        $this->Flash->error(__('The Assignments could not be saved. Please, try again.'));
                    }
                }else{
                    if ($de[$i]<$da[$i] && $i==5){
                        $this->Flash->error(__('Ya paso la fecha de entrega de  esta tarea'));
                    }
                }
            }*/
        }
	}

    /**
     * View method
     *
     * @param string|null $id Materials id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignments = $this->Assignments->get([$id]);
        $this->set('assignments', $assignments);
        $this->set('_serialize', ['assignments']);
    }


	public function add( ) {
		$this->loadModel('Assignments');
		$this->loadModel('Weights');
		$this->loadModel('Groups');

        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $weight_id= $this->Assignments->Weights->find('list', ['limit' => 200])
            ->where(['group_id IN' => $group_id]);
        
		$assignments = $this ->Assignments-> newEntity();
		if ($this->request->is('post')) {
            $assignments = $this->Assignments->patchEntity($assignments, $this->request->data);
            if ($this->Assignments->save($assignments)) {
                $this->Flash->success(__('The Assignments has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Assignments could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('assignments','weight_id'));
        $this->set('_serialize', ['assignments']);
	}

	/**
     * Edit method
     *
     * @param string|null $id Materials id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $weight_id_options= $this->Assignments->Weights->find('list', ['limit' => 200])
            ->where(['group_id IN' => $group_id]);

        $assignments = $this->Assignments->get([$id]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignments->id = $this->request->data['id'];
            $assignments->name = $this->request->data['aname'];
            $assignments->description = $this->request->data['adescription'];
            $assignments->publication = $this->request->data['apublication'];
            $assignments->due = $this->request->data['adue'];
            $assignments->file_name = $this->request->data['afile_name'];
            $assignments->has_upload = $this->request->data['ahas_upload'];
            $assignments->weight_id = $this->request->data['aweight_id'];

            if($this->Assignments->checkRules($assignments)){
                $query = $this->Assignments->query();
                $result = $query->update()
                    ->set(['name' => $this->request->data['aname'],'description' => $this->request->data['adescription'],'weight_id' => $this->request->data['aweight_id'],'has_upload' => $this->request->data['ahas_upload'],'file_name' => $this->request->data['afile_name'],'publication' => $this->request->data['apublication'], 'due' => $this->request->data['adue'],])
                    ->where(['id' => $this->request->data['id']]);
                if ($result->execute()->count() == 1) {
                    $this->Flash->success(__('The Assignments has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The Assignments could not be saved. Please, try again.'));
                }
            }  else {
                $this->Flash->error(__('The Assignments could not be saved. Please, try again.'));
            }
            
        }
        $this->set(compact('assignments','weight_id_options'));
        $this->set('_serialize', ['assignments']);
    }

	/**
	     * Delete method
	     *
	     * @param string|null $id Materials id.
	     * @return void Redirects to index.
	     * @throws \Cake\Network\Exception\NotFoundException When record not found.
	     */

    public function delete($id = null)
	{
	    $this->request->allowMethod(['post', 'delete']);
	    $assignments = $this->Assignments->get($id);
	    if ($this->Assignments->delete($assignments)) {
	        $this->Flash->success(__('The Assignments has been deleted.'));
	    } else {
	        $this->Flash->error(__('The Assignments could not be deleted. Please, try again.'));
	    }
	    return $this->redirect(['action' => 'index']);
	}

    /**
     * 
     * @return type
     */
    public function update_grades(){
    //var_dump($this->request->data['updates_value']);
    //var_dump($this->request->data['updates_pcomment']);
    //exit;
        $data = $this->request->data['updates_value'];
        foreach($data as $key => $grades){
            $upload = $this->Grades->newEntity($grades);
            $this->Grades->save($upload);
            //var_dump($grade->errors());
            $this->Flash->success('This was successful');
        }
        return $this->redirect(['controller'=>'entregables','action'=>'index']);
    }

}
?>