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
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-fw fa-book"></i>&nbsp;&nbsp;Diario clinico
		<div class="pull-right">
                    <button class="btn btn-default btn-xs" onclick="aggiungi_eventoanamnesi()" title="Aggiornamento anamnestico">
                        <i class="fa fa-fw fa-th-list"></i>&nbsp;&nbsp;Inserisci evento anamnesi
                    </button>
		</div>	
		</h3>
	</div>
	<div class="panel-body">
            <?php

                $diario  = $this->Form->create('Visita', array('type' => 'post', 'action' => 'modifica', 'id' => 'diario_clinico'));
                $diario .= $this->Form->input("id");
                $diario .= $this->Form->input("diario_clinico", array("label" => ""));

                $diario .= "<div class=\"pull-right text-right col-md-6\">";
                $diario .= $this->Form->input("effettuata_da", array("label" => ""));
                $diario .= '<button class="btn btn-primary" type="submit"><i class="fa fa-fw  fa-floppy-o"></i> Salva diario</button>' . "</div>";
                echo $diario;
            ?>
		
	</div>
</div>	

<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA ESAMI DI LABORATORIO 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
	
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-fw fa-flask"></i>&nbsp;&nbsp;Esami di laboratorio
		<div class="pull-right">
                    
                    <a class="btn btn-default btn-xs" title="Parametri" href="#" onclick="aggiungiIndagineDiLaboratorio('lab_parametri')">
                        <i class="fa fa-fw fa-male"></i> Parametri
                    </a>
                    
			<div class="btn-group">
                            
                            <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                              <i class="fa fa-fw fa-plus"></i>&nbsp;Inserisci&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu text-left" role="menu" id="listaEsamiDiLaboratorio">
                                    <?php echo $pulsante_laboratorio; ?>
                            </ul>
			</div>
			<div class="btn-group">
                            
                            <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                              <i class="fa fa-fw fa-pencil"></i>&nbsp;Modifica&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" id="esamiLaboratorioVisita">
                                    
                            </ul>
			</div>			

		</div>	
		</h3>
	</div>
	<div class="panel-body">
		<div id="areaEsamiDiLaboratorio"></div>
	</div>
</div>	


<script>
    $.get( "/laboratorio/vista_blocco/emogasanalisi", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio');});
    $.get( "/laboratorio/vista_colonne/<?php echo $this->data['Visita']['id'] ?>", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio');});
</script>
<?php
/*
    foreach ($indagini_laboratorio as $indagine) {
        echo  $this->BS->panel(ucfirst($indagine), "", 'success', strtolower($indagine));
        $indagine = strtolower($indagine);
        if ($indagine !== "emogasanalisi") $indagine = "lab_" . $indagine;
        echo "\n<script>$.get( \"/laboratorio/vista_blocco/{$indagine}\", function(data) { $(data).appendTo('#areaEsamiDiLaboratorio')})</script>";
    }
*/
?>


<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA ESAMI STRUMENTALI
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-fw fa-dashboard"></i>&nbsp;&nbsp;Esami strumentali
		<div class="pull-right">
                    <div class="btn-group">
                    <button type="button" class="btn  btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                        <i class="fa fa-fw fa-plus"></i>&nbsp;Inserisci&nbsp;<span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu text-left" role="menu" id="listaEsamiStrumentali">
                            <?php echo $pulsante_strumentali; ?>
                        </ul>
                    </div>
		</div>	
		</h3>
	</div>
	<div class="panel-body">
		<div id="areaEsamiStrumentali"></div>
	</div>
</div>	

<script>
    $.get( "/fvc/mostra", function(data) { $(data).appendTo('#areaEsamiStrumentali');});
</script>
<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA RADIOLOGIA
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-fw fa-lightbulb-o"></i>&nbsp;&nbsp;Radiologia
		<div class="pull-right">
                    <div class="btn-group">
                    <button type="button" class="btn  btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                        <i class="fa fa-fw fa-plus"></i>&nbsp;Inserisci&nbsp;<span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu text-left" role="menu" id="listaEsamiRadiologia">
                            <?php echo $pulsante_radiologia; ?>
                        </ul>
                    </div>
		</div>	
		</h3>
	</div>
	<div class="panel-body">
		<div id="areaEsamiStrumentali"></div>
	</div>
</div>	

<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
AREA TERAPIA
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-fw fa-eyedropper"></i>&nbsp;&nbsp;Terapia
		<div class="pull-right">
                    <a class="btn btn-default btn-xs" title="Copia da visita precedente" href="#" onclick="copiaTerapia('<?php echo $this->Session->read('Visita.id'); ?>')">
                    <i class="fa fa-fw fa-copy"></i> Importa terapia
                    </a>

                    <div class="btn-group">
                    <button type="button" class="btn  btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                        <i class="fa fa-fw fa-eyedropper"></i>&nbsp;Terapia precedente&nbsp;<span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu text-left" role="menu" id="terapiePrecedenti">
    
                        </ul>
                    </div>
		</div>	
                    
                </h3>
	</div>
	<div class="panel-body">
            <div id="areaTerapia">
                <div class="form-group form-inline pull-right">
                    <input type="text" class="form-control" id="stringaTerapia" placeholder="Aggiungi terapia">
                    <button class="btn btn-default" onclick="cerca_terapia(); return false;"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <div id="elencoFarmaciVisita"></div>
            </div>
	</div>
</div>	

    <script>
        
        $.get( "/terapie/elencoFarmaciVisita/<?php echo $this->Session->read('Visita.id')?>", function(data) { $(data).appendTo('#elencoFarmaciVisita');});
        $.get( "/terapie/visitaprecedente/<?php echo $this->Session->read('Visita.id')?>", function(data) { $('#terapiePrecedenti').html(data);});
    </script>


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
        if (formid === "TerapieSalvaForm")          ajaxurl = "/terapie/salva/" + $("#TerapieId").val();
	
		
        
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
    
    function eliminaEsameDiLaboratorio (tabella, id)
    {
        if (confirm("Eliminare l'esame ?")) {
            window.location = "/laboratorio/elimina/" + tabella + "/" + id;
        }     
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
    
    function copiaTerapia (idvisita) 
    {
        window.location = "/terapie/copiaDaPrecedente/" + idvisita;
    }    
        
    
    </SCRIPT>
    
    
<!-- 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
MODAL STRUMENTALI
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
-->
<div class="modal fade" id="SM">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="SM_titolo">Modal title</h4>
      </div>
      <div class="modal-body" id="SM_body">
        <p>One fine body&hellip;</p>
      </div>
        
        <div class="text-right modal-footer" id="SM_footer">
            <button id="SM_button" class="btn btn-success btn-lg">Salva</button>
            
            <div class="alert alert-warning alert-dismissable" id="SM_output" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
            
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
<script>
    function modificaIndagineStrumentale (tabella, id)
    {
        if (typeof id === undefined) id = '';
        
        $('#SM_titolo').html("Inserisci esame strumentale");
        
        $.ajax(
            {
             async:false, 
             dataType:"html", 
             success:function (data, textStatus) {$("#SM_body").html(data);}, 
             type:"POST", 
             url:"/" + tabella + "/modifica/" + id
            }
        );
        
        /*
         * Aggiungo un evento onClick al pulsante del modal
         * impostando come parametro la tabella
         */
        $('#SM_button').on("click", {tab: tabella}, salvaIndagineStrumentale);
        $('#SM').modal('show');      
        
    }
    
    function aggiungiIndagineStrumentale (tabella) 
    {
       modificaIndagineStrumentale(tabella);
    }
    
    function salvaIndagineStrumentale (event)
    {
        tabella = event.data.tab;
        formid  = $("#SM_body form").attr('id');
        ajaxurl = "/" + tabella + "/salva"
        
 

        
        $.ajax(
            {    async:false, 
                 data:$("#" + formid).serialize(), 
                 dataType:"html", 
                 success:function (data, textStatus) {$("#SM_output").html(data);}, 
                 type:"POST", 
                 url: ajaxurl
             } 
        );
	
        $('#SM_output').show();
        window.reload();        
    }
    
    function eliminaIndagineStrumentale(tabella, id)
    {
        if (confirm("Eliminare l'esame strumentale ?"))
            {
                window.location = "/" + tabella + "/elimina/" + id;
            }
    }
  

</script>