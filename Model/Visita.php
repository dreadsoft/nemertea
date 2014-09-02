<?php
class Visita extends AppModel {
    public $belongsTo = 'Paziente';

    function precedente ($id_visita)
    {

        $attuale = $this->findById($id_visita);
        $paziente_id = $attuale['Visita']['paziente_id'];

        // prendo le visite ordinate per data
        $ultime_visite = $this->find('list', array(
            'conditions' => array('Visita.paziente_id' => $paziente_id),
            'fields' => array('Visita.id'),
            'order' => 'Visita.data_visita DESC',
        ));

        /*
         * Trattengo solo gli ID (l'array è già ordinato per data)
         * 
         */
        $lista = array_values($ultime_visite);

        /*
         * Trovo la posizione in graduatoria della visita
         */
        $posizione_attuale = array_search($id_visita, $lista);

        // Se esiste un elemento successivo nell'array, è l'ID della visita precedente
        if (isset($lista[$posizione_attuale + 1])) {

            return($lista[$posizione_attuale + 1]);
        }
        else {
            return null;
        }
    }
}
?>