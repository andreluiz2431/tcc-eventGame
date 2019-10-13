<?php
include 'class_usuario.php';
session_start();
if(isset($_SESSION['nomeUsuario'])){
    $idusuario = $_SESSION['idUsuario'];
}else{
    header("location:index.php");
}

include 'condicaoCores2.php';

include "class_missao.php";

$missao = new Missao();




if(!empty($_POST['editar-dados'])){
    if($_POST['editar-dados'] == 'Editar dados'){
        $idEventoEditar = $_POST['idEventoEditar'];
        --$idEventoEditar;


        include '../conexaoBDpdoPN.php';
        // pegando dados do evento
        $consultaDados = $pdo->query("SELECT * FROM evento WHERE idEvento = ".$idEventoEditar."");

        while ($linhaDados = $consultaDados->fetch(PDO::FETCH_ASSOC)) {
            $tituloE = $linhaDados["tituloEvento"];
            $data_inicioE = $linhaDados["dataInicioEvento"];
            $data_fimE = $linhaDados["dataFimEvento"];
            $hora_inicioE = $linhaDados["horaInicioEvento"];
            $hora_fimE = $linhaDados["horaFimEvento"];
            $localE = $linhaDados["localEvento"];
            $cidadeE = $linhaDados["cidadeEvento"];
            $estadoE = $linhaDados["estadoEvento"];
            $paisE = $linhaDados["paisEvento"];
            $area_academicaE = $linhaDados["areaAcademicaEvento"];
            $sobre_eventoE = $linhaDados["sobreEvento"];
        }

        include '../conexaoBDpdoPN.php';
        // pegando id da missao pelo evento
        $consultaDados = $pdo->query("SELECT * FROM missaoevento WHERE idEvento = ".$idEventoEditar."");

        while ($linhaDados = $consultaDados->fetch(PDO::FETCH_ASSOC)) {
            $idMissaoE = $linhaDados["idMissao"];
        }

        include '../conexaoBDpdoPN.php';
        // pegando dados da missao
        $consultaDados = $pdo->query("SELECT * FROM missao WHERE idMissao = ".$idMissaoE."");

        while ($linhaDados = $consultaDados->fetch(PDO::FETCH_ASSOC)) {
            $tituloMissaoE = $linhaDados["tituloMissao"];
            $sobreMissaoE = $linhaDados["sobreMissao"];
            $idRecompensaE = $linhaDados["idRecomensa"];
        }
    }
}
?>
<html>
    <head>
        <title>Cadastro de Evento - EventGame</title>
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="style_cadastro_evento.css">-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="../assets/demo/demo.css" rel="stylesheet" />
    </head>
    <body style="<?php echo $cor; ?>">


        <form role="form" class="box" method="POST" action="editarDadosEvento.php">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6" style="margin-top: 5%;input{margin: 2%; width: 100%;}">
                        <h3>
                            Editar dados do evento
                        </h3>
                        <div class="tabbable" id="tabs-297093">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#tab1" data-toggle="tab">Evento</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab">Missão</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab">Recompensa</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Insira os dados do evento</h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Título do evento</label>
                                                                <input type="hidden" name="idEventoE" value="<?php echo $idEventoEditar; ?>">
                                                                <input type="hidden" name="idMissaoE" value="<?php echo $idMissaoE; ?>">
                                                                <input type="text" name="titulo" class="form-control" title="Título do Evento" required="true" value="<?php echo $tituloE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Data de início</label>
                                                                <input  type="date" name="data_inicio" title="Data do inicio do evento" class="form-control" required="true" value="<?php echo $data_inicioE; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Data de encerramento</label>
                                                                <input type="date" name="data_fim" title="Data do fim do evento" class="form-control" required="true" value="<?php echo $data_fimE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Hora de início</label>
                                                                <input type="time" name="hora_inicio" title="Hora de inicio do evento" class="form-control" required="true" value="<?php echo $hora_inicioE; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Hora de encerramento</label>
                                                                <input type="time" name="hora_fim" title="Hora de fim do evento" class="form-control" required="true" value="<?php echo $hora_fimE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Local do evento</label>
                                                                <input type="text" name="local" title="Local do evento" class="form-control" required="true" value="<?php echo $localE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Cidade</label>
                                                                <input type="text" name="cidade" title="Cidade em que ocorrerá evento" class="form-control" required="true" value="<?php echo $cidadeE; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Estado</label>
                                                                <input type="text" name="estado" title="Estado em que ocorrerá evento" class="form-control" required="true" pattern="[A-Za-z]{2}" value="<?php echo $estadoE; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">País</label>
                                                                <input type="text" name="pais" title="País em que ocorrerá evento" class="form-control" required="true" value="<?php echo $paisE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Área acadêmica</label>
                                                                <input type="text" name="area_academica" title="Área academica do evento" class="form-control" required="true" value="<?php echo $area_academicaE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Fale sobre o evento</label>
                                                                <input type="text" name="sobre_evento" title="Fale sobre o evento" class="form-control" value="<?php echo $sobre_eventoE; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="pagina_eventos.php" style="float: left;margin-top:5%;">Cancelar?</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="button" href="#tab2" data-toggle="tab" class="btn btn-primary pull-right" style="margin-left: 100%;<?php echo $cor; ?>" value="Próximo" title="Próximo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab2">
                                    <div class="card card">
                                        <div class="card-body">
                                            <h4 class="card-title">Insira os dados da missão para o evento</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Título da missão</label>
                                                        <input type="text" name="tituloMissao" title="Título da Missão" class="form-control" required="true" value="<?php echo $tituloMissaoE; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Fale sobre a Missão</label>
                                                        <input type="text" name="sobreMissao" title="Fale sobre a Missão" class="form-control" required="true" value="<?php echo $sobreMissaoE; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="pagina_eventos.php" style="float: left;margin-top:5%;">Cancelar?</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="button" href="#tab3" data-toggle="tab" class="btn btn-primary pull-right" style="margin-left: 100%;<?php echo $cor; ?>" value="Próximo" title="Próximo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <div class="card card">
                                        <div class="card-body">
                                            <h4 class="card-title">Selecione uma recompensa para a missão</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <select name="recompensa" class="form-control">
                                                            <?php $missao->recompensas_cadastradas(); ?>
                                                            <option value="3">100 pontos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="pagina_eventos.php" style="float: left;margin-top:5%;">Cancelar?</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="submit" class="btn btn-primary pull-right" style="margin-left: 100%;<?php echo $cor; ?>" value="Concluir" title="Finalizar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/scripts.js"></script>

            <?php
            include 'footer.php';
            ?>
            <?php
            include 'alteraTema.php';
            ?>
            <!--   Core JS Files   -->
            <script src="../assets/js/core/jquery.min.js"></script>
            <script src="../assets/js/core/popper.min.js"></script>
            <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
            <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            <!-- Plugin for the momentJs  -->
            <script src="../assets/js/plugins/moment.min.js"></script>
            <!--  Plugin for Sweet Alert -->
            <script src="../assets/js/plugins/sweetalert2.js"></script>
            <!-- Forms Validations Plugin -->
            <script src="../assets/js/plugins/jquery.validate.min.js"></script>
            <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
            <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
            <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
            <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
            <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
            <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
            <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
            <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
            <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
            <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
            <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
            <script src="../assets/js/plugins/fullcalendar.min.js"></script>
            <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
            <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
            <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
            <script src="../assets/js/plugins/nouislider.min.js"></script>
            <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
            <!-- Library for adding dinamically elements -->
            <script src="../assets/js/plugins/arrive.min.js"></script>
            <!--  Google Maps Plugin    -->
            <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
            <!-- Chartist JS -->
            <script src="../assets/js/plugins/chartist.min.js"></script>
            <!--  Notifications Plugin    -->
            <script src="../assets/js/plugins/bootstrap-notify.js"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
            <!-- Material Dashboard DEMO methods, don't include it in your project! -->
            <script src="../assets/demo/demo.js"></script>
            <script>
                $(document).ready(function() {
                    $().ready(function() {
                        $sidebar = $('.sidebar');

                        $sidebar_img_container = $sidebar.find('.sidebar-background');

                        $full_page = $('.full-page');

                        $sidebar_responsive = $('body > .navbar-collapse');

                        window_width = $(window).width();

                        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                                $('.fixed-plugin .dropdown').addClass('open');
                            }

                        }

                        $('.fixed-plugin a').click(function(event) {
                            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                            if ($(this).hasClass('switch-trigger')) {
                                if (event.stopPropagation) {
                                    event.stopPropagation();
                                } else if (window.event) {
                                    window.event.cancelBubble = true;
                                }
                            }
                        });

                        $('.fixed-plugin .active-color span').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-color', new_color);
                            }

                            if ($full_page.length != 0) {
                                $full_page.attr('filter-color', new_color);
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.attr('data-color', new_color);
                            }
                        });

                        $('.fixed-plugin .background-color .badge').click(function() {
                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('background-color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-background-color', new_color);
                            }
                        });

                        $('.fixed-plugin .img-holder').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).parent('li').siblings().removeClass('active');
                            $(this).parent('li').addClass('active');


                            var new_image = $(this).find("img").attr('src');

                            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                $sidebar_img_container.fadeOut('fast', function() {
                                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                    $sidebar_img_container.fadeIn('fast');
                                });
                            }

                            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $full_page_background.fadeOut('fast', function() {
                                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                    $full_page_background.fadeIn('fast');
                                });
                            }

                            if ($('.switch-sidebar-image input:checked').length == 0) {
                                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                            }
                        });

                        $('.switch-sidebar-image input').change(function() {
                            $full_page_background = $('.full-page-background');

                            $input = $(this);

                            if ($input.is(':checked')) {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar_img_container.fadeIn('fast');
                                    $sidebar.attr('data-image', '#');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page_background.fadeIn('fast');
                                    $full_page.attr('data-image', '#');
                                }

                                background_image = true;
                            } else {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar.removeAttr('data-image');
                                    $sidebar_img_container.fadeOut('fast');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page.removeAttr('data-image', '#');
                                    $full_page_background.fadeOut('fast');
                                }

                                background_image = false;
                            }
                        });

                        $('.switch-sidebar-mini input').change(function() {
                            $body = $('body');

                            $input = $(this);

                            if (md.misc.sidebar_mini_active == true) {
                                $('body').removeClass('sidebar-mini');
                                md.misc.sidebar_mini_active = false;

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                            } else {

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                                setTimeout(function() {
                                    $('body').addClass('sidebar-mini');

                                    md.misc.sidebar_mini_active = true;
                                }, 300);
                            }

                            // we simulate the window Resize so the charts will get updated in realtime.
                            var simulateWindowResize = setInterval(function() {
                                window.dispatchEvent(new Event('resize'));
                            }, 180);

                            // we stop the simulation of Window Resize after the animations are completed
                            setTimeout(function() {
                                clearInterval(simulateWindowResize);
                            }, 1000);

                        });
                    });
                });
            </script>
            </body>
        </html>
    <?php
    if(!empty($_POST["titulo"])){

        include "class_evento.php";

        $evento = new Evento();

        $titulo = $_POST["titulo"];
        $data_inicio = $_POST["data_inicio"];
        $data_fim = $_POST["data_fim"];
        $hora_inicio = $_POST["hora_inicio"];
        $hora_fim = $_POST["hora_fim"];
        $local = $_POST["local"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $pais = $_POST["pais"];
        $area_academica = $_POST["area_academica"];
        $sobre_evento = $_POST["sobre_evento"];

        $missaoTitulo = $_POST['tituloMissao'];
        $missaoSobre = $_POST['sobreMissao'];
        $missaoRecompensa = $_POST['recompensa'];

        $idEventoEditar = $_POST['idEventoE'];
        $idMissaoE = $_POST['idMissaoE'];

        $resultadoAlt = $evento->editarDadosEvento($idEventoEditar, $titulo, $idusuario, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $cidade, $estado, $pais, $area_academica, $sobre_evento, $idMissaoE, $missaoTitulo, $missaoSobre, $missaoRecompensa);

        echo "<script language='javascript' type='text/javascript'> alert('".$resultadoAlt." com sucesso!');</script>";
        echo "<script>window.location.href = \"meus_eventos.php\";</script>";
    }
    ?>
