<?php
$data_visita = $this->Time->format($this->data['Visita']['data_visita'], "%d/%m/%Y");
echo "<h2>";
echo $data_visita;
echo "<span class=\"pull-right\">";
echo "<a title=\"Elimina\" onclick=\"elimina_visita({$this->data['Visita']['id']});\"><i class=\"fa fa-times\"></i></a>";
echo "</span>";
echo "</h2>";

?>


<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA DIARIO CLINICO
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->

<?php

    $diario  = $this->Form->create('Visita', array('type' => 'post', 'action' => 'modifica', 'id' => 'diario_clinico'));
    $diario .= $this->Form->input("id");
    $diario .= $this->Form->input("diario_clinico", array("label" => ""));
    
    $diario .= "<div class=\"text-right col-md-offset-8\">";
    $diario .= $this->Form->input("effettuata_da", array("label" => ""));
    $diario .= '<button class="btn btn-small btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Salva diario</button>' . "</div>";
    echo $this->BS->panel("Diario clinico", $diario, "default");
?>

<div class="well text-center">
    
<div class="btn-group">
    <button class="btn navbar-btn btn-default" onclick="aggiungi_eventoanamnesi()" title="Aggiornamento anamnestico">
        <i class="fa fa-th-list"></i> Anamnesi
    </button>
    
    <button class="btn navbar-btn btn-default" title="Parametri / Esame obiettivo">
        <i class="fa fa-male"></i> Parametri
    </button>
    
    
    <div class="btn-group">
    <button type="button" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-flask"></i>
      Esami di laboratorio <span class="caret"></span>
    </button>
        <ul class="dropdown-menu text-left" role="menu" id="listaEsamiDiLaboratorio">
            <?php echo $pulsante_laboratorio; ?>
        </ul>
    </div>

    <div class="btn-group">
    <button type="button" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-dashboard"></i>
      Es. strumentali <span class="caret"></span>
    </button>
        <ul class="dropdown-menu text-left" role="menu" id="listaEsamiStrumentali">
            <?php echo $pulsante_strumentali; ?>
        </ul>
    </div>
    
    <div class="btn-group">
    <button type="button" class="btn navbar-btn btn-default dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-lightbulb-o"></i> 
        Radiologia <span class="caret"></span>
    </button>
        <ul class="dropdown-menu text-left" role="menu" id="listaEsamiRadiologia">
            <?php echo $pulsante_radiologia; ?>
        </ul>
    </div>
    
</div>
</div>

<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA ESAMI DI LABORATORIO 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div id="areaEsamiDiLaboratorio">
    <h3 class="sezione">Esami di laboratorio</h3>
</div>


<script>
    $.get( "/laboratorio/vista_blocco/emogasanalisi", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio');});
    $.get( "/laboratorio/vista_colonne/<?php echo $this->data['Visita']['id'] ?>", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio');});
</script>
<?php



foreach ($indagini_laboratorio as $indagine) {
    
    // echo  $this->BS->panel(ucfirst($indagine), "", 'success', strtolower($indagine));
    // $indagine = strtolower($indagine);
    // if ($indagine !== "emogasanalisi") $indagine = "lab_" . $indagine;
    // echo "\n<script>$.get( \"/laboratorio/vista_blocco/{$indagine}\", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio')})</script>";

}
?>


<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA ESAMI STRUMENTALI
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div id="areaEsamiStrumentali"> 
    <h3 class="sezione">Esami strumentali</h3>
</div>


<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA TERAPIA
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div id="areaTerapia"> 
    <h3 class="sezione">Terapia</h3>
    <div class="form-group form-inline">
        <input type="text" class="form-control" id="stringaTerapia" placeholder="Aggiungi terapia">
        <button class="btn btn-default" onclick="cerca_terapia(); return false;"><i class="fa fa-fw fa-plus"></i></button>
    </div> 
    
    <div id="elencoFarmaciVisita">
        
    </div>
    
    <script>
        $.get( "/terapie/elencoFarmaciVisita", function(data) { $(data).appendTo('#elencoFarmaciVisita');});
    </script>
</div>

<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
MODAL MULTIUSO
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->

<div class="modal fade" id="VGM">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="VGM_title">Modal title</h4>
      </div>
      <div class="modal-body" id="VGM_body">
        <p>One fine body&hellip;</p>
      </div>
        
        <div class="text-right modal-footer" id="VGM_footer">
            <button id="VGM_invia_button" class="btn btn-success" onclick="VGM_invia_button_click(); return(false);">Salva</button>
            <br><br>
            <div class="alert alert-warning" id="VGM_output"></div>
            
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function aggiungi_eventoanamnesi (idevento) 
    {
        $('#VGM_title').html("Aggiungi evento anamnestico");
        
        $.ajax(
        {    async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#VGM_body").html(data);}, 
             type:"POST", 
             url:"\/anamnesieventi/modifica/" + idevento}
        );
        $('#VGM').modal('show');
    }
    
    function aggiungiIndagineStrumentale (tabella) 
    {
       alert(tabella);
    }
    
    function aggiungiIndagineDiLaboratorio (tabella) 
    {
        $('#VGM_title').html("Aggiungi indagini di laboratorio");
        
        $.ajax(
            {
             async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#VGM_body").html(data);}, 
             type:"POST", 
             url:"\/laboratorio/modifica/" + tabella
            }
        );
        
        
        $('#VGM').modal('show');        
        
        // alert(tabella);
    }
    
    function aggiungiIndagineRadiologia (tabella) 
    {
        alert(tabella);
    }
    
     
    function VGM_invia_button_click ()
    {
        formid = $("#VGM_body form").attr('id');
        shortname = formid.substr(0, (formid.length - 12));
        ajaxurl = "\/laboratorio/salva/" + shortname;
       
        if (formid === "AnamnesieventoForm")        ajaxurl = "\/anamnesieventi/crea";
        if (formid === "TerapieSalvaForm")			ajaxurl = "/terapie/salva/" + $("#TerapieId").val();
		
		
        
        $.ajax(
            {    async:false, 
                 data:$("#" + formid).serialize(), 
                 dataType:"html", 
                 success:function (data, textStatus) {$("#VGM_output").html(data);}, 
                 type:"POST", 
                 url: ajaxurl
             }
        );
		
		// inserire qui le opzioni di caricamento/redirezionamento pagina
		if (formid === "TerapieSalvaForm") window.location = "/visite/apri/<?php echo $this->Session->read('Visita.id'); ?>#areaTerapia";
		
		// altrimenti ricarica la pagina
		window.reload();
    }
    
    function elimina_visita(id_visita)
    {
        if (confirm("Eliminare la scheda visita corrente?")) {
            window.location = "/visite/elimina/" + id_visita;
        }
    }
    
    function modificaEsameDiLaboratorio(tabella, id) 
    {
        $('#VGM_title').html("Modifica indagini di laboratorio");
        
        $.ajax(
            {
             async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#VGM_body").html(data);}, 
             type:"POST", 
             url:"\/laboratorio/modifica/" + tabella + "/" + id
            }
        );
        $('#VGM').modal('show');      
    }
   
    function cerca_terapia ()
    {
        $('#VGM_title').html("Cerca terapia");
        ricerca = $('#stringaTerapia').val();
        if (ricerca === "") {
            alert("Inserire il farmaco da cercare");
            return (false);
        }    
            
            
        $.ajax(
            {
             async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#VGM_body").html(data);}, 
             type:"POST", 
             url:"/farmaci/cerca/" + ricerca
            }
        );
		$('#VGM_invia_button').hide();
        $('#VGM').modal('show');      
    }
    
    function modificaTerapia (idterapia) {
        $('#VGM_title').html("Modifica terapia");
        
        $.ajax(
        {    async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#VGM_body").html(data);}, 
             type:"POST", 
             url:"\/terapie/modifica/" + idterapia}
        );
        $('#VGM').modal('show');
    }
    
    function eliminaTerapia (idterapia) {
		if (confirm("Eliminare la prescrizione ?")) {
			window.location = "/terapie/elimina/" + idterapia;
		}
    }
    

</script>