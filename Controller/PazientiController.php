<?php
class PazientiController extends AppController {

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
                    return $this->redirect(array('action' => '/pazienti/index'));
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
			$this->Session->delete('Visita');
		}
        
        public function riepilogo ($paziente_id = null)
        {
            if ($paziente_id == null) return $this->redirect('/pazienti/index');
            
            /*
             * Collego la tabella visite
             */
            $this->Paziente->bindModel(
                array(  'hasMany' => 
                    array(
                        'Visita' => array(
                            'order' => "Visita.data_visita DESC"
                        )
                    )
                )
            );
                
            /*
             * Carico le informazioni del paziente
             */
            $paz = $this->Paziente->findById($paziente_id);
            
                
            /*
             * Salvo i dati del paziente nella sessione
             */
            $this->Session->write("Paziente.id", $paziente_id);
            $this->Session->write("Paziente.nome", $paz['Paziente']['cognome'] . " " . $paz['Paziente']['nome']);
			$this->Session->write("Paziente", $paz['Paziente']);
            
            /*
             * Imposto le variabili per il rendering
             */
            $this->set('paziente_id', $paziente_id);
            $this->set('paz', $paz);
        }}

?>