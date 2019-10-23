<footer class="footer">
    <div class="container-fluid">
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, EventGame
        </div>
    </div>
</footer>


<div class="modal fade" id="modal-container-skin" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="proc_upload.php" enctype="multipart/form-data">
            <div class="modal-content" style="width: 150%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Inserir skin</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto; overflow: auto;">

                    <div class="col-md-16">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nome da skin</label>
                                            <input type="text" name="nomeSkin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Valor da skin</label>
                                            <input type="text" name="custoSkin" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <input type="file" name="arquivo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <input type="submit" class="btn btn-primary pull-right" value="Concluir" style="<?php include 'condicaoCores2.php'; echo $cor; ?>">
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modal-container-tema" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="temas.php">
            <div class="modal-content" style="width: 200%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Cadastrar tema</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto; overflow: auto;">

                    <div class="col-md-16">
                        <div class="">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nome do tema</label>
                                            <input type="text" name="nomeTema" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <input type="color" name="corTema" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <input type="submit" class="btn btn-primary pull-right" value="Concluir" style="<?php include 'condicaoCores2.php'; echo $cor; ?>">
                </div>

            </div>
        </form>
    </div>
</div>
