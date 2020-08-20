<?php
    require_once("lib/core.php");
    $artiste = new artiste();
    $artiste->table = " artiste, courantartistique";
    $artiste->db = $bdd;
    $result_art = $artiste->search(array("fields" => "artiste.* , courantartistique.nom as nom_art", "conditions" => "  courantartistique.idcourant = artiste.idcourant"),array());
   //var_dump($result_art);die();

     $Courant_artistique = new Courant_artistique();
    $Courant_artistique->table = " courantartistique";
    $Courant_artistique->db = $bdd;
    $result_cor = $Courant_artistique->search(array("fields" => " idcourant, nom  "),array());

    session_start();
   //var_dump($result_art);die();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- TimePeker -->
    
</head>
<script type="text/javascript">
    function itemEditE(id)
{                       
          $.ajax(
            {
                  url : 'new_artiste.php',
                  type: "POST",
                  data:{id: id, type: "update_artiste"}, 
                  success: function(data, textStatus, jqXHR) {
                  //alert(data)
                 
                    var r = JSON.parse(data);
                    console.log(r)
                    $("#idArtiste").val(r.idArtiste);
                    $("#nom").val(r.nom);
                    $("#prenom").val(r.prenom);
                    $("#date_nas").val(r.datenaissance);
                    $("#date_deces").val(r.datedeces);
                    $("#nationalite").val(r.nationalite);
                    $("#courant").val(r.idCourant);
                    $("#descp").val(r.descp);
                    $("#new_artiste").val("update");
                      $("#modal_add_artiste").modal("show");
                  },
                  error: function(jqXHR, textStatus, errorThrown) 
                  {
                      //if fails      
                  }
              });
              //e.preventDefault(); //STOP default action
               
      
                 
                        
  }
   function info(id)
{                       
          $.ajax(
            {
                  url : 'new_artiste.php',
                  type: "POST",
                  data:{id: id, type: "info"}, 
                  success: function(data, textStatus, jqXHR) {
                  //alert(data)
                 
                    var r = JSON.parse(data);
                    console.log(r)
                    $("#nom_info").text(r.nom);
                    $("#prenom_info").text(r.prenom);
                    $("#date_nas_info").text(r.datenaissance);
                    $("#date_deces_info").text(r.datedeces);
                    $("#nationalite_info").text(r.nationalite);
                    $("#courant_info").text(r.nom);
                    $("#descp_info").text(r.descp);
                      $("#modal_info_artiste").modal("show");
                  },
                  error: function(jqXHR, textStatus, errorThrown) 
                  {
                      //if fails      
                  }
              });
              //e.preventDefault(); //STOP default action
               
      
                 
                        
  }

 function delete_artiste(id)
{                       
    $("#idArtiste_delete").val(id);       
  
    $("#modal_delete_artiste").modal("show");
                        
  }

</script>
<body>

    <div id="wrapper">

       <?php require_once "element/sidebar.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small> > inventaire des oeuvres d'arts</small 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-user"></i> Les artistes
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <?php
                        if(isset($_SESSION["notif"])){
                            if(isset($_SESSION["success"])){
                                echo '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-info-circle"></i>  <strong>'.$_SESSION["notif"].'</strong> 
                                    </div>';
                            }else{
                                echo '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-info-circle"></i>  <strong>'.$_SESSION["notif"].'</strong>
                                    </div>';
                            }
                            session_destroy();
                        }
                    ?>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="#" class="btn btn-primary" id="add_artiste"  data-toggle="modal" data-target="#modal_add_artiste"> Ajouter artiste</a>
                    </div>
                    <div class="table-responsive col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Nationalité</th>
                                        <th>Courant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result_art as $key => $value) {
                                       echo '<tr>
                                                <td>'.$value["nom"].'</td>
                                                <td>'.$value["prenom"].'</td>
                                                <td>'.$value["nationalite"].'</td>
                                                <td>'.$value["nom_art"].'</td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="itemEditE('.$value["idArtiste"].')" class="btn btn-primary"><i class="fa fa-pencil"></i> </a>
                                                    <a href="javascript:void(0)" onclick="info('.$value["idArtiste"].')"  class="btn btn-info"><i class="fa fa-info"></i> </a>
                                                    <a href="javascript:void(0)" onclick="delete_artiste('.$value["idArtiste"].')"  class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>';
                                    }?>
                                  
                                </tbody>
                            </table>
                        </div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <!-- Modal -->
            <div class="modal fade" id="modal_add_artiste" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" 
                               data-dismiss="modal">
                                   <span aria-hidden="true">&times;</span>
                                   <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                               Nouvel artiste
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <form class="form-horizontal" role="form" method = "post" action="new_artiste.php">
                        <div class="modal-body">
                                    <input type="hidden" class="form-control" id="idArtiste" name="idArtiste"  />
                            
                              <div class="form-group">
                                <label  class="col-sm-2 control-label"  for="Nom">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nom" name="nom"  placeholder="Nom"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label" for="Nom">Prénom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label datepicker" for="Nom">Date naissance</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date_nas" name="date_naiss" placeholder="Date naissance"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label datepicker" for="Nom">Date décés</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date_deces" name="date_deces" placeholder="Date décés"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label" for="Nom">Nationalité</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nationalite" name="nationalite" placeholder="Nationalité"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label" for="Nom">Courant</label>
                                <div class="col-sm-10">
                                    <select name="courant" id="courant" class="form-control">
                                        <?php 
                                        foreach ($result_cor as $key => $value) {
                                             echo '<option value="'.$value["idcourant"].'"> '.$value["nom"].'</option>';
                                        }
                                       
                                        ?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-2 control-label" for="Description" name="">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="descp" class="form-control"></textarea>
                                </div>
                              </div>
                            
                             
                            
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                        Fermer
                            </button>
                            <button type="submit" name="new_artiste" id="new_artiste" class="btn btn-primary">
                                Enregistrer
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal_info_artiste" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" 
                               data-dismiss="modal">
                                   <span aria-hidden="true">&times;</span>
                                   <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                               Information d'artiste
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body">
                            
                              <div class="row">
                                <label  class="col-sm-3 control-label"  for="Nom">Nom</label>
                                <div class="col-sm-9">
                                    <span  id="nom_info" ></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label" for="Nom">Prénom</label>
                                <div class="col-sm-9">
                                    <span id="prenom_info" ></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label datepicker" for="Nom">Date naissance</label>
                                <div class="col-sm-9">
                                    <span id="date_nas_info" ></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label datepicker" for="Nom">Date décés</label>
                                <div class="col-sm-9">
                                    <span  id="date_deces_info" ></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label" for="Nom">Nationalité</label>
                                <div class="col-sm-9">
                                    <span  id="nationalite_info" ></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label" for="Nom">Courant</label>
                                <div class="col-sm-9">
                                    <span id="courant_info"></span>
                                </div>
                              </div>
                              <div class="row">
                                <label  class="col-sm-3 control-label" for="Description" name="">Description</label>
                                <div class="col-sm-9">
                                    <span  id="descp_info" ></span>
                                </div>
                              </div>
                            
                             
                            
                        </div>
                        <!-- Modal Footer -->
                       
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_delete_artiste" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                        <form class="form-horizontal" role="form" method = "post" action="new_artiste.php">
                        <input type="hidden" class="form-control" id="idArtiste_delete" name="idArtiste_d"  />
                    <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" 
                               data-dismiss="modal">
                                   <span aria-hidden="true">&times;</span>
                                   <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                               Suprimer artiste
                            </h4>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                            <p>Voulez vous vraiment supprimé cet artiste ?</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Fermer
                            </button>
                            <button type="submit" name="delete_artiste" id="delete_artiste" class="btn btn-danger">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                </form>
                        <!-- Modal Footer -->
                    </div>
                </div>
            </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   <script type="text/javascript">
    $(function(){
        $("#add_artiste").click(function(){
             $("#nom").val("");
                    $("#idArtiste").val("");
                    $("#prenom").val("");
                    $("#date_nas").val("");
                    $("#nationalite").val("");
                    $("#courant").val("");
                    $("#descp").val("");
            $("#new_artiste").val("");
        })
    })
   </script>
  

</body>

</html>
