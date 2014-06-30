<?php
class AnamnesieventiController extends AppController {
	
		
	public function index () {
            
	}
	
        public function nuovo () {
            $this->set("paziente_id", $this->Session->read("Paziente.id"));
        }
        
	public function crea () 
        {
                $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
                $this->autoLayout = false;
                $this->autoRender = false;
                $dati = $this->request['data']['Anamnesievento'];
                $this->Anamnesievento->save($dati);
                return("Evento salvato");
	}
        
        public function elimina ($id_evento) 
        {
            $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
            $this->autoLayout = false;
            $this->autoRender = false;
            $this->Anamnesievento->delete($id_evento, false);
        }
	
	public function modifica($evento_id) {
         
            $this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
            $this->autoLayout = false;
            // $this->autoRender = false;    
            
            $this->set("paziente_id", $this->Session->read("Paziente.id"));
            $anamnesi = $this->Anamnesievento->find('first', array(
                'conditions' => array('Anamnesievento.id' => $evento_id)
            ));      
            $this->data = $anamnesi;
	}
}
?>