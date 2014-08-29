<?php
class Laboratorio extends AppModel {
	
    function incolonna (array $tabelle, array $opzioni)
    {
        $destinazione = array();
        $date = array();
        
        foreach ($tabelle as $tab) {
            $this->setSource($tab);
            
            $lab_shadow = ClassRegistry::init("lab_shadow");
            $label = $lab_shadow->find('list', array(
                'fields' => array(
                    "esame", "label"
                ),
                'conditions' => array(
                    "tabella" => $tab,
                ),
                'recursive' => 0
            ));            
            
            $etichette[$tab] = $label;
            
            /*
             * Condizioni di ricerca nelle tabelle esami di laboratorio
             */
            $conditions = array(
                "paziente_id" => $opzioni['paziente_id']
            );
            
            if ($opzioni['visita_id']!== null) $conditions['visita_id'] = $opzioni['visita_id'];
            
            $dati = $this->find('all', array('conditions' => $conditions));
            
            foreach ($dati as $num=>$info) {
                /*
                 * Faccio "salire di livello" i dati, altrimenti, ogni gruppo
                 * di informazioni è sotto un elemento "Laboratorio" dell'array
                 */
                $dati[$num] = $info['Laboratorio'];
                
                // Estraggo la data dal gruppo di informazioni
                
                $date[$dati[$num]['data']] = NULL;
                
            }
            $destinazione[$tab] = $dati;
            
        }
         
        ksort($date);

        //echo "<pre>";
        //print_r($etichette);
        //echo "</pre>";
            
                     
        $parziale = array();
        
        foreach ($destinazione as $tabid => $tab) 
        {
            foreach ($tab as $gruppo) 
            {
                $d = $gruppo['data'];
                unset($gruppo['id']);
                unset($gruppo['visita_id']);
                unset($gruppo['paziente_id']);
                unset($gruppo['data']);
                

                foreach ($gruppo as $esame => $valore)
                {
                    $parziale[$tabid][$esame][$d] = $valore;
                }
            }
            
            foreach ($parziale as $tabid => $tabella) {
                foreach ($tabella as $esameid => $esame) 
                {
                    $merge = array_merge($date, $esame);
                    $esamelabel = $esameid;
                    if (isset($etichette[$tabid][$esameid])) $esamelabel = $etichette[$tabid][$esameid];
                    $output[$tabid][$esamelabel] = $merge;

                }
            }
        }
        
        // Qualora non ci siano analisi, imposta output a NULL
        if (!isset($output)) $output = null;
        
        return (array('output' => $output, 'date' => $date));
    }
}

