<pre>
<?php
    // Inizializzo il form
    echo $this->Form->create(
        $tabella, array( 'url' => '/laboratorio/salva/' . $tabella)
    );
    
    // Campi inserimento data esame
    echo "<div class=\"form-inline form-group text-right\">";
    echo $this->Form->input('data', array('label' => ''));
    echo "</div>";
    echo "<hr>";   
     echo $this->Form->inputs(
                array (
                "id" => array('type' => 'hidden'),
                "paziente_id"   => array('type' => 'hidden'),
                "visita_id"     => array('type' => 'hidden')
                )
            );
    

    if ($tabella == "emogasanalisi") {
    /**
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * MODIFICA EMOGAS
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */

        echo "<div class=\"row col-md-12\">";
            echo "<div class=\"col-md-4\">";
            echo $this->Form->inputs(
                    array(
                'po2'           => array('label' => "pO2"), 
                'pco2'          => array('label' => "pCO2"),
                'ph'            => array('label' => "pH"),
                'hco3'          => array('label' => "HCO3-"),
                'so2'           => array('label' => "sO2(%)"),
                'fio2'          => array('label' => "FiO2")
                )
            );
            echo "</div>";

            echo "<div class=\"col-md-4\">";
            echo $this->Form->inputs(
                array (
                'lattati'       => array('label' => "Lattati"),
                'eccessobasi'   => array('label' => "Eccesso basi"),                
                'glucosio'      => array('label' => "Glucosio"),
                'sodio'         => array('label' => "Sodio"),
                'potassio'      => array('label' => "Potassio"),
                'cloro'         => array('label' => "Cloro"),
                'calcio'        => array('label' => "Calcio")
                )
            );
            echo "</div>";

            echo "<div class=\"col-md-4\">";
            echo $this->Form->inputs(
                array (
                'hb'           => array('label' => "Hb"),
                'o2hb'         => array('label' => "O2Hb"),
                'co2hb'        => array('label' => "CO2Hb"),
                'methb'        => array('label' => "MetHb"),
                'hhb'          => array('label' => "HHb")
                )
            );

            echo "</div>";

        echo "</div>";
    }
    else {
        /**
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         * MODIFICA ESAME DI LABORATORIO GENERICO
         * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
         */

        $schema = array_slice($schema, 4);
        foreach ($schema as $esame) {
            $etichetta = strtoupper($esame);
            if (isset($label[$esame])) {
                $etichetta = $label[$esame];
                
            }
            echo $this->Form->input($esame, array('label' => $etichetta));
            
        }
        
        // print_r($schema);
        // print_r($label);
        
        
    }
    
    
    echo $this->Form->end();
?>





<?php
// print_r($contenuto);
?>
</pre>