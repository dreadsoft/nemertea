<?php
$data_visita = $this->Time->format($this->data['Visita']['data_visita'], "%d/%m/%Y");
echo "<h2>";
echo $data_visita;
echo "<span class=\"pull-right\">";
echo "<a title=\"Elimina\" onclick=\"elimina_visita({$this->data['Visita']['id']});\"><i class=\"fa fa-times\"></i></a>";
echo "</span>";
echo "</h2>";

?>

<div class="text-center">
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
    
    
    <button class="btn navbar-btn btn-default" title="Radiologia">
        <i class="fa fa-lightbulb-o"></i> Radiologia
    </button>
    
</div>
</div>



<?php

    $diario  = $this->Form->create('Visita', array('type' => 'post', 'action' => 'modifica'));
    $diario .= $this->Form->input("id");
    $diario .= $this->Form->input("diario_clinico", array("label" => ""));
    
    $diario .= "<div class=\"text-right col-md-offset-8\">";
    $diario .= $this->Form->input("effettuata_da", array("label" => ""));
    $diario .= '<input class="btn btn-small btn-success" type="submit" value="Salva diario">' . "</div>";
    echo $this->BS->panel("Diario clinico", $diario, "success");
?>


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
            <button id="VGM_invia_button" class="btn btn-success" onclick="VGM_invia_button_click(); return false;">Salva</button>
            <br><br>
            <div class="alert alert-warning" id="VGM_output"></div>
            
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<pre>
<?php
print_r($this->data);
?>
</pre>


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
    
     
    function VGM_invia_button_click ()
    {
        formid = $("#VGM_body form").attr('id');
        
        if (formid == "AnamnesieventoForm") {
            $.ajax(
             {    async:false, 
                  data:$("#AnamnesieventoForm").serialize(), 
                  dataType:"html", 
                  success:function (data, textStatus) {$("#VGM_output").html(data)}, 
                  type:"POST", 
                  url:"\/anamnesieventi/crea"
              }
            );
        }
    }
    
    function elimina_visita(id_visita)
    {
        if (confirm("Eliminare la scheda visita corrente?")) {
            window.location = "/visite/elimina/" + id_visita;
        }
    }
    
</script>