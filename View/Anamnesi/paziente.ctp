<h2>Anamnesi</h2>

<?php

$dati = $ana['Anamnesi'];


/**
 * Diagnosi principale
 */
echo $this->BS->panel('Diagnosi principale', $dati['diagnosi_principale'], 'primary');

/**
 * Anamnesi familiare
 */
echo $this->BS->panel('Anamnesi familiare', $dati['familiare'], 'primary');


/**
 * Anamnesi fisiologica
 */
$fisiologica  = "<div class=\"well\">" . $dati['fisiologica'] . "</div>";
$fisiologica .= '<dl class="dl-horizontal well">';
$fisiologica .= '<dt>Fumo</dt>';
$fisiologica .= "<dd>{$dati['fumo']}</dd>";
$fisiologica .= '<dt>Sigarette/die</dt>';
$fisiologica .= "<dd>{$dati['fumo_sigarette']}</dd>";
$fisiologica .= '<dt>Durata</dt>';
$fisiologica .= "<dd>{$dati['fumo_anni']}</dd>";
$fisiologica .= '<dt>Pack/year</dt>';
$fisiologica .= "<dd>{$dati['fumo_packyear']}</dd>";
$fisiologica .= '<dt>Unit&agrave; alcoliche</dt>';
$fisiologica .= "<dd>{$dati['alcol_unita']}</dd>";
$fisiologica .= '<dt>Alvo</dt>';
$fisiologica .= "<dd>{$dati['alvo']}</dd>";
$fisiologica .= '<dt>Diuresi</dt>';
$fisiologica .= "<dd>{$dati['diuresi']}</dd>";
$fisiologica .= '<dt>Allergie</dt>';
$fisiologica .= "<dd>{$dati['allergie']}</dd>";
$fisiologica .= "</dl>";

echo $this->BS->panel("Anamnesi fisiologica", $fisiologica, 'primary');


/**
 * Anamnesi patologica
 */
$patologica = "";

$patologica .= "<dl class=\"dl-horizontal \">";
foreach ($eventi as $i => $e) {
    $dataevento = $this->Time->format($e['data'], "%d/%m/%Y");
    $patologica .= "<dt class=\"well well-sm\">" . $dataevento . "</dt>";
    $patologica .= "<dd class=\"well well.sm\">" . "<strong id=\"evento_descrizione_{$e['id']}\">" . $e['evento'] . "</strong>";
    if (isset($e['descrizione'])) $patologica .= "<br><small class=\"muted\">" . $e['descrizione']  . "</small>";
    if (isset($e['icd9cm'])) $patologica .= " [" . $e['icd9cm'] . "]";
    $patologica .= "<div class=\"text-right\">";
    $patologica .= " <button type='button' class='btn btn-warning btn-xs' title='Modifica' onclick=\"anamnesievento_modifica('{$e["id"]}')\">";
    $patologica .= "<i class='fa fa-pencil'></i></button>";
    $patologica .= " <button type='button' class='btn btn-danger btn-xs' title='Elimina' onclick=\"anamnesievento_elimina('{$e["id"]}')\">";
    $patologica .= "<i class='fa fa-times'></i></button>";
    

    
    $patologica .="</div>";
    $patologica .= "</dd>";
}
$patologica .= "</dl>";

$patologica .= "<div style=\"text-align:right\">";
$patologica .= '<button class="btn btn-primary" id="aggiungieventobutton" data-toggle="modal" data-target="#eventoanamnesimodal">';

$patologica .= '<i class="fa fa-plus"> </i> Aggiungi evento</button>';    
$patologica .= "</div>";
echo $this->BS->panel("Anamnesi patologica", $patologica, 'primary');



?>

<div class="modal fade" id="eventoanamnesimodal" tabindex="-1" role="dialog" aria-labelledby="eventoanamnesilabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="eventoanamnesilabel">Nuovo evento anamesi</h4>
            </div>
            <div class="modal-body">
                
                <?php
                    echo $this->Form->create('Anamnesievento', array('type' => 'post', 'action' => '', 'default' => false));
                    echo $this->Form->input('paziente_id', array('type' => 'hidden', 'value' => $paziente_id));
                    echo $this->Form->input('anamnesi_id', array('type' => 'hidden', 'value' => $paziente_id));
                    
                    echo "<div class=\"form-inline\">";
                    echo $this->Form->input('data');
                    echo "</div>";
                    echo $this->Form->input('evento');
                    echo $this->Form->input('descrizione');
                    
                    echo $this->Form->input('icd9cm');
                    
                    echo $this->Form->end();
                    echo "<div id=\"eventocreaoutput\">####</div>";
                ?>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="anamnesievento_click_cancella();">Cancella</button>
                <button type="button" class="btn btn-primary" onclick="anamnesievento_click_salva();">Salva</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
       
    function anamnesievento_click_cancella()   {
        $('#AnamnesieventoForm')[0].reset();
        $('#eventocreaoutput').html('').removeAttr("class");
        
    }
    
    
    function anamnesievento_click_salva() 
    {
        /*
         * VALIDAZIONE FORM
         */
        // Elimina qualsiasi classe all'inizio della funzione
        $('#eventocreaoutput').removeAttr("class");

        var evento = $("#AnamnesieventoEvento").val();

        if (evento == "") {
            $('#eventocreaoutput').html("Definire un evento").addClass("alert alert-danger");
            return;
        }

        /*
         * INVIO DEL FORM
         */

       $.ajax(
               {    async:false, 
                    data:$("#AnamnesieventoForm").serialize(), 
                    dataType:"html", 
                    success:function (data, textStatus) {$("#eventocreaoutput").html(data).addClass("alert alert-info");}, 
                    type:"POST", 
                    url:"\/anamnesieventi/crea"}
        );
        
        
       location.reload();
    }
    
    function aggiorna_patologica () 
    {
        
    }
    
    function anamnesievento_elimina (idevento){
        desc = $('#evento_descrizione_' + idevento).html();
        if (confirm("Eliminare dall'anamnesi l'evento \"" + desc + '" ?')) {
            $.ajax(
               {    async:false, 
                    dataType:"html", 
                    success:location.reload(), 
                    type:"POST", 
                    url:"\/anamnesieventi/elimina/" + idevento}
                );
        
        }
        
    }
    
    function anamnesievento_modifica (idevento)
    {
        alert('Funzione al momento non disponibile!');
    }
    

</script>