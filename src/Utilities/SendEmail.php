<?php

	namespace App\Utilities;
	use App\Controller\AppController;
	use Cake\Mailer\Email;

		class SendEmail extends AppController
		{
				public function send_email()
				{
					Email::configTransport( 'gmail',['host' => 'ssl://smtp.gmail.com',
														'port' => 465, 
														'username' => 'multimediaunam@gmail.com',
														'password' => 'LdMeI55_NJ',
														'className' => 'Smtp',
														'context' => [ 
																		'ssl' => [ 
																					'verify_peer' => false,
          																			'verify_peer_name' => false,
          																			'allow_self_signed' => true
        																		 ]
      																 ]
      												]

										  );


					$correo = new Email();

					//$correo->setFrom(['multimediaunam@gmail.com' => 'mmedia1-fi.unam.mx'] )->setTo( 'johannkreuzk@gmail.com' )->setSubject('This is a test')->send('Mensajito');
					 $correo
      ->transport('gmail') //nombre del configTrasnport que acabamos de configurar
      ->template('') //plantilla a utilizar
      ->emailFormat('html') //formato de correo
      ->to('johannkreuzk@gmail.com') //correo para
      ->from('multimediaunam@gmail.com') //correo de
      ->subject('Correo de prueba en cakephp3') //asunto
      ->viewVars([ '' => '' ]);
    
				    if($correo->send()){
				      echo "Correo enviado";
				    }else{
				      echo "Ups error man";
				    }    


				}
		}
?>