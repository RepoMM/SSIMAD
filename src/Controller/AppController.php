<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

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

        //$this->loadComponent('RequestHandler');
        $this->loadComponent('RequestHandler', [
                        'viewClassMap' => ['xlsx' => 'Cewi/Excel.Excel']
        ]);
        $this->loadComponent('Flash');

        



          
        
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' 
                ],
        ]);
        
        
    }
    
    /**
     * Before Filter callback.
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(Event $event)
    {

       //  $this->Auth->allow();

        

        if (!$this->Auth->user()) {
            $this->Auth->config('authError','Usted no está autorizado a acceder a dicha ubicación.' );
        }
        $this->Auth->allow(['login', 'logout']);
       //$this->Auth->allow();
        
        //Titulo de la página
        $this->set('cakeDescription', __('SIAEFI V. 3.0', true));
        
        $role = $this->request->session()->read('Auth.User.role');
        
        //Se selecciona la página inicial para cada tipo de usuario
        if ($role == "ADMIN")
            $this->viewBuilder()->layout('default');
        if ($role == "PROF")
            $this->viewBuilder()->layout('profesor');
        if ($role == "EST")
            $this->viewBuilder()->layout('estudiante');
       
  
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    function uploadFiles($folder, $formdata, $itemId = null) {
    // setup dir names absolute and relative
        $folder_url = WWW_ROOT.$folder;
        $rel_url = $folder;

        // create the folder if it does not exist
        if(!is_dir($folder_url)) {
        mkdir($folder_url);
        }

        // if itemId is set create an item folder
        if($itemId) {
        // set new absolute folder
        $folder_url = WWW_ROOT.$folder.'/'.$itemId;
        // set new relative folder
        $rel_url = $folder.'/'.$itemId;
        // create directory
        if(!is_dir($folder_url)) {
        mkdir($folder_url);
        }
        }

        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png', 'document/.docx','document/.pdf');

        // loop through and deal with the files
        foreach($formdata as $file) {
        // replace spaces with underscores
        $filename = str_replace(' ', '_', $file['name']);
        // assume filetype is false
        $typeOK = false;
        // check filetype is ok
        foreach($permitted as $type) {
        if($type == $file['type']) {
        $typeOK = true;
        break;
        }
        }

        // if file type ok upload the file
        if($typeOK) {
        // switch based on error code
        switch($file['error']) {
        case 0:
        // check filename already exists
        if(!file_exists($folder_url.'/'.$filename)) {
        // create full filename
        $full_url = $folder_url.'/'.$filename;
        $url = $rel_url.'/'.$filename;
        // upload the file
        $success = move_uploaded_file($file['tmp_name'], $url);
        } else {
        // create unique filename and upload file
        ini_set('date.timezone', 'Europe/London');
        $now = date('Y-m-d-His');
        $full_url = $folder_url.'/'.$now.$filename;
        $url = $rel_url.'/'.$now.$filename;
        $success = move_uploaded_file($file['tmp_name'], $url);
        }
        // if upload was successful
        if($success) {
        // save the url of the file
        $result['urls'][] = $url;
        } else {
        $result['errors'][] = "Error uploaded $filename. Please try again.";
        }
        break;
        case 3:
        // an error occured
        $result['errors'][] = "Error uploading $filename. Please try again.";
        break;
        default:
        // an error occured
        $result['errors'][] = "System error uploading $filename. Contact webmaster.";
        break;
        }
        } elseif($file['error'] == 4) {
        // no file was selected for upload
        $result['nofiles'][] = "No file Selected";
        } else {
        // unacceptable file type
        $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
        }
        }
        return $result;
    }
}
