<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\UsersTable $Students
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('Users');
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * login method
     *
     * @return void Redirects on index view.
     */
    public function login()
    {

        
        $this->viewBuilder()->layout('login');
        
        $is_logged = false;

        $user = $this->Users->newEntity();

        if(!is_null($this->request->session()->read('Auth.User'))) 
        {
            $is_logged = true;
            $user = $this->request->session()->read('Auth.User');
        } 

            else 
            {
            
                if ($this->request->is('post')) 
                {
                    $user = $this->Auth->identify();
                
                if ($user) 
                {
                    $is_logged = true;
                    //Par no mostrar la opciones del menú sin escoger grupo
                    $user['group_id']=NULL;$user['data']=NULL;
                    $this->Auth->setUser($user);
                } 
                    else 
                    {
                    $this->Flash->error(__('Username or password is incorrect'), [
                        'key' => 'auth'
                    ]);

                    }
                }
        }
        //var_dump($user);
        if ($is_logged) {
            if ($user['role'] == 'ADMIN') {
                return $this->redirect(array('controller' => 'pages', 'action' => 'index'));
            }
            if ($user['role'] == 'PROF') {
                return $this->redirect(array('controller' => 'menu_profesores', 'action' => 'index'));
            }
            if ($user['role'] == 'EST') {
                return $this->redirect(array('controller' => 'menu_alumnos', 'action' => 'index'));
            }
        }
        
        
    }
    
    /**
     * login method
     *
     * @return void Redirects on index view.
     */
    public function logout()
    {
        
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
        
        
    }
    
    public function perfil(){
        
        $role = $this->request->session()->read('Auth.User.role');
        if ($role == 'PROF') {
            return $this->redirect(array('controller' => 'professors', 'action' => 'perfil'));
        }
        if ($role == 'EST') {
            return $this->redirect(array('controller' => 'students', 'action' => 'perfil'));
        }
    }
}
