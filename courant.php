<?php
    require_once("lib/core.php");
 
   

     $Courant_artistique = new Courant_artistique();
    $Courant_artistique->table = " courantartistique";
    $Courant_artistique->db = $bdd;
    $result_cor = $Courant_artistique->search(array(),array());

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
                                <i class="fa fa-user"></i> Les courants
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
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modal_add_artiste"> Ajouter courant</a>
                    </div>
                    <div class="table-responsive col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>datedebut</th>
                                        <th>datefin</th>
                                        <th>desc</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result_cor as $key => $value) {
                                       echo '<tr>
                                                <td>'.$value["nom"].'</td>
                                                <td>'.$value["datedebut"].'</td>
                                                <td>'.$value["datefin"].'</td>
                                                <td>'.$value["desc"].'</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary"><i class="fa fa-pencil"></i> </a>
                                                    <a href="#" class="btn btn-info"><i class="fa fa-info"></i> </a>
                                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
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
                               Nouveau Courant
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <form class="form-horizontal" role="form" method = "post" action="new_artiste.php">
                        <div class="modal-body">
                            
                              <div class="form-group">
                                <label  class="col-sm-3 control-label"  for="Nom">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nom" name="nom"  placeholder="Nom"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-3 control-label" for="Nom">date debut</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nom" name="date_debut" placeholder="date debut"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-3 control-label datepicker" for="Nom">date fin</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nom" name="date_fin" placeholder="Date fin"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label  class="col-sm-3 control-label datepicker" for="Nom">Date décés</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nom" name="date_deces" placeholder="Date décés"/>
                                </div>
                              </div>
                             
                              
                              <div class="form-group">
                                <label  class="col-sm-3 control-label" for="Description" name="">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                              </div>
                            
                             
                            
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                        Fermer
                            </button>
                            <button type="submit" name="new_artiste" class="btn btn-primary">
                                Enregistrer
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(function() {
        $('.datepicker').datepicker();
      });
  </script>
  

</body>

</html>
