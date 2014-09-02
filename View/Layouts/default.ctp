<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Nemertea - Cartella clinica';

?>
<!DOCTYPE html>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
    
    // CORE CSS
    echo $this->Html->css("bootstrap.min.css");
	echo $this->Html->css("plugins/metisMenu/metisMenu.css");
	echo $this->Html->css("sb-admin-2.css");
	echo $this->Html->css("font-awesome/css/font-awesome.css");
	
	
    echo $this->Html->css("main.css");
        
        echo $this->Html->script("jquery-1.11.0.js");
        echo $this->Html->script("bootstrap.min.js");
        echo $this->Html->script("plugins/metisMenu/metisMenu.min.js");
        echo $this->Html->script("sb-admin-2.js");
		
		// CARICO I DATI DEL PAZIENTE DALLA SESSIONE
		$pz = $this->Session->read("Paziente");
				
		
	?>
</head>
<body>
<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>	
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" id="paziente_nome" href="#"><?php echo $pz['cognome'] . " " . $pz['nome'] ?></a>
            </div>
            <!-- /.navbar-header -->
			
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a title="Informazioni" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-calendar-o fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
							<strong>Codice fiscale</strong><br>
							<a><?php echo $pz['codice_fiscale'] ?></a>
						</li>
                        <li class="divider"></li>
                        <li>
							<strong>Telefono</strong>
							<a><?php echo $pz['telefono'] ?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="/pazienti/riepilogo/<?php echo $pz['id'];; ?>">
                                <strong>Riepilogo</strong>
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a  title="Visite" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-medkit fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks" id='toolbar_ultime_visite'>
                        
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a  title="Esami" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-list-alt  fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" id="toolbar_ultimi_esami">
                        
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a title="Utente" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-md fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
					
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

         <!-- /.navbar-static-top -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
			
						<li class="sidebar-search">
							<div class="input-group custom-search-form">
								<input id="input-cerca" type="text" class="form-control" placeholder="Cerca...">
								<span class="input-group-btn">
									<button  class="btn btn-default" type="button" onclick="cerca_paziente();">
										<i class="fa fa-search"></i>
									</button>
								</span>
							   <!-- /input-group -->
						</li>
						<li><a href="#"><i class="fa fa-plus-circle fa-fw"></i> Nuovo<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="/pazienti/nuovo"><i class="fa fa-user"></i> Paziente</a>
								</li>
								<li>
									<a href="/visite/nuova/<?php echo $pz['id'];?>"><i class="fa fa-medkit"></i> Visita</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>

						<li><a href="/pazienti/riepilogo/<?php echo $pz['id'];?>"><i class="fa fa-home fa-fw"></i> Riepilogo</a></li>
						<li><a href="/anamnesi/paziente/<?php echo $pz['id'];?>"><i class="fa fa-th-list fa-fw"></i> Anamnesi</a></li>
						<li><a href="/visite/elenco/<?php echo $pz['id'];?>"><i class="fa fa-medkit fa-fw"></i> Visite</a>
						</li>
						
							<ul class="nav nav-second-level collapse in">
							<?php
								$ses_visita = $this->Session->read('Visita.id');
								if ($ses_visita !== null) {
									echo '
									<li><a href="#diario_clinico">Diario clinico</a></li>
									<li><a href="#areaEsamiDiLaboratorio">Esami di laboratorio</a></li>
									<li><a href="#areaEsamiStrumentali">Esami strumentali</a></li>
									<li><a href="#areaTerapia">Terapia</a></li>';
								}
							?>	
							</ul>
							
					</ul>
					<!-- /#side-menu -->
				</div>
				<!-- /.sidebar-collapse -->
			</div>
		</nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
	
	<?php // echo $this->element('sql_dump'); 
	
	// CORE SCRIPT

	?>
    
    
    <script type='text/javascript'>
        function cerca_paziente () {
            searchstring = $("#input-cerca").val();
            window.location= "/pazienti/cerca/" + searchstring;
        }
        
        function copia_clipboard (id_elemento) 
        {
            alert($("#" + id_elemento).html());
        }
        
        
        function ultime_visite() {
            
            id_paziente = '<?php echo $pz['id'];?>';
            if (id_paziente == "") return;
            
            $.ajax(
            {    async:true, 
                 dataType:"html", 
                 success:function (data, textStatus) {$("#toolbar_ultime_visite").html(data);}, 
                 type:"POST", 
                 url:"\/visite/ultime/" + id_paziente}
            );

        }
        
        function ultimi_esami() {
            
            id_paziente = '<?php echo $pz['id'];?>';
            if (id_paziente == "") return;
            
            $.ajax(
            {    async:true, 
                 dataType:"html", 
                 success:function (data, textStatus) {$("#toolbar_ultimi_esami").html(data);}, 
                 type:"POST", 
                 url:"\/laboratorio/ultimi_esami/" + id_paziente}
            );

        }        
         
       $(document).ready(function() {
           ultime_visite();
           ultimi_esami();
       });
       
     
    </script>
    
    
</body>
</html>
