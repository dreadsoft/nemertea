<?php
class Farmaci extends AppModel {
    
    function trova ($nome = null, $codici = false, $formulazione = false)
    {
        if ($nome == null) return null;
        
        $nome = strtoupper($nome);
        $campi = array('id', 'nome');
        
        if ($formulazione === true) array_unshift ($campi, 'formulazione');
        if ($codici === true) array_unshift ($campi, 'codici');
        
        
        
        $parametri = array(
                        'fields' => $campi,
                        'conditions' => array('nome LIKE' => "%$nome%"),
                        'order' => array('nome ASC'),
                );
        
        // raggruppa per nome se non vengono richiesti codici/formulazioni
        if ($codici === false && $formulazione === false) $parametri['group'] = array('nome');

        $lista = $this->find('list', $parametri);
        
        return($lista);
    }
}
