<?php
    echo $this->Form->create('Fvc', array('action' => 'salva'));
?>

<div class="form-inline" style="margin-bottom: 1em;">
    <?php echo $this->Form->input('data'); ?>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Capacit&agrave; vitale forzata</div>
    <div class="panel-body">
        <?php

            echo $this->Form->inputs(array(
                "id",
                "paziente_id" => array('type' => 'hidden'),
                "visita_id" => array('type' => 'hidden'),
            ));

        ?>
        <div class="row">
            <div class="col-md-4">
                <?php
                    echo $this->Form->input('fvc', array('label' => 'FVC'));
                    echo $this->Form->input('fvcpc', array('label' => 'FVC(%)'));
                ?>
            </div>
            <div class="col-md-4">
                    <?php
                        echo $this->Form->input('fev1', array('label' => 'FEV1'));
                        echo $this->Form->input('fev1pc', array('label' => 'FEV1(%)'));
                    ?>
                
            </div>            
            <div class="col-md-4">
                    <?php
                        echo $this->Form->input('fev1fvc', array('label' => 'FEV1/FVC'));
                    ?>
            </div>
        </div>


    </div>
</div>




<div class="panel panel-primary">
    <div class="panel-heading">Test con broncodilatatore</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4"><?php echo $this->Form->input("fev1post", array('label' => 'FEV1 post'));?></div>
            <div class="col-md-4"><?php  echo $this->Form->input("fev1incpostml", array('label' => 'Differenza (ml)'));?></div>
            <div class="col-md-4"><?php  echo $this->Form->input("fev1incpostpc", array('label' => 'Differenza (%)')); ?></div>
        </div>
    </div>
</div>

<?php 
$this->Form->end();
?>