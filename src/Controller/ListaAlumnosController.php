<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;
use PHPExcel;

//require_once(ROOT. DS .'vendor'.DS.'PHPExcel/Classes/PHPExcel.php');
//require_once(ROOT . DS . 'vendor' . DS.'PHPExcel/Classes/PHPExcel/IOFactory.php');

//use PHPExcel;
//use IOFactory;

/**
 * This controller will render views from Template/ListaAlumnos/
 *
 * 
 */
class ListaAlumnosController extends AppController
{

    public $components = ['Flash'];
    private $user;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
         parent::initialize();
         require_once(ROOT . '/vendor' . DS . 'PHPExcel'. DS . 'Classes' . DS . 'PHPExcel.php' );
      
        $this->loadComponent('Cewi/Excel.Import');
        $this->user = $this->request->session()->read('Auth.User');
         
        $this->loadModel('Registrations');
        $this->loadModel('Students');
        $this->loadModel('Assignments');
        $this->loadModel('Grades');
        $this->loadModel('Weights');
        $this->loadModel('InfoGrades');
        $this->loadModel('Aclasses');

    }
    
    /**
     * 
     */
    public function index(){
        $group_id = $this->user['group_id'];
        $registrations = $this->Registrations->find('list',['keyField' => 'slug','valueField' =>'student_id'])->where(['group_id'=> $group_id ]);
        
        $students = $this->Students->find('all')->where(['id IN'=>$registrations->toArray()])->order(['paternal_surname' =>'ASC']);
        $this->set(compact('students','group_id'));
    }
    
    /**
     * 
     * @return type
     */
    public function agregar_alumno(){
        $new = FALSE;
        $student = $this->Students->newEntity();

  
        if ($this->request->is('post')) 
        {
            $studentdb = $this->Students->find('all')->where(['username'=>$this->request->data['username']])->first();
            echo $this->request->data['username'];
            echo "Dentro 0;";
             
            if(!is_null($studentdb))
            {
                $this->registrar($this->user['group_id'], $studentdb->id,FALSE);
                return $this->redirect(['controller'=>'lista_alumnos','action' => 'index']);
                echo "Dentro 1";
            }

            $new=TRUE;
            $valid = $this->request->data['valid'];
            echo "valid: $valid";
            unset($this->request->data['valid']);
            echo "Despues de unset";
            
            if($valid)
            {
                echo "Dentro 2";
                $student = $this->Students->patchEntity($student, $this->request->data,['validate'=>'addProf']);
                $student->password = $this->request->data[ 'username' ]; 
                
                if($student->email == '')
                {
                        echo "Dentro 3";
                    $student->email = $student->username.'@default.com';
                }

                if ($this->Students->save($student)) 
                {
                    echo "Dentro 4";
                    $this->registrar($this->user['group_id'], $student->id,TRUE);
                    return $this->redirect(['controller'=>'lista_alumnos','action' => 'index']);
                }  
                    else 
                    {
                        echo "Dentro 5";
                        $this->Flash->error(__('The student could not be saved. Please, try again.'));
                    } 

              
                
            }           
        }


        $this->set(compact('student','new'));
    }

    /**
     * 
     * @param type $group_id
     * @param type $student_id
     * @param type $message
     * @return int
     */
    protected function registrar($group_id = null,$student_id,$message = null){
        $registration = $this->Registrations->newEntity();
        $data = ['group_id'=> $group_id,'student_id'=>$student_id];
        $registration = $this->Registrations->patchEntity($registration,$data);
        
        if(!$this->Registrations->save($registration)){
            if($message)//Al agregar a alguien que ya está inscrito
                $this->Flash->error(__('The registration could not be saved. Please, try again.'));
            return 0;
        }
        $this->agregar_calificaciones($group_id,$student_id);
    }
    /**
     * 
     * @param type $group_id
     * @param type $student_id
     */
    protected function agregar_calificaciones($group_id = null,$student_id = null){
        $weights = $this->Weights->find('list',['keyField' => 'slug','valueField' =>'id'])->where(['group_id' =>  $group_id,'name NOT LIKE ' => 'asistencia']);
        $assignments = $this->Assignments->find('all')->where(['weight_id IN'=>  $weights->toArray()]);
        
        if($assignments->count() != 0){
            foreach ($assignments as $assignment){
                $data = ['student_id'=>$student_id,'assigment_id'=>$assignment->id,'value'=>0];
                $grade = $this->Grades->newEntity();
                $grade = $this->Grades->patchEntity($grade, $data);
                $this->Grades->save($grade);
            }
        }
    }
    /**
     * 
     * @param type $student_id
     * @param type $group_id
     * @return type
     */
    public function borrar_alumno($student_id = null,$group_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registrations->get([$student_id,$group_id]);
        if ($this->Registrations->delete($registration)) {
            //$this->Flash->success(__('The registration has been deleted.'));
            $this->borrar_calificaciones($group_id, $student_id);
        } else {
            //$this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller'=>'lista_alumnos','action' => 'index']);
    }

    public function editar_alumno($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if($this->request->data['password'] == ''){
                unset($student->password);
            }
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('student'));
        $this->set('_serialize', ['student']);
    }    /**
     * 
     * @param type $group_id
     * @param type $student_id
     */
    protected function borrar_calificaciones($group_id = null,$student_id = null){
        $weights = $this->Weights->find('list',['keyField' => 'slug','valueField' =>'id'])->where(['group_id'=>  $group_id,'name NOT LIKE ' => 'asistencia']);
        $assignments = $this->Assignments->find('list',['keyField' => 'slug','valueField' =>'id'])->where(['weight_id IN'=>  $weights->toArray()]);
        if($assignments->count() != 0){
            $this->Grades->deleteAll(['student_id'=>$student_id,'assigment_id IN'=>$assignments->toArray()]);
        }
    }
    
    public function lista(){
    //Proceso para subir el archivo
        echo 'Hola';
        if ($this->request->is('post')) {
            $target_path = "C:/wamp64/www/ssimad/webroot/lists/"; 
            $target_path = $target_path . basename( $_FILES['archivo-a-subir']['name']);
            echo 'Hola'; 
            if(move_uploaded_file($_FILES['archivo-a-subir']['tmp_name'], $target_path)) 
            { 
            //echo "El archivo ". basename( $_FILES['archivo-a-subir']['name'])." ha sido subido exitosamente!";
            //echo "<br />"; 
                $file = $target_path;
                $objPHPExcel = new PHPExcel();
                $data = $this->Import->prepareEntityData($file);
                $pila_data=array(); 
                $username=0;
                $number_students=0;

                //Eliminamos los rows que no sirven
                error_reporting(E_ALL);
                set_time_limit(0);

                /** Include path **/
                set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

                /** PHPExcel_IOFactory */
                include 'PHPExcel/IOFactory.php';

                $fileType = 'Excel5';
                $objPHPExcel = PHPExcel_IOFactory::load($file);
                $objPHPExcel->getActiveSheet()->removeRow(2,2);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
                $objWriter->save($fileName);

                //Eliminamos los registros no validos
                print_r($data);
                
                foreach ($data as $data) {
                    if (isset($data['CUENTA'])) {
                    array_push($pila_data, $data);
                    $number_students++;
                    }
                }

                echo 'Hola';
                foreach ($pila_data as $p) {
                    echo $p;
                }

                //echo $number_students; echo '<br />';
                //Eliminamos los campos que no sirven 
                for ($i=0;$i<Count($pila_data);$i++) {
                    unset($pila_data[$i]['Number'],$pila_data[$i]['Key']);
                }

                //Renombramos el nombre de las llaves del array
                foreach ($pila_data as $p=>$v) {
                    $pila_data[$p] ['username'] =$pila_data[$p] ['Count'];
                    unset($pila_data[$p]['Count']);
                    $pila_data[$p] ['names'] =$pila_data[$p] ['Names'];
                    unset($pila_data[$p]['Names']);
                    $pila_data[$p] ['password'] =$pila_data[$p] [''];
                    unset($pila_data[$p]['']);
                }
                
                //Llenamos el campo password con el numero de cuenta
                for($i=0;$i<Count($pila_data);$i++) {
                    $pila_data[$i]['password']=$pila_data[$i]['username'];
                }

                //$pila_data ya contiene registros validos y los campos correctos
                //*****OK***********

                //Verificamos que no existan duplicados de numeros de cuenta en la tabla Students
                $students = $this -> Students -> find('all')
                    ->select(['id','username']);
                    $pila_temp=array();
                    for ($i=0;$i<$number_students;$i++) { 
                        foreach ($students as $s) {
                            //$username=(float)$s['username'];
                            if ($s['username']==$pila_data[$i]['username']){
                                array_push($pila_temp,$pila_data[$i]);
                                $pila_data[$i]['username']=NULL;
                            }
                        }
                    }

                    for ($i=0; $i <$number_students ; $i++) { 
                        if ($pila_data[$i]['username']==NULL) {
                            unset($pila_data[$i]);
                        }
                    }
                //******OK********

                //Reseteamos los indices
                $pila_data=array_values($pila_data);
                 
                //$pila_data solo tiene los numeros de cuenta no registrados
                //$pila_temp tiene los alumnos que ya estan registrados, pero no 
                //sabemos si estan registrados en el grupo
                //******OK*******

                $pila_data_add=array();
                $pila_data_add=$pila_data; 
                //----------------------------------------------------------------
                //Para INSERTAR estudiantes si existe alguno no registrado****OK
                if (!empty($pila_data_add)) {
                    $studentsTable = TableRegistry::get ('Students');
                    $oQuery = $studentsTable->query ();
                        foreach ($pila_data_add as $pila_data_add) {
                            $oQuery->insert (['username','names','password'])
                            ->values ($pila_data_add);
                        }
                    $oQuery->execute ();
                }

                //Este proceso se hace correctamente
                //*************OK************

                //Se debe generar una funcion para generar el cambio en la base
                $function='Registrations';
                $this->$function($pila_data, $pila_temp);
                
            } else{ 
                $this->Flash->success(__('The list has could not been saved. Try again.'));
            }
        } 
    }

    function Registrations($pila_data, $pila_temp){
        //Creamos el array para registrar al grupo
        //Verificamos que el alumno aun no este registrado en el grupo
        $number_students=0;
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
                
        $registrations = $this -> Registrations -> find('all')
                    ->where(['group_id IN' => $group_id]);

        $registrations = $registrations -> find ('all',[
            'contain' => ['Students']])
            ->select(['Students.username']);


            //Verificamos que los estudiantes que ya estaban en el sistema
            //No esten en el grupo
               for ($i=0;$i<Count($pila_temp);$i++) {
                    foreach ($registrations as $r) { 
                        if ($pila_temp[$i]['username']==$r['Students']['username']){
                            $pila_temp[$i]['username']=NULL;
                            $number_students++;
                        }
                    }
                }
                

                for ($i=0; $i<$number_students; $i++) { 
                    if ($pila_temp[$i]['username']==NULL) {
                        unset($pila_temp[$i]);
                    }
                }

                //Reseteamos los indices
                $pila_temp=array_values($pila_temp);
                
        //Generamos la pila final
        if (!empty($pila_temp)) {
            for ($i=0; $i <Count($pila_temp) ; $i++) { 
                array_push($pila_data,$pila_temp[$i]);
            }
        }
        //Reseteamos los indices
        $pila_data=array_values($pila_data);  
        //Hasta aqui pila_data tiene estudiantes que se necesitan agregar al grupo.
                
        $students = $this -> Students -> find('all')
            ->select(['id','username']);

        /*foreach ($students as $s) {
            echo $s['username'];
            echo '<br />';
        }*/

        //echo '<br />';
        //print_r($pila_data);
        /*foreach ($pila_data as $p) {
            echo (strval($p['usernames']));
            echo '<br />';
        }*/

        $regis=array();
        for ($i=0; $i <Count($pila_data) ; $i++){
            foreach ($students as $s) {
                if ($s['username']==$pila_data[$i]['username']) {
                    array_push($regis,array('group_id'=>$group_id,'student_id'=> $s['id']));
                }
            } 
        }

        //print_r($regis);
        //regis contiene group_id y student_id por cada estudiante a registrar
        //***OK***

        //Realizamos el registro del alumno en el grupo***OK
        if (!empty($regis)) {
            $registrationsTable = TableRegistry::get ('Registrations');
                $oQuery2 = $registrationsTable->query ();
                    foreach ($regis as $r) {
                        $oQuery2->insert (['group_id','student_id'])
                                ->values ($r);
                    }
            $oQuery2->execute ();
        }
        $this->Flash->success(__('The list has been saved.'));
    }

    /**
     * 
     */
    public function calificaciones(){
        $group_id = $this->user['group_id'];
        $registrations = $this->Registrations->find('list',['keyField' => 'slug','valueField' =>'student_id'])->where(['group_id'=> $group_id ]);
        $weights = $this->Weights->find('list',['keyField' => 'weight','valueField' =>'id'])->where(['group_id'=>  $group_id]);
        $weights = $weights->toArray();

/*
        foreach ($weights as $key => $value) {
            echo "$key:::$value"."<br /><br >";
        }*/

        $assignments = $this->Assignments->find('list',['keyField' => 'name','valueField' =>'id'])->where(['weight_id IN'=>  $weights])->order(['name'=>'ASC']);
/*
        foreach ($assignments as $key => $value) {
            echo "$key:$value"."<br />";
        }*/

        $students_assignments = $this->Students->find('all')
            ->order(['paternal_surname' =>'ASC'])
            ->where(['id IN'=> $registrations->toArray()])
            ->contain(['InfoGrades' => function ($q) use ($assignments) {
                return $q
                ->where(['InfoGrades.assigment_id IN' => $assignments->toArray()])
                ->order( ['InfoGrades.name'=>'ASC']);
                }
            ]);
        // print_r("$students_assignments");
        $this->set(compact('weights','assignments','students_assignments'));
    }

    public function agregar_calificacion() {
        $group_id = $this->user['group_id'];
        $assignment = $this->Assignments->newEntity();
        if ($this->request->is('post')) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                
                $registrations = $this->Registrations->find('list')->where(['group_id'=> $group_id ]);
                $students = $this->Students->find('all',['fields' => ['id']])->where(['id IN'=>$registrations->toArray()]);
                
                foreach ($students as $student){
                    $data = ['student_id'=>$student->id,'assigment_id'=>$assignment->id,'value'=>0];
                    $grade = $this->Assignments->Grades->newEntity();
                    $grade = $this->Assignments->Grades->patchEntity($grade, $data);
                    $this->Assignments->Grades->save($grade);
                }
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['controller'=>'lista_alumnos','action' => 'calificaciones']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $weights = $this->Assignments->Weights->find('list', ['limit' => 200])->where(['group_id'=> $group_id,'name NOT LIKE ' => 'asistencia']);
        $this->set(compact('assignment', 'weights'));
    }




    
    
    public function modificar_calificacion($id) {
        $assignment = $this->Assignments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->data);
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['controller'=>'lista_alumnos','action' => 'calificaciones']);
            } else {
                $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
            }
        }
        $weights = $this->Assignments->Weights->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'weights'));
    }
    
    public function borrar_calificacion($id) {
        $this->request->allowMethod(['post', 'delete']);
        $assignment = $this->Assignments->get($id);
        if ($this->Assignments->delete($assignment)) {
            $this->Flash->success(__('The assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The assignment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller'=>'lista_alumnos','action'=>'calificaciones']);
    }
    
    /**
     * 
     * @return type
     */
    public function guardar_calificaciones(){
//        var_dump($this->request->data['calificaciones']);
//        exit;
        $data = $this->request->data['calificaciones'];
        foreach($data as $key => $grades){
            foreach ($grades as $key2 => $data_grade){
                $grade = $this->Grades->newEntity($data_grade);
                $this->Grades->save($grade, ['atomic' => false]);
                var_dump($grade->errors());
            }
        }
        return $this->redirect(['controller'=>'lista_alumnos','action'=>'calificaciones']);
    }
    
    
    public function conceptos() {
        $array_weights = array();
        $group_id = $this->user['group_id'];
         //$this->Flash->error('Jejeje, no muestra color');  
        
            
        if ($this->request->is('post')) 
        {
            $data = $this->request->data['weights'];
//            var_dump($this->request->data['terminar']);
            //print_r($data);
//            exit;



            
            foreach ($data as $key => $data_weight)
            {

                print_r($data_weight);

                
                    $weight = $this->Weights->newEntity();
                    $weight->group_id = $group_id;
                    $weight = $this->Weights->patchEntity($weight,$data_weight);
                    print_r($weight);

                    if(( isset($this->request->data['terminar'])) && ($this->request->data['terminar'] == 'end') )
                    {
                        //$this->Weights->save($weight);
                        return $this->redirect(['controller'=>'lista_alumnos','action'=>'calificaciones']);
                    }

                   $array_weights[] = $weight;



            }
                    

            if(isset($this->request->data['agregar']) && $this->request->data['name'] == 'add')
            {
                $this->Weights->save($weight);
                

                return $this->redirect(['controller'=>'lista_alumnos','action' => 'conceptos']);

                /*
                $aux = end($array_weights);
                if(empty($aux->errors())){
                    $array_weights[] = $this->Weights->newEntity();
                }*/
                
                

            }


        }


        else
        {
            $weights = $this->Weights->find('all')->where(['group_id'=> $group_id]);
            if($weights->count() != 0)
            {
                foreach ($weights as $weight)
                {
                    $array_weights[] = $weight;
                }

                $array_weights[] = $this->Weights->newEntity();
            }

            else
            {
                $array_weights[] = $this->Weights->newEntity();
            }
        }
        
        $this->set(compact('array_weights'));
    }
    
    public function borrar_concepto($id = null) {
        
        $weight = $this->Weights->find('all')->where(['id'=>$id,'group_id'=>$this->user['group_id']])->first();
        
       // $assignment = $this->Weights->find('all')->where(['id'=>$id], ['group_id'=>$this->user['group_id']]);
        //  $this->belongsTo($weight);
        //$result = $this->Weights->delete($weight);
       $assignment = $this->Assignments->find('all')->where(['weight_id' => $id]);
       // print_r($assignment->toArray());
       if( empty($assignment->toArray()))
       {  
            if ($this->Weights->delete($weight)) {
                $this->Flash->success(__('The weight has been deleted.'));
            } 
            else {
                $this->Flash->error(__('The weight could not be deleted. Please, try again.'));
            }

            return $this->redirect(['controller'=>'lista_alumnos','action' => 'conceptos']);
        
       }

       else 
       {
            $this->Flash->error(__('No se puede borrar el concepto porque tiene calificaciones asociadas.'));
            return $this->redirect(['controller'=>'lista_alumnos', 'action'=>'conceptos']);
       }
/*

            if ($this->Weights->delete($weight)) {
                $this->Flash->success(__('The weight has been deleted.'));
            } 
            else {
                $this->Flash->error(__('The weight could not be deleted. Please, try again.'));
            }

            return $this->redirect(['controller'=>'lista_alumnos','action' => 'conceptos']);
        
*/

    }

    public function asistencias(){
        $aclasses = $this->Aclasses->newEntity();
        $this->loadModel('Registrations');
        $this->loadModel('Students');
        $this->loadModel('Aclasses');
        $this->loadModel('Attendances');


        if($this->request->is('post'))
        {
            if(isset($this->request->data['agregar']) && $this->request->data['agregar'] == 'add')
            {
                return $this->redirect(['controller'=>'lista_alumnos', 'action'=>'conceptos']);
            }  
        }

        $group_id = $this->request->session()->read('Auth.User.group_id');
        $aclass = $this -> Aclasses ->find('all')
            ->where(['group_id IN' => $group_id]);
        //echo $aclass;
        //This is the correct Query
        /*
         * SELECT students.names, students.email FROM students INNER JOIN registrations ON students.id = registrations.student_id
           WHERE registrations.group_id=7;
         */
        
        $student_registrations = $this -> Students ->find('all')
                ->join([
                    'Registrations' =>[
                        'table' => 'Registrations',
                        'type' => 'inner',
                        'conditions' => 'Students.id = Registrations.student_id',
                    ],
                ])
                ->where(['Registrations.group_id' => $group_id])
                ->toArray();
        
        $this->set([
            'success' => true,
            'data' => $student_registrations,
            '_serialize' => ['success', 'data']
        ]);
        $this->set('aclass', $aclass);
        $this->set(compact('aclass'));


        $aclasses_attendances = $this -> Attendances ->find('all')
                //->contain(['Aclasses'])
                ->join([
                    'Aclasses' =>[
                        'table' => 'Aclasses',
                        'type' => 'inner',
                        'conditions' => 'Aclasses.id = Attendances.class_id',
                    ],
                ])
                ->where(['Aclasses.group_id' => $group_id])
                ->toArray();
        //print_r($aclasses_attendances);
        
       

        $this->set([
            'success' => true,
            'data_class' => $aclasses_attendances,
            '_serialize' => ['success', 'data_Class']
        ]);

        //Generamos la entidad para realizar el update
        
        /*$registration_group = $this -> Registrations ->find('list',['valueField' => 'group_id'])
                ->where(['group_id IN' => $group_id]);
        //echo $registration_student;

        $student = $this-> Students ->find('all', [ ]);
    
        $regis_student = $student -> find ( 'all',[
            'contain' => ['Registrations']
        ])->toArray();
        
        //print_r ($regis_student);

        $regis_student = $student -> find('all')
            //;//->where(['group_id' => $group_id]);
        

        $this->set('regis_group', $registration_group);
        $this->set('student', $regis_student);*/

        //$this->serialize('_serialize', ['aclasses']);
        
    }

    public function update_attendance(){
        //var_dump($this->request->data['asistencias']);
        //var_dump($this->request->data['updates_pcomment']);
        //exit;
        /*$data = $this->request->data['asistencias'];
        foreach($data as $key => $assignment){
            $upload = $this->Attendances->newEntity($attendances);
            $this->Attendances->save($upload);
            //var_dump($grade->errors());
            
        }
        return $this->redirect(['controller'=>'ListaAlumnos','action'=>'asistencias']);*/
        $this->loadModel('Attendances');
        $data = $this->request->data['asistencias'];
        foreach($data as $key => $alumno){
            foreach ($alumno as $key2 =>$asistencia){
                //var_dump($asistencia);
                $asist = $this->Attendances->newEntity($asistencia);
                $this->Attendances->save($asist, ['atomic' => false]);
                //var_dump($asist->errors());
                $this->Flash->success('This was successful');
            }
        }
        //exit;
        return $this->redirect(['controller'=>'lista_alumnos','action'=>'asistencias']);
    }


    public function agregar_asistencias(){
        $aclasses = $this->Aclasses->newEntity();
        if ($this->request->is('post')) {
            $aclasses = $this->Aclasses->patchEntity($aclasses, $this->request->data);
            if ($this->Aclasses->save($aclasses)) {
                $this->Flash->success(__('Se ha guardado la fecha correctamente'));
                return $this->redirect(['controller' => 'lista_alumnos', 'action' => 'asistencias']);
                # code...
            }else{
                $this->Flash->error(__('Error al agregar la fecha, verifique los datos.'));
            }
        }

        //Consultamos el grupo
        $group_id = $this->request->session()->read( 'Auth.User.group_id' );
        //echo $group_id;
        $hoy = date("Y-m-d");
        //echo $hoy;
        /*    
        // Si la información no está vacía
        if (!empty($this->data)) {
            // Crea una nueva fecha
            $this->$aclasses->create();
            // Inserta los datos en la base de datos, la función save recibe
            // como parametro $this->data que son todos los valores del formulario
            if ($this->Date->save($this->data)) {
                // Muestra un mensaje informando lo sucedido
                $this->Session->setFlash('La Asistencia ha sido guardada correctamente.');
                // Una vez guardado redirecciona a la vista listar para ver los datos
                // ingresados
                $this->redirect('lista_alumnos/asistencias');
                } else {
                // Muestra un mensaje informando lo sucedido
                $this->Session->setFlash('La Asistencia no se ha podido guardar, verifique los
                    datos e inténtelo de nuevo.');
                }
            }
        }*/
        $this->set('aclasses', $aclasses);
        $this->set('group_id', $group_id);
    }
}
