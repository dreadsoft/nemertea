<?php
class FarmaciController extends AppController {

    public function index () {
        
    }
    
    public function cerca($searchstring)
    {
        $this->layout = 'ajax';
        $this->autoLayout = false;
        
        $elenco = $this->Farmaci->trova($searchstring, false, true);
        $this->set('elenco', $elenco);
    }
    
    public function aggiungiavisita ($idfarmaco) 
    {
        $visita_id = $this->Session->read("Visita.id");
        
        $farmaco = $this->Farmaci->findById($idfarmaco);
       
        
        // Inizializzo tabella terapie
        $this->loadModel('Terapie');
        $dati['Terapie'] = array(
            'visita_id'     => $visita_id,
            'farmaco_id'    => $farmaco['Farmaci']['id'],
            'farmaco_nome'    => $farmaco['Farmaci']['nome'],
            'formulazione'    => $farmaco['Farmaci']['formulazione']
        ); 
        // Salvo la terapia
        $this->Terapie->save($dati);
        
        // Redireziono a visita
        $this->redirect("/visite/apri/$visita_id");
    }  
        
        
                
}
?>