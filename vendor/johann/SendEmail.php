<?
	namespace App\Controller;
	use Cake\Network\Email\Email;

		class SendEmail extends AppController
		{
				public function send_email()
				{
					Email::configTransport(
												'mail', ['host' => 'ssl://smtp.gmail.com'
														'port' => 465, 
														'username' => 'multimediaunam@gmail.com',
														'password' => 'LdMeI55_NJ',
														'className' => 'Smtp', ]

										  );


					$correo = new Email();

					$correo
							->transport('mail')
							->template('')
							->emailFormat('')
							->to('johannkreuzk@gmail.com')
							->from('multimediaunam@gmail.com')
							->subject('Esto es una prueba')
							->viewVars([]);

					if($correo->send())
					{
						echo "Correo Enviado";
					}
						else
						{
							echo "Fallo envío";
						}

				}
		}
?>