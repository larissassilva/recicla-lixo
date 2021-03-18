<?php
session_start();

if (!isset($_SESSION["usuariointranetpmj"])) 
    header("Location: ../../login.php");
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="pt-br">
<head>
    <?php
    include_once '../../includes/head.php';
    ?><!-- Meta, Css -->
</head>
<body class="site-navbar-small letras-maiusculas">
    <?php include_once '../../includes/menu.php'; ?><!-- Menu Topo -->
    <!--Início Página -->
    <div class="page animsition">
    <div class="page-aside" id="menu"></div>
        <div class="page-main">
            <div class="panel-heading">
                <h3 class="panel-title">CADASTRO DE EXTINTOR</h3>
            </div>
            <div class="page-content">
                <div class="panel">
                    <div class="panel-body">
                        <header class="panel-heading">
                            <button id="novo_cadastro" type="button" class="btn btn-labeled btn-primary"  data-toggle="modal">
                                <span class="btn-label"><i class="fa fa-plus" aria-hidden="true"></i></span> Cadastrar Novo
                            </button>
                            <br><br>
                        </header>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped width-full" id="tabelaExtintor">
                                <thead>
                                    <tr>
                                        <th>Modelo</th>
                                        <th>Código</th>
                                        <th>Local</th>
                                        <th>Sublocal</th>
                                        <th>Validade Recarga</th>
                                        <th>Validade Casco</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <!--  <tr data-target="#modalEditar" data-toggle="modal">
                                        <td>Extintor Pó Abc 4kg Mocellin</td>
                                        <td>65398</td>
                                        <td>Rodoviária</td>
                                        <td>12/05/2020</td>
                                        <td>31/05/2021</td>
                                        <td class="text-center"><span class="label ativo-inativo">INATIVO</span></td>
                                    </tr>
                                    <tr data-target="#modalEditar" data-toggle="modal"> 
                                        <td>Extintor Pó Abc 4kg Mocellin</td>
                                        <td>65395</td>
                                        <td>Aeroporto</td>
                                        <td>12/05/2020</td>
                                        <td>31/05/2021</td>
                                        <td class="text-center"><span class="label ativo-inativo">ATIVO</span></td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cadastrar -->
    <div class="modal fade modal-primary" id="modalCadastrar" aria-hidden="true"
    aria-labelledby="modalCadastrar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Cadastrar Extintor</h4>
            </div>
            <form id="form-cadastrar" action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Modelo</label>
                                <select class="select2simples id_modelo" name="id_modelo" required>
                                    <option value=""></option>
                                    <!--<option value="0">Extintor Pó Abc</option>
                                        <option value="1">Extintor Espuma Abc</option>-->
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Código</label>
                                    <input type="text" id="cod" name="codigo" class="form-control codigo" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Órgão</label>
                                    <select class="select2simples id_orgao" name="id_orgao" required>
                                        <option value=""></option>
                                    <!--<option value="0">Secretaria de Gestão e Planejamento</option>
                                        <option value="1">Secretaria de Saúde</option>-->
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Local</label>
                                    <select data-placeholder="Selecione o orgão primeiro." class="select2simples id_local" name="id_local" required>
                                    <option disabled selected>Selecione primeiro o orgão !</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Sublocal</label>
                                    <select data-placeholder="Selecione o local primeiro." class="select2simples id_sublocal" name="id_sublocal">
                                        <option value=""></option>
                                    <!--<option value="0">Recepção</option>
                                        <option value="1">Saúde Bucal</option>-->
                                    </select>
                                </div>
                            </div>                         
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Validade da Recarga</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="val_recarga" class="form-control datas val_recarga" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Validade do Casco</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="val_casco" autocomplete="off" placeholder="ANO" class="form-control ano  val_casco" style="cursor: pointer" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Observação</label>
                                    <textarea class="form-control contador-caracteres obs" name="obs" rows="6"></textarea>
                                    <small class="caracteres"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-labeled btn-default" data-dismiss="modal"><span class="btn-label"><i class="fa fa-ban" aria-hidden="true"></i></span> Cancelar</button>
                                <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-save" aria-hidden="true"></i></span> Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal Editar/Visualizar -->
<div class="modal fade modal-primary" id="modalEditar" aria-hidden="true" aria-labelledby="modalEditar" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Editar Extintor</h4>
            </div>
            <form id="form-editar" action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Data de Cadastro</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input id="data" type="text" name="data" class="form-control data" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Validade da Recarga</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" id="val_recarga" name="val_recarga" class="form-control val_recarga" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="control-label">Validade do Casco</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" id="val_casco" name="val_casco" autocomplete="off" class="form-control ano  val_casco" style="cursor: pointer" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Modelo</label>
                                <select id="id_modelo" class="select2simples id_modelo" name="id_modelo" required disabled>
                                    <option value=""></option>
                                    <!--<option value="0">Extintor Pó Abc</option>
                                        <option value="1">Extintor Espuma Abc</option>-->
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Código</label>
                                    <input type="text" id="codigo" name="codigo" class="form-control codigo" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Órgão</label>
                                    <select id="id_orgao" class="select2simples id_orgao" name="id_orgao" required>
                                        <option value=""></option>
                                    <!--<option value="0">Secretaria de Gestão e Planejamento</option>
                                        <option value="1">Secretaria de Saúde</option>-->
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Local</label>
                                    <select id="id_local" class="select2simples id_local" name="id_local" required>
                                    <option disabled selected>Selecione primeiro o orgão !</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Sublocal</label>
                                    <select id="id_sublocal" class="select2simples id_sublocal" name="id_sublocal">
                                        <option value=""></option>
                                    <!--<option value="0">Recepção</option>
                                        <option value="1">Saúde Bucal</option>-->
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Observação</label>
                                    <textarea id="obs" class="form-control contador-caracteres obs" name="obs" rows="6"></textarea>
                                    <small class="caracteres"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="checkbox-custom checkbox-primary">
                                        <input type="checkbox" id="status" name="status">
                                        <label for="status">Extintor Inativo</label>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>                
                    <div class="row">
                        <div class="modal-footer">
                            <div class="col-lg-12">
                             <button type="submit" class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil-alt" aria-hidden="true"></i></span> Salvar</button>
                             <button type="button" class="btn btn-labeled btn-default" data-dismiss="modal"><span class="btn-label"><i class="fa fa-times" aria-hidden="true"></i></span> Fechar</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div><!-- Fim Modal Editar Cadastro -->

 <?php include_once '../../includes/footer.php'; ?>
 <?php include_once '../../includes/scripts.php'; ?>
 <script src="js/extintor.js"> </script>

</body>
</html>