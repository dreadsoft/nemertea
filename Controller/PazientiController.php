<?php
class PazientiController extends AppController {
	public $hasMany = 'Emogasanalisi';
	
	public function index () {
		$this->set('pazienti', $this->Paziente->find('all'));
                $this->Session->delete("Paziente");
	}
	
	public function nuovo () {
            
	}
	
	public function crea() {
	    if ($this->request->is('post')) {
                $this->Paziente->create();
                if ($this->Paziente->save($this->request->data)) {
                    $this->Session->setFlash(__('Scheda paziente creata'));
                    return $this->redirect(array('action' => 'pazienti/index'));
                }
                $this->Session->setFlash(__('Errore nella creazione della scheda paziente'));
            }
	
	}
	
        public function cerca ($searchstring=null) 
        {
            if ($searchstring == null) $this->index();
            $conditions[] = array("Paziente.cognome LIKE '%$searchstring%'");
            $conditions[] = array("Paziente.nome LIKE '%$searchstring%'");
            
            $pazienti = $this->Paziente->find('all', array('conditions' => array('OR' => $conditions)));
            $this->set('pazienti', $pazienti);
            $this->Session->delete('Paziente');
            
            
        }
}
?>