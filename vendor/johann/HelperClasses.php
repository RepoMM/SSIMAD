

<?php
 


		class HelperClasses
		{




			/*
				Recibe una estructura de la siguiente forma:

					Array ( 
							[0] => Array ( [assigment_id] => 5 [grade_id] => 15 [student_id] => 8 [name] => Examen 1 [value] => 10 [weight] => 60 ) 
							[1] => Array ( [assigment_id] => 7 [grade_id] => 29 [student_id] => 8 [name] => Examen 2 [value] => 10 [weight] => 60 ) 
							[2] => Array ( [assigment_id] => 6 [grade_id] => 22 [student_id] => 8 [name] => Tarea 1 [value] => 10 [weight] => 40 ) 
							[3] => Array ( [assigment_id] => 8 [grade_id] => 36 [student_id] => 8 [name] => Tarea 2 [value] => 10 [weight] => 40 ) 
							[4] => Array ( [assigment_id] => 9 [grade_id] => 43 [student_id] => 8 [name] => Tarea 3 [value] => 8 [weight] => 40 ) 
							[5] => Array ( [assigment_id] => 10 [grade_id] => 50 [student_id] => 8 [name] => Tarea 4 [value] => 9 [weight] => 40 ) )
					
						resultado de una consulta  a la base de datos.


			*/
				public function promedio( $info_grades_aux )
				{
					    $counter= 0;
                        $union = [];
                        $sumatoria = 0;
                        $aux = 0;
                        $weights_aux = 0;

                          


                           //print_r( $info_grades_aux );
                           //echo "<br />";

                            foreach ($info_grades_aux as $key ) 
                            {   
                                if( $counter == 0 )
                                {
                                    $counter++;
                                    $aux = $key['weight'];  
                                    $sumatoria = $key['value']; 
                                   // print_r($key) ;

                                    continue;
                                }


                                    $weights_aux = $key['weight'];                             


                                if(  $aux == $weights_aux  )
                                {
                                    $sumatoria += $key[ 'value' ];
                                    $counter++;
                                }

                                if( ($aux != $weights_aux) ||  (next( $info_grades_aux ) != false) )
                                //if( ($aux != $weights_aux) )
                                {
                                    $union[$aux] = [ $counter => (($sumatoria/$counter)*($aux/100)) ];                                    
                                    $aux= $weights_aux;                                        
                                    $counter = 1;
                                    $sumatoria = $key['value']; 
                                   // echo "Entreadasasdads<br />";
                                }

                                //echo "<br />".$key;   
//                                print_r($key);

                                //echo "<br />";
                                //echo "<br />".$sumatoria;                          


                            }

                            // print_r($union);
                            $promedio = 0;
                            foreach ($union as $weight => $total_Elements) {
                                foreach ($total_Elements as $a => $sumatoriaElements) {
                                        $promedio += $sumatoriaElements;                                    
                                }                                
                            }
                            $promedio = round( $promedio, 4 );
                           


                            //print_r( $info_grades_aux );

                 return $promedio;
				} 

		}


?>