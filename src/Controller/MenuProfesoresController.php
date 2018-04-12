<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Event\Event;


/**
 * This controller will render views from Template/MenuProfesores/
 *
 * 
 */
class MenuProfesoresController extends AppController
{
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
         $this->user = $this->request->session()->read('Auth.User');
         
         $this->loadModel('Groups');
         $this->loadModel('Students');
         $this->loadModel('InfoGroups');
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
            
        return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
    }

    public function index(){
        $info_group = array();
        if(isset($this->user['data']))
            $this->request->session()->write('Auth.User.data',NULL);
        
        if(!is_null($this->user['group_id'])){
            $info_group = $this->InfoGroups->find('all')->where(['group_id' => $this->user['group_id'] ])->first();
            //echo "Esto es un test";
            //print_r($info_group);
        }
        $agroups = $this->Groups->find('list', ['keyField' => 'slug','valueField' =>'id'])->where(['professor_id' => $this->user['id']]);
        $groups = $this->InfoGroups->find('list', ['keyField' => 'group_id','valueField' =>'course_number_group','groupField' => 'name'])->where(['group_id IN' => $agroups->toArray()]);
        
    

        //echo "<br /> <br /> ";

       // print_r($info_group);
/*
        $query = $this->Assignments->find('all')
        ->order(['Assignments.id' => 'ASC'])
        ->contain(['Weights.Groups.Courses'])->where(['id IN' => '1']);

        print_r($query);
*/

        //print_r($groups);
        $this->set(compact('groups','info_group'));





    }





    
    public function agregar_grupo() {
        $group = $this->Groups->newEntity();

        
        if ($this->request->is('post')) 
        {
            $group = $this->Groups->patchEntity($group, $this->request->data);

            echo "This is the out: ".$group->classroom;

            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['controller'=>'menu_profesores','action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }


        //Consulto el semestre actual
        $hoy = date("Y-m-d");
        $courses = $this->Groups->Courses->find('list', ['limit' => 200]);
        $professor = $this->user['id'];
        //$semester = $this->Groups->Semesters->find('all', ['fields'=>['id','name']])->where(['start_date <=' => $hoy, 'end_date >=' => $hoy])->first();
       
        $semester = $this->Groups->Semesters->find('list', ['limit' => 200]);



        $this->set( [ 'group' => $group, 'courses' => $courses, 'professor' => $professor, 'semester' => $semester] );
       
    }
    
    






    public function editar_grupo() {
        if(is_null($this->user['group_id']))
                return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
        $group = $this->Groups->get($this->user['group_id'], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['controller'=>'menu_profesores','action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }







    
    public function mensajes() {
        if(is_null($this->user['group_id']))
                return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
        
        if(is_null($this->user['group_id']))//Redireccionar por si no está el group_id en la sesión
            return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
            
        $messages = $this->Messages->find('all')->where(['group_id' => $this->user['group_id'] ]);
        $this->set('messages',$messages);
        
    }
    
    public function agregar_mensaje() {

         
  //       $var = new SendEmail(); 
//         $var->send_email();

        //$email = new Email('default');
        //$email->from(['multimediaunam@gmail.com' => "Welcome to my life"])->to('johannkreuzk@gmail.com')->subject('This is a test')->send('Hello guys');

        /*


        $email = new Email();
        $email->transport('gmail')
        ->from(['multimediaunam@gmail.com'=>'multimediaunam@gmail.com'])
        ->to('johannkreuzk@gmail.com')
        ->subject('This is the test')
        ->emailFormat('html')
        ->viewVars(array( 'msg'=>'Salida'))
        ->send('Mi nombre es daniel lugo');
       //$email->template('welcome');
       //$email->viewVars(['user' => ['username' => 'amukmca']]);



*/
        $group_id = $this->user['group_id'];
        $username = $this->user['username'];
        $full_name = $this->user['full_name'];
        $registrations = $this->Registrations->find('list',['keyField' => 'slug','valueField' =>'student_id'])->where(['group_id'=> $group_id ]);
        
        $students = $this->Students->find('all')->where(['id IN'=>$registrations->toArray()])->order(['paternal_surname' =>'ASC']);
        $this->set(compact('students','group_id'));

        exec( "ls", $salida);
        $output;

        //print_r( $this->request->session()->read('Auth.User')['username']);
        //exec("ls", $salida);
        //echo $students;

        foreach ($students as $key => $value) {
            //echo "{$key} => {$value['email']}<br /><br />";
            exec( "echo {$value['email']} >> $username" );
            //exec( "sendmail.sh $full_name $username", $output);
            exec( "echo $full_name", $output);
            echo "<BR /><BR />";
            print_r($output);

        }
        exec( "sendmail $full_name $username", $output);

        echo "<BR /><BR />Salidasssss";
        print_r($output);



















        if(is_null($this->user['group_id']))
                return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
        

        $message = $this->Messages->newEntity();

        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
               



                $this->Flash->success(__('The message has been saved.'));
                return $this->redirect(['controller'=>'menu_profesores','ac2tion' => 'mensajes']);
            } else {
                $this->Flash->error(__('The message could not be saved. Please, try again.'));
            }
        }
        $group_id = $this->user['group_id'];
        $this->set(compact('message', 'group_id'));
    }



    public function sendMail(){
       $email = new Email();
       $email->transport('default');
       $email->to('johannkreuzk@gmail.com');
       //$email->template('welcome');
       //$email->viewVars(['user' => ['username' => 'amukmca']]);
       $email->send();
       exit;
    }

    
    public function enviar_correo() {
        $to = '';
        $message = $this->Messages->newEntity();
        if(!isset($this->request->data['email'])){
            if ($this->request->is('post')) {
                $message = $this->Messages->patchEntity($message, $this->request->data);
                if ($this->Messages->save($message)) {
                    $this->Flash->success(__('The message has been saved.'));
                    return $this->redirect(['controller'=>'menu_profesores','action' => 'index']);
                } else {
                    $this->Flash->error(__('The message could not be saved. Please, try again.'));
                    $to = $this->request->data['to'];
                }
            }
            if(!isset($this->user['data']['email']))
                return $this->redirect(['controller'=>'menu_profesores','action'=>'index']);
            $to = $this->user['data']['email'];
        }  else {
            $to = $this->request->data['email'];
            $this->request->session()->write('Auth.User.data.email',$to);
        }
        
        $from = $this->user['email'];
        $this->set(compact('message','to','from'));
    }
    
    
    public function busqueda(){
        if(isset($this->request->data['profesores'])){
            $this->request->session()->write('Auth.User.data.busqueda',$this->request->data['profesores']);
            return $this->redirect(['controller'=>'menu_profesores','action'=>'profesores']);
        }
        
        if(isset($this->request->data['material'])){
            $this->request->session()->write('Auth.User.data.busqueda',$this->request->data['material']);
            return $this->redirect(['controller'=>'menu_profesores','action'=>'material_didactico']);
        }
            
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
