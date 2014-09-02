<?php
class FvcController extends AppController {
    
    public function modifica ($id = null)
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;
        
        if ($id !== null) {
            $dati = $this->Fvc->findById($id);
            $this->data = $dati;
        }
            
    }
    
    public function salva () 
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;
	
        $fvc =$this->request->data['Fvc'];
        
        if ($fvc['id'] === null) unset ($fvc['id']);
        if ($fvc['paziente_id'] == null) $fvc['paziente_id'] = $this->Session->read('Paziente.id');
        if ($fvc['visita_id'] == null) $fvc['visita_id'] = $this->Session->read('Visita.id');

        // Salvataggio dati
        $msg_errore = "Salvataggio eseguito con successo";
        
        try {
            $this->Fvc->save($fvc);
        } catch (PDOException $ex) {
            $msg_errore =  $ex->getMessage();
        }
        
        $this->set("msg_errore", $msg_errore);
    }
    
    public function mostra() 
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;
        $visita_id = ($this->Session->read("Visita.id"));
        
        $fvc = $this->Fvc->find('all', array('conditions' => array('visita_id' => $visita_id)));
        $this->set('fvc', $fvc);
    }
    
    function elimina ($id = null)
    {
        if ($id !== null) $this->Fvc->delete($id);
        $visita_id = $this->Session->read("Visita.id");
        
        $this->redirect("/visite/apri/$visita_id#areaEsamiStrumentali");
        
    }

}

?>