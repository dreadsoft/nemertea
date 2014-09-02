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
        
        $terapie = $this->Terapie->farmaciVisita($idvisita);
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
		
		$idvisita = $this->Session->read('Visita.id');
		if ($idvisita !== null) $this->redirect ("/visite/apri/" . $idvisita . "#areaTerapia");
		
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
	
    public function visitaPrecedente ($id_visita = null)
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;  
        
        if ($id_visita === null) $id_visita = $this->Session->read("Visita.id");
        $this->loadModel('Visita');
        
        $precedente = $this->Visita->precedente($id_visita);
        $terapie_precedenti = $this->Terapie->farmaciVisita($precedente);
        $this->set('terapie', $terapie_precedenti);
        $this->set('visita_precedente', $precedente);
        
        
    }
    
    public function copiaDaPrecedente ($id_visita = null)
    {
        $this->autoRender = false;
        
        if ($id_visita === null) $id_visita = $this->Session->read("Visita.id");
        $this->loadModel('Visita');
        
        $precedente = $this->Visita->precedente($id_visita);
        
        $terapie = $this->Terapie->farmaciVisita($precedente);
        
        foreach ($terapie as $i => $t) {
            unset($terapie[$i]['Terapie']['id']);
            $terapie[$i]['Terapie']['visita_id'] = $id_visita;
            
            print_r($terapie[$i]);
            echo "<hr>";
            try {
                $this->Terapie->save($terapie[$i]);
                $this->Terapie->clear();
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }            
        }
        

        
        $this->redirect("/visite/apri/$id_visita#areaTerapia");
    }
            
            
    
}

?>

