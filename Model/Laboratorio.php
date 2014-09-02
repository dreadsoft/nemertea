<?php
class Laboratorio extends AppModel {
    /**
     * Aggrega dati di più tabelle esami
     * @param array $tabelle elenco tabelle da aggregare
     * @param array $opzioni opzioni di ricerca
     * @return array date, esami, etichette
     */
    
    function raccogli_esami (array $tabelle, array $opzioni)
    {
        $destinazione = array();
        $date = array();
        $etichette = array();
        
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
            
            if (isset($opzioni['visita_id'])) $conditions['visita_id'] = $opzioni['visita_id'];
            
            $options = array();
            if (isset($opzioni['order'])) $options['order'] = $opzioni['order'];
            if (isset($opzioni['limit'])) $options['limit'] = $opzioni['limit'];
            
            $options['conditions'] = $conditions;
            $dati = $this->find('all', $options);
            
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
        
        return (array(
            'date'          => $date,
            'destinazione'  => $destinazione,
            'etichette'     => $etichette
        ));
        
    }
    
    function incolonna (array $tabelle, array $opzioni)
    {
        
        $raccolta = $this->raccogli_esami($tabelle, $opzioni);
        
        $date = $raccolta['date'];
        $destinazione = $raccolta['destinazione'];
        $etichette = $raccolta['etichette'];
        
        $parziale = array();
        $lista_esami = array();
        
        foreach ($destinazione as $tabid => $tab) 
        {
            foreach ($tab as $gruppo) 
            {
                
                $d = $gruppo['data'];
                $lista_esami[$tabid][$gruppo['id']] =  $d;
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
        
        return (array('output' => $output, 'date' => $date, 'lista_esami' => $lista_esami));
    }
    

}

