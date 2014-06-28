<?php
class VisiteController extends AppController {

	public function index () 
	{
            
	}
	
	public function nuova ($paziente_id = null)
	{
            if ($paziente_id == null) return $this->redirect('/visite/index');
            $this->set ('paziente_id', $paziente_id);
            
            $this->loadModel('Tipovisita');
            $tipi = $this->Tipovisita->find(
                        'list', 
                        array('fields' => array(
                            "Tipovisita.id", 
                            "Tipovisita.descrizione"
                            )
                        )   
                    );
            
            $this->set('tipovisita', $tipi);
	}
        
        function modifica ()
        {
            $dati = $this->request->data;
            $this->set('dati', $dati);
            $this->Visita->save($dati);
            return $this->redirect('/visite/elenco/' . $this->request->data['Visita']['paziente_id']);
        }
        
        function elenco ($paziente_id = null) 
        {
            if ($paziente_id == null) return $this->redirect('/visite/index');
            $this->Session->write("Paziente.id", $paziente_id);
            
            
            
        }
        
        function mostra ()
        {
            
        }
        

}
?>