<?php
class AnamnesiController extends AppController {

	public function index () {
            /*
             * In caso l'id del paziente non fosse definito
             */
            $this->Session->delete("Paziente");
	}
	
       
	public function paziente ($paziente_id = null) {
            
		/**
		 * Escludere che il paziente non sia null
		 */
		if ($paziente_id == null) return $this->redirect('/anamnesi/index');
                
		/**
		 * Se l'id del paziente è definito, memorizzo in sessione
		 */
		$this->Session->write('Paziente.id', $paziente_id);

		/**
		 * Recupero dati
		 */
		$anamnesi = $this->Anamnesi->find('first', array(
		'conditions' => array('Anamnesi.paziente_id' => $paziente_id)
		));
			
		
		/**
		 * Controllo esistenza anamnesi
		 */
		if (!isset($anamnesi['Anamnesi'])) {
			return $this->redirect('/anamnesi/inserisci');
		}
		
		/**
		 * In caso di esistenza, crea la view con i dati
		 */
		if (isset($anamnesi['Anamnesi'])) {

                        
                        /**
                         * Decodifico la diagnosi principale
                         */
                        $this->loadModel('CodDiagnosiPrincipale');
                        $dia= $this->CodDiagnosiPrincipale->find('first', 
                            array(
                                'fields' => array('nome'),
                                'conditions' => array("CodDiagnosiPrincipale.id" => $anamnesi['Anamnesi']['diagnosi_principale'])
                            )
                        ); 
                        
                        $anamnesi['Anamnesi']['diagnosi_principale'] = $dia['CodDiagnosiPrincipale']['nome'];
                        // print_r($anamnesi);
                        
			/**
			 * Impostazioni variabili per la view
			 */
			$this->set('ana', $anamnesi);                        
			$this->set('paz', $anamnesi['Paziente']);
                        $this->set('paziente_id', $paziente_id);

			/**
			 * Memorizzazzione nome del paziente in sessione
			 */
			$this->Session->write("Paziente", $anamnesi['Paziente']);                        
                        $this->eventi($paziente_id);
		}
                               
	}
	
	public function inserisci ($paziente_id = null) {
            if ($paziente_id == null) {
                $this->set("paziente_id", $this->Session->read("Paziente.id"));
            }
            else {
                $this->set('paziente_id', $paziente_id);
            }
		
                
                // Diagnosi principale *****************************************
		$this->loadModel('CodDiagnosiPrincipale');
		$cod = $this->CodDiagnosiPrincipale->find(  'all', 
                    array('fields' => array('codice', 'nome')
                    )
                );
		
		$cod_diagnosi = array();
		foreach ($cod as $index => $val) {
			$codice = $val['CodDiagnosiPrincipale']['codice'];
			$nome = $val['CodDiagnosiPrincipale']['nome'];
			$cod_diagnosi[$codice] = $nome;
		}
                
		$this->set('diagnosi_principale', $cod_diagnosi);

                // Caricamento dati paziente, se esistenti *********************
                $anamnesi = $this->Anamnesi->find('first', array(
		'conditions' => array('Anamnesi.paziente_id' => $paziente_id)
		));
                
                $this->data = $anamnesi;
                
                

	}

	public function modifica() {
            $anamnesi = $this->request['data']['Anamnesi'];
            
            $anamnesi['fumo_packyear'] = ($anamnesi['fumo_sigarette'] * $anamnesi['fumo_anni'] / 20);
            $this->Anamnesi->save($anamnesi);
            
            $this->set('anamnesi', $anamnesi);
			$this->redirect("/anamnesi/paziente/" . $anamnesi['paziente_id']);
	}
        
        
        public function eventi ($paziente_id, $dettaglio = 'estesa')
        {
		$dati = $this->Anamnesi->find('first', array(
		'conditions' => array('Anamnesi.paziente_id' => $paziente_id),
		));
                
            $eventi = array();

            if ($dettaglio == "estesa") {
                $eventi = $dati['Anamnesievento'];
            }
            
            if ($dettaglio == "compatta") {
                foreach ($dati['Anamnesievento'] as $i =>$val) {
                   unset($dati['Anamnesievento'][$i]['icd9cm']);
                   unset($dati['Anamnesievento'][$i]['descrizione']);
                }
                
                $eventi = $dati['Anamnesievento'];
            }
            
            
            $this->set('eventi', $eventi);                
               
            
            
            // $info = $this->Anamnesieventi->info($paziente_id, $dettaglio);
            // return($info);
         }
	

}
?>