<?php
class VisiteController extends AppController {

	public function index () 
	{
            
	}
	
	public function nuova ($paziente_id = null)
	{
            if ($paziente_id == null) return $this->redirect('/visite/index');
            $this->set ('paziente_id', $paziente_id);
            
            $this->loadModel('Tipovisita');
            $tipi = $this->Tipovisita->find(
                        'list', 
                        array('fields' => array(
                            "Tipovisita.id", 
                            "Tipovisita.descrizione"
                            )
                        )   
                    );
            
            $this->set('tipovisita', $tipi);
	}
        
        function modifica ()
        {
            $dati = $this->request->data;
            $this->set('dati', $dati);
            $this->Visita->save($dati);
            
            $lastid = $dati['Visita']['id'];
            if ($lastid == null) $lastid = $this->Visita->getInsertID();
            
            return $this->redirect('/visite/apri/' . $lastid);
          
        }
        
        function elenco ($paziente_id) 
        {
            $this->loadModel('Tipovisita');
            $tipi = $this->Tipovisita->find(
                        'list', 
                        array('fields' => array(
                            "Tipovisita.id", 
                            "Tipovisita.descrizione"
                            )
                        )   
                    );
            
            $this->set('tipovisita', $tipi);
            
            
            $visite = $this->Visita->find('all', array(
                'conditions' => array('Visita.paziente_id' => $paziente_id),
                'order' => 'Visita.data_visita DESC',
            ));            
            
            $this->set('visite', $visite);
        }
        
        function ultime($paziente_id = null, $limite = 5) 
        {
            if ($paziente_id == null) return null;
            
            $ultime_visite = $this->Visita->find('all', array(
                'conditions' => array('Visita.paziente_id' => $paziente_id),
                'fields' => array('Visita.data_visita', 'Visita.id'),
                'order' => 'Visita.data_visita DESC',
                'limit' => $limite
            ));
            
            $this->layout = 'ajax';
            $this->autoLayout = false;
            $this->set("paziente_id", $paziente_id);
            $this->set("ultime_visite", $ultime_visite);
        }
        
        function apri ($id = null)
        {
            
           $this->data = $this->Visita->findById($id);
           $this->Session->write('Paziente.id', $this->data['Paziente']['id']);
           $this->Session->write('Paziente.nome', 
                   $this->data['Paziente']['cognome'] . " " . 
                   $this->data['Paziente']['nome'] 
           );
           
           $this->Session->write('Visita.id', $this->data['Visita']['id']);
           
            $this->loadModel('Indagine');
            
            // -----------------------------------------------------------------
            // Pulsante indagini di laboratorio
            // -----------------------------------------------------------------
            $indagini_laboratorio = $this->Indagine->find('list', array(
                'fields' => array('Indagine.tabella', 'Indagine.nome'),
                'conditions' => array('Indagine.attiva' => '1', 'Indagine.tipo' => 'laboratorio'),
            ));
            asort($indagini_laboratorio);
            
            $pulsante_laboratorio = "";
            foreach ($indagini_laboratorio as $tab => $indagine) {
                $pulsante_laboratorio .= "<li><a href=\"#\" onclick=\"aggiungiIndagineDiLaboratorio('$tab')\">$indagine</a></li>";
            }
            
            $this->set ('pulsante_laboratorio', $pulsante_laboratorio);

            // -----------------------------------------------------------------
            // Pulsante indagini strumentali
            // -----------------------------------------------------------------
            $indagini_strumentali = $this->Indagine->find('list', array(
                'fields' => array('Indagine.tabella', 'Indagine.nome'),
                'conditions' => array('Indagine.attiva' => '1', 'Indagine.tipo' => 'strumentale'),
            ));
            asort($indagini_strumentali);
            
            $pulsante_strumentali = "";
            foreach ($indagini_strumentali as $tab => $indagine) {
                $pulsante_strumentali .= "<li><a href=\"#\" onclick=\"aggiungiIndagineStrumentale('$tab')\">$indagine</a></li>";
            }
            $this->set('pulsante_strumentali', $pulsante_strumentali);
            
            // -----------------------------------------------------------------
            // Pulsante indagini radiologia
            // -----------------------------------------------------------------
            $indagini_radiologia = $this->Indagine->find('list', array(
                'fields' => array('Indagine.tabella', 'Indagine.nome'),
                'conditions' => array('Indagine.attiva' => '1', 'Indagine.tipo' => 'radiologia'),
            ));
            asort($indagini_radiologia);
            
            $pulsante_radiologia = "";
            foreach ($indagini_radiologia as $tab => $indagine) {
                $pulsante_radiologia .= "<li><a href=\"#\" onclick=\"aggiungiIndagineRadiologia('$tab')\">$indagine</a></li>";
            }
            $this->set('pulsante_radiologia', $pulsante_radiologia);
            
            
            
            
            $this->set('indagini_laboratorio', $indagini_laboratorio);
            $this->set('indagini_strumentali', $indagini_strumentali);
            $this->set('indagini_radiologia', $indagini_radiologia);
            
            
        }
        
        function elimina($id_visita = null) 
        {
            $this->layout = 'ajax';
            $this->autoLayout = false;
            $this->autoRender = false;
            $this->Visita->delete($id_visita, false);
            $paziente_id = $this->Session->read('Paziente.id');
            $this->redirect("/visite/elenco/$paziente_id");
        }
}
?>