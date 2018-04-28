<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Event\Event;
use HelperClasses;
use Cake\ORM\TableRegistry;

/**
 * This controller will render views from Template/MenuAlumnos/
 *
 *
 */
class MenuAlumnosController extends AppController
{
  public function initialize()
  {
       parent::initialize();
       $this->user = $this->request->session()->read('Auth.User');

       $this->loadModel('Groups');
       $this->loadModel('Students');
       $this->loadModel('InfoGroups');
       $this->loadModel('InfoGrades');
       $this->loadModel('InfoMaterials');
       $this->loadModel('Messages');
       $this->loadModel('Professors');
       $this->loadModel('Materials');
       $this->loadModel('Assignments');
       $this->loadModel('Groups');
       $this->loadModel('Weights');
       $this->loadModel('Courses');
       $this->loadModel('Registrations');
  }

    public function seleccion(){
        if($this->request->data['grupo'] != ''){
            $this->request->session()->write('Auth.User.group_id',$this->request->data['grupo']);
        }else{
            $this->request->session()->write('Auth.User.group_id',NULL);
        }

        return $this->redirect(['controller' => 'menu_alumnos','action'=>'index']);
    }

    public function index(){
        $info_group = array();
        $id = $this->request->session()->read('Auth.User.id');
        //echo "Id es ".$id;
        $this->loadModel('Registrations');
        $this->loadModel('InfoGroups');

        if(!is_null($this->request->session()->read('Auth.User.group_id'))){
            $group_id = $this->request->session()->read('Auth.User.group_id');
            $info_group = $this->InfoGroups->find('all')->where(['group_id' => $group_id])->first();
            //echo $info_group;
        }
        $registrations = $this->Registrations->find('list', ['keyField' => 'slug','valueField' =>'group_id'])->where(['student_id' => $id]);
        //$groups = $this->InfoGroups->find('list', ['keyField' => 'group_id','valueField' =>'name'])->where(['group_id IN' => $registrations->toArray()]);
        $groups = $this->InfoGroups->find('list', ['keyField' => 'group_id','valueField' =>'course_number_group','groupField' => 'name'])->where(['group_id IN' => $registrations->toArray()]);



        //$agroups = $this->Groups->find('list', ['keyField' => 'slug','valueField' =>'id'])->where(['student_id' => $this->user['id']]);
        //$groups = $this->InfoGroups->find('list', ['keyField' => 'group_id','valueField' =>'course_number_group','groupField' => 'name'])->where(['group_id IN' => $agroups->toArray()]);

        //$agroups = $this->Registrations->find('list', ['keyField' => 'slug','valueField' =>'id'])->where(['professor_id' => $this->user['id']]);
        //$info_group = $this->InfoGroups->find('all')->where(['group_id' => $this->user['group_id'] ])->first();
        //echo "Entra pero...";
        //  print_r($groups);

        $this->set(compact('groups','info_group'));
    }

    public function busqueda(){
        if(isset($this->request->data['profesores'])){
            $this->request->session()->write('Auth.User.data.busqueda',$this->request->data['profesores']);
            return $this->redirect(['controller'=>'menu_alumnos','action'=>'profesores']);
        }

        if(isset($this->request->data['material'])){
            $this->request->session()->write('Auth.User.data.busqueda',$this->request->data['material']);
            return $this->redirect(['controller'=>'menu_alumnos','action'=>'material_didactico']);
        }

    }

    public function asignatura(){
        $this->loadModel('InfoGroups');

        if($this->request->session()->read('Auth.User.group_id') != ''){
            $group_id = $this->request->session()->read('Auth.User.group_id');
            $group = $this->InfoGroups->find('all')->where(['group_id' => $group_id])->first();
        }else{
            //Redireccionar por si no está el group_id en la sesión
            return $this->redirect(['action'=>'index']);
        }
        $this->set('group',$group);
    }

    public function calificaciones(){
        $this->loadModel( 'Weights');
        $this->loadModel( 'Assignments' );
        $this->loadModel( 'Grades' );
        $this->loadModel( 'Students');
        $this->loadModel( 'InfoGrades' );
        $this->loadModel( 'Registrations' );

        /*QUERY
         * Por medio de este query se resuelve la tabla de calificaciones
         * SELECT weights.name, info_grades.name, info_grades.value, assignments.description
           FROM info_grades
           JOIN assignments ON info_grades.assigment_id = assignments.id
           JOIN weights ON assignments.weight_id = weights.id
           WHERE weights.group_id=7;
         */

        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $student_id = $this->request->session()->read( 'Auth.User.id' );

        $assignments = $this -> Assignments -> find('all');
        //echo $assignments;

        $infogrades = $this -> InfoGrades -> find('all')
                ->where(['student_id IN' => $student_id]);
        //echo $infogrades;
        $this->set('infogrades', $infogrades);

        $weights = $this->Weights->find( 'all')
                ->where([ 'group_id IN' => $group_id ]);
        $this->set('weights', $weights);

        $weights_id = $this -> Weights -> find('list',['valueField'=>'id'])
                ->where(['group_id IN' => $group_id]);
        //echo $weights_id;

        /*$assignments_id = $this -> Assignments -> find('list',['valueField'=>'id'])
                ->where(['weight_id IN' => $weights_id]);
        //echo $assignments_id;*/

        $assignments_weights = $assignments -> find ('all',[
           'conditions'=> ['Assignments.weight_id IN' => $weights_id],
           'contain' => ['Weights']
        ]);
        $this->set('assweights', $assignments_weights);

        /*$assignments_grades  = $assignments ->find('all',[
            'conditions'=> ['Assignments.weight_id IN' => $weights_id],
            'contain' => ['Grades']
        ]);
        $this->set('ass_grades', $assignments_grades);*/
    }

    public function asistencia(){
        //Cargamos los datos de los modelos
        $this->loadModel('Attendances');
        $this->loadModel('Aclasses');

        /*
         * ->Este query resuelve la consulta para obtener la tabla asistencia
         SELECT class_id, date, value FROM attendances
         JOIN aclasses on attendances.class_id=aclasses.id
         WHERE aclasses.group_id=7;
         */

        //Obtenemos los valores del modelo
        $student_id = $this->request->session()->read( 'Auth.User.id' );
        $group_id = $this->request->session()->read('Auth.User.group_id');
        //echo $student_id, $group_id;

        //EJECUCION DEL JOIN
        //Obtenemos los datos validos para el alumno de la tabla Attendance
        $attendances_class = $this->Attendances->find('list',['valueField'=>'class_id'])//,['valueField' => 'value'])
            ->where(['student_id IN' => $student_id])
            ->toArray();
        //print_r($attendances_class);

        //Obtenemos toda la informacion de la tabla Attendance
        $attendances = $this->Attendances->find('all')
                ->where(['student_id IN' => $student_id]);
        //echo $attendances;

        //Juntamos la informacion de la tabla Aclasses
        $get_asist = $attendances->find('all',[
           'conditions' => ['Aclasses.group_id IN' => $group_id],
           'contain' => ['Aclasses']
        ])->toArray();

        $this->set('asistencias', $get_asist);
    }

    public function entregables(){
        $this->loadModel('Grades');
        $this->loadModel('Assignments');
        $student_id = $this->request->session()->read('Auth.User.id');
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        $grades = $this->Grades->find('all');
        $assignment_true=NULL;

        if(isset($_GET['assignment_id'])){
            //echo 'Active';
            $assignment_info_id = $this->Assignments->find('all')
                ->where(['id IN'=>$_GET['assignment_id']]);
            $assignment_true=1;
            //runMyFunction($grades,$student_id);
            $grades = $grades-> find ('all',[
            'contain' => ['Students']])
                ->select(['id','assigment_id','value','upload_date','file','student_comment','professor_comment','Students.id','Students.names','Students.paternal_surname','Students.maternal_surname'])
                ->where(['assigment_id IN'=>$_GET['assignment_id']])
                ->andwhere(['Students.id IN' => $student_id]);
            $this->set('assignment_info_id',$assignment_info_id);
        }

        $this->paginate = [
            'contain' => ['Weights'],
            'conditions'=> ['Weights.group_id IN' => $group_id]
        ];

        $this->set('assignments', $this->paginate($this->Assignments->find('all')
        ));
        $this->set('_serialize',['assignments']);
        $this->set('grades',$grades);
        $this->set('assignment_true',$assignment_true);
        $this->set('student_id', $student_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            foreach ($assignment_info_id as $a_info) {
                $de=explode("|",date_format($a_info['due'], 'Y|m|d|H|i|s'));
            }

            $fecha_actual = date('Y|m|d|H|i|s');
            $da=explode("|", $fecha_actual);
            var_dump($de);
            var_dump($da);
            for ($i=3; $i < 6; $i++) {
                if ($de[$i]>=$da[$i] && $i==5){
                    //Aun en tiempo para subir
                    foreach ($grades as $g) {
                        $gradesTable = TableRegistry::get('Grades');
                        $grades_upload = $gradesTable->get($g['id']);
                    }
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
            }
        }
    }

    public function mensajes(){

        $this->loadModel( 'Messages' );


        $group_id = $this->request->session()->read( 'Auth.User.group_id' );

        $messages = $this->Messages->find()->where( ['group_id' => $group_id] );


    $this->set( compact('messages') );


    }
    public function enviar_correo(){




    }
    public function material_didactico(){
        $str = '';
        if(isset($this->user['data']['busqueda']))
            $str = $this->user['data']['busqueda'];
        if(is_null($this->user['group_id'])){
            if($str == ''){
                $materials = $this->InfoMaterials->find('all');
            }else{
                $materials = $this->InfoMaterials->find()->where(['name LIKE' => '%'.$str.'%'])
                                                    ->orWhere(function ($exp) use ($str){
                                                        return $exp->or_([
                                                            'description LIKE' => '%'.$str.'%',
                                                            'subject LIKE' => '%'.$str.'%']); });
            }
        }else{
            if($str == ''){
                $course = $this->Groups->find('all',['fields'=>['course_id']])->where(['id'=>  $this->user['group_id']])->first();
                $materials = $this->InfoMaterials->find('all')->where(['course_id'=>$course->course_id]);
            }  else {
                $course = $this->Groups->find('all',['fields'=>['course_id']])->where(['id'=>  $this->user['group_id']])->first();
                $materials = $this->InfoMaterials->find('all')->where(['course_id'=>$course->course_id])
                                                            ->andWhere(function ($exp) use ($str){
                                                                return $exp->or_([
                                                                    'name LIKE' => '%'.$str.'%',
                                                                    'description LIKE' => '%'.$str.'%',
                                                                    'subject LIKE' => '%'.$str.'%']); });
            }
        }
        $this->set('materials',$materials);
    }

    public function profesores(){
        $str = '';
        if(isset($this->user['data']['busqueda']))
            $str = $this->user['data']['busqueda'];
        if(is_null($this->user['group_id'])){
            if($str == ''){
                $professors = $this->Professors->find('all');
            }else{
                $professors = $this->Professors->find()->where(['names LIKE' => '%'.$str.'%'])
                                                    ->orWhere(function ($exp) use ($str){
                                                        return $exp->or_([
                                                            'paternal_surname LIKE' => '%'.$str.'%',
                                                            'maternal_surname LIKE' => '%'.$str.'%']); });
            }
        }else{
            if($str == ''){
                $course = $this->Groups->find('all',['fields'=>['course_id']])->where(['id'=>  $this->user['group_id']])->first();
                $list_professor = $this->Groups->find('list',['keyField' => 'slug','valueField' =>'professor_id']);
                    $list_professor->select(['professor_id'])->distinct(['professor_id'])->where(['course_id'=> $course->course_id]);
                $professors = $this->Professors->find('all')->where(['id IN'=>$list_professor->toArray()]);
            }  else {
                $course = $this->Groups->find('all',['fields'=>['course_id']])->where(['id'=>  $this->user['group_id']])->first();
                $list_professor = $this->Groups->find('list',['keyField' => 'slug','valueField' =>'professor_id']);
                $list_professor->select(['professor_id'])->distinct(['professor_id'])->where(['course_id'=> $course->course_id]);

                $professors = $this->Professors->find('all')->where(['id IN'=>$list_professor->toArray()])
                        ->andWhere(function ($exp) use ($str){
                        return $exp->or_([
                                                                    'names LIKE' => '%'.$str.'%',
                                                                    'paternal_surname LIKE' => '%'.$str.'%',
                                                                    'maternal_surname LIKE' => '%'.$str.'%']); });
            }
        }
        $this->set('professors',$professors);
    }

}
