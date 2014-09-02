<?php

if (count($fvc) > 0) {
    

    $out = "<table class='table table-bordered table-condensed'>";
    
    /*
     * Headers
     */
    $headers = array(   "Data", "FVC", "FVC<br>(%)", 'FEV1', 'FEV1<br>(%)', 'FEV1/FVC',  
                        "FEV1<br>post", '&Delta;FEV1<br>(ml)', '&Delta;FEV1<br>(%)', "&nbsp;");
    $out .= $this->Html->tableHeaders($headers, null, array('class' => 'text-center'));
    
    /*
     * Celle
     */
    
    foreach ($fvc as $i) 
    {
        $data = CakeTime::format($i['Fvc']['data'], "%d-%m-%Y");

        
        $azioni  = "<button class=\"btn btn-xs btn-warning\" title='modifica' onclick=\"modificaIndagineStrumentale('fvc', '{$i['Fvc']['id']}')\">";
        $azioni .= "<i class= 'fa fw fa-pencil'></i>";
        $azioni .= "</button>&nbsp;";
        
        $azioni .= "<button class='btn btn-xs btn-danger' title='elimina' onclick=\"eliminaIndagineStrumentale('fvc', {$i['Fvc']['id']})\">";
        $azioni .= "<i class= 'fa fw fa-times'></i>";
        $azioni .= "</button>";
        
        // Analisi incremento FEV1 in ml
        if ($i['Fvc']['fev1incpostml'] >= 200) {
            $i['Fvc']['fev1incpostml'] = $this->BS->badgize($i['Fvc']['fev1incpostml'], 'success');
        } else {
            $i['Fvc']['fev1incpostml'] = $this->BS->badgize($i['Fvc']['fev1incpostml'], 'danger');
        }
        
        // Analisi incremento FEV1 in percentuale
        if ($i['Fvc']['fev1incpostpc'] >= 12) {
            $i['Fvc']['fev1incpostpc'] = $this->BS->badgize($i['Fvc']['fev1incpostpc'], 'success');
        } else {
            $i['Fvc']['fev1incpostpc'] = $this->BS->badgize($i['Fvc']['fev1incpostpc'], 'danger');
        }
        
        // Analisi rapporto FEV1/FVC
        if ($i['Fvc']['fev1fvc'] <  80)  $i['Fvc']['fev1fvc'] = $this->BS->badgize ($i['Fvc']['fev1fvc'], 'danger');
        
        $riga = array(
            $data, 
            $i['Fvc']['fvc'],
            $i['Fvc']['fvcpc'],
            $i['Fvc']['fev1'],
            $i['Fvc']['fev1pc'],
            $i['Fvc']['fev1fvc'],
            $i['Fvc']['fev1post'],
            $i['Fvc']['fev1incpostml'],
            $i['Fvc']['fev1incpostpc'],
            $azioni
            );
        
        $out .= $this->Html->tableCells(
                    $riga, 
                    array('class' => 'text-center'),
                    array('class' => 'text-center')
        );
    }
    
    
    $out .= "</table>";
    
    $titolo = "<strong>Capacit&agrave; vitale forzata</strong>";
    echo $this->BS->panel($titolo, $out, "yellow");  
}

    
?>

