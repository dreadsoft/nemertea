<?php
class Laboratorio extends AppModel {
	
    function incolonna (array $tabelle, array $opzioni)
    {
        $destinazione = array();
        $date = array();
        
        foreach ($tabelle as $tab) {
            $this->setSource($tab);
            
            $conditions = array(
                "paziente_id" => $opzioni['paziente_id']
            );
            
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
        
                     
        $output = array();
        
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
                    $output[$tabid][$esame][$d] = $valore;
                }
            }
            
            foreach ($output as $tabid => $tabella) {
                foreach ($tabella as $esameid => $esame) 
                {
                    $merge = array_merge($date, $esame);
                    $output[$tabid][$esameid] = $merge;
                }
            }
        }
        
        return (array('output' => $output, 'date' => $date));
    }
}

