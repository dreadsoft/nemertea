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

$cakeDescription = __d('Nemertea - Cartella clinica');

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
	echo $this->Html->css("font-awesome/css/font-awesome.css");
	echo $this->Html->css("sb-admin.css");
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
                <a class="navbar-brand" id="paziente_nome" href="#"><?php echo $this->Session->read("Paziente.nome");?></a>
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
                                <a id="quickinfo_cf" href="#" onclick="copia_clipboard('quickinfo_cf');">
                                    RSSMRC81H10A515W
                                </a>

                        <li class="divider"></li>
                        <li>
                                <strong>Telefono</strong>
                                <a id="quickinfo_tel" href="#"  onclick="copia_clipboard('quickinfo_tel');">3381010621</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
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
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a  title="Esami" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-list-alt  fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
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

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
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

					
					<li><a href="index.html"><i class="fa fa-home fa-fw"></i> Riepilogo</a></li>
					<li><a href="/anamnesi/paziente/<?php echo $this->Session->read("Paziente.id")?>"><i class="fa fa-th-list fa-fw"></i> Anamnesi</a></li>
					<li><a href=""><i class="fa fa-file-text fa-fw"></i> Documenti</a></li>
					

					
					<li>
                        <a href="#"><i class="fa fa-plus-circle fa-fw"></i> Nuovo<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/pazienti/nuovo"><i class="fa fa-user"></i> Paziente</a>
                            </li>
                            <li>
                                <a href="/visite/nuova"><i class="fa fa-medkit"></i> Visita</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
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
	
	<?php echo $this->element('sql_dump'); 
	
	// CORE SCRIPT
    echo $this->Html->script("jquery-1.10.2.js");
	
    echo $this->Html->script("bootstrap.min.js");
    echo $this->Html->script("plugins/metisMenu/jquery.metisMenu.js");

    echo $this->Html->script("sb-admin.js");
	?>
    
    
    <script>
        function cerca_paziente () {
            searchstring = $("#input-cerca").val();
            window.location= "/pazienti/cerca/" + searchstring;
        }
        
        function copia_clipboard (id_elemento) 
        {
            alert($("#" + id_elemento).html());
        }
        
    </script>
</body>
</html>
