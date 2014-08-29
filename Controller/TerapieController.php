<?php
class TerapieController extends AppController {

    public function index () {
        
    }
    
    public function elencoFarmaciVisita ($idvisita = null)
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;

        // Se idvisita non specificato, tenta di recuperarlo dalla sessione
        if ($idvisita == null) $idvisita = $this->Session->read("Visita.id");
        
        $terapie = $this->Terapie->findAllByVisita_id($idvisita);
        $this->set('terapie', $terapie);
       
    }       
	
	public function salva () 
	{
		$this->layout = 'ajax';
		$this->autoLayout = false;
		
		// Salvataggio dati
		$this->Terapie->save($this->request->data);
		/*
		 * Controlla se è specificato un ID visita nella sessione
		 * se specificato, redireziona alla scheda visita dopo la modifica
		 */
		
		// $idvisita = $this->Session->read('Visita.id');
		// if ($idvisita !== null) $this->redirect ("/visite/apri/" . $idvisita);
		
	}
	
	public function modifica ($id) 
	{
		$this->layout = 'ajax';
		$this->autoLayout = false;
		
		$this->data = $this->Terapie->findById($id);
	}
	
	public function elimina ($id)
	{
		$info = $this->Terapie->findById($id);
		
		$this->Terapie->delete($id);
		
		$idvisita = $this->Session->read('Visita.id');
		if ($idvisita !== null) $this->redirect ("/visite/apri/" . $idvisita . "#areaTerapia");
		
	}
	

    
}

?>
