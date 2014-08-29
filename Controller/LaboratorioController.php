<?php
class LaboratorioController extends AppController {

	public function index () {
            $this->Session->delete("Paziente");
	}
        
        /**
         * Modifica una tabella analisi di laboratorio
         * 
         * @param string $tabella Nome della tabella da modificare
         * @param string $id ID dell'esame da modificare
         */
        function modifica ($tabella = null, $id = null)
        {
            $this->layout = 'ajax';
            $this->autoLayout = false;
            $tabmodel = ClassRegistry::init($tabella);
            
            if ($id != null) {
                $contenuto = $tabmodel->findById($id);
                $this->request->data = $contenuto;
            }
            else {
                $contenuto = "";
                $schema = $tabmodel->getColumnTypes();
                $this->set('schema', array_keys($schema));
                
                $lab_shadow = ClassRegistry::init("lab_shadow");
                $label = $lab_shadow->find('list', array(
                    'fields' => array(
                        "esame", "label"
                    ),
                    'conditions' => array(
                        "tabella" => $tabella,
                    ),
                    'recursive' => 0
                ));
                $this->set("label", $label);
               
            }
            
                        
            $this->set('contenuto', $contenuto);
            $this->set('tabella', $tabella);
        }
        
        /**
         * Salva i dati di un esame di laboratorio
         * @param string $tabella Tabella di destinazione
         */
        function salva ($tabella = null)
        {
            
            $this->layout = 'ajax';
            $this->autoLayout = false;
            
            try {
               $tabmodel = ClassRegistry::init($tabella);
            }
            catch (CakeException $e) {
                
                echo $e->getMessage();
            }
            $dati = $this->request->data;
            
            $dati[$tabella]['paziente_id'] = $this->Session->read("Paziente.id");
            $dati[$tabella]['visita_id'] = $this->Session->read("Visita.id");
            
            if ($tabmodel->save($dati)) {
                $this->set('success', "Salvataggio eseguito con successo");
            }
            else {
                
                $this->set('success', "Errore nel salvataggio");
            }
        }
        
        /**
         * Mostra le analisi in un blocco orizzontale (i campi analisi sono gli header della tabella)
         * @param string $tabella Tablella dell'esame di laboratorio
         */
        function vista_blocco ($tabella = null) 
        {
            $paziente_id = $this->Session->read("Paziente.id");
            $visita_id = $this->Session->read("Visita.id");
            
            $this->layout = 'ajax';
            $this->autoLayout = false;
            
            $tabmodel = ClassRegistry::init($tabella);            
            
            $elenco= $tabmodel->find('all', array(
                'conditions' => array(
                    'paziente_id' => $paziente_id,
                    'visita_id' => $visita_id
                    ),
                'recursive' => "0"
                )
            );
            
            $pretable = array();
            
            foreach($elenco as $index) {
                $pretable[] = $index[$tabella];
            }
            
            $this->set('tabella', $tabella);
            $this->set('pretable', $pretable);
        }
        
        /**
         * Integra più esami di laboratorio in una lista a colonne, gli esami vengono
         * incolonnati per data, ogni riga contiene un esame di laboratorio
         * @param array $colonne
         * @param array $opzioni
         */
        function vista_colonne ($visita_id = null) 
        {
            $this->layout = 'ajax';
            $this->autoLayout = false;
            
            
            /*
             * ------------------------------------------
             * Tabelle da caricare
             * ------------------------------------------
             */
            $this->loadModel('Indagine');
            $indagini_laboratorio = $this->Indagine->find('list', array(
                'fields' => array('Indagine.tabella', 'Indagine.nome'),
                'conditions' => array('Indagine.attiva' => '1', 'Indagine.tipo' => 'laboratorio'),
            ));
            asort($indagini_laboratorio);
            
            // Elimino emogasanalisi dalle analisi di laboratorio
            unset($indagini_laboratorio['emogasanalisi']);
            
            // Servono solo gli identificativi delle tabelle
            $tabelle = array_keys($indagini_laboratorio);
            
            
            /*
             * --------------------------------------------------
             * Impostazione richiesta al modello
             * --------------------------------------------------
             */
            $paziente_id = $this->Session->read("Paziente.id");
            
            $opzioni = array(
                'paziente_id'   => $paziente_id,
                'visita_id'     => $visita_id
            );
            
            // Se id visita non specificato, richiedi analisi dell'ultimo anno
            if ($visita_id === null) {
                App::uses('CakeTime', 'Utility');
                $anno_scorso = CakeTime::fromString("-1 year");
                $opzioni['da'] = CakeTime::format($anno_scorso, "%Y-%m-%d");
                $opzioni['a'] = CakeTime::format(time(), "%Y-%m-%d");
            }
            
            $dati = $this->Laboratorio->incolonna($tabelle, $opzioni);
            
            /*
             * --------------------------------------------------
             * Elaborazione dati
             * --------------------------------------------------
             */

            
            /*
             * --------------------------------------------------
             * Invio dati alla view
             * --------------------------------------------------
             */
            $this->set('dati', $dati);
        }
}
?>