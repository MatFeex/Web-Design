<?php

   require('../Controller/Util.php');
   
   
   session_start();
    /*-- Verification si le formulaire d'authenfication a été bien saisie --*/
   if($_SESSION["acces"]!='y')
   {
            /*-- Redirection vers la page d'authentification --*/
           header("location:index.php");
   }
   else{
        $Util = new Util();
        $Utilisateur = $Util->getUtilisateurById($_SESSION["ID_CONNECTED_USER"]);
        $Medecin = new Medecin();
        $Medecin = $Utilisateur->getMedecin();
        $Medecin_Id = $Medecin->getId_Medecin();
   } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
               Rechercher un rendez-vous
        </title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="js/jquery/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />
        <link rel="shortcut icon" href="bootstrap/img/brain_icon_2.ico"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div id="content" class="span9">
                    <div class="main_body">
                    
                        <div class="Home-Header">
                            <div class="Slogan">
                                
                            </div>
                            <div class="Contact-Research">

                            </div>
                            <div class="Logo">

                            </div>
                        </div>
                        <div class="Horizontal-menu">
                            <center>
                                <h4>
                                    <?php
                                        echo $Medecin->getNom_Medecin().' '.$Medecin->getPrenom_Medecin();
                                   ?>
                                </h4>
                            </center>
                        </div>
                        <div class="Left-body">
                            <div class="Left-body-head">
                                Rechercher un rendez-vous par la date 
                            </div>
                            <div class="infos">
                            </div>
                            <div class="en_bref">
                                <form action="search_date_rdv.php" method="post">
                                <input class="textfield_form" type="date" name="Date_Rendez_Vous" size="50"/><br/>
                                <input type="submit" name="valider" value = "Valider"/>
                            <table class="table" style="width:20%">
                                    <thead>
                                    <tr>
                                        <th>id rendez-vous </th>
                                        <th>Date rendez-vous</th>
                                        <th>Salle rendez-vous</th>
                                        <th>Id patient</th>
                                        <th>Id médecin</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php
                                if(isset($_POST["Date_Rendez_Vous"])){
                                    $Query = "SELECT * FROM rendez_vous WHERE Id_Medecin='$Medecin_Id'AND Date_Rendez_Vous='".$_POST["Date_Rendez_Vous"]."'" ;
                                    //echo $Query;
                                    $Util->dbConnection();
                                    if ($Util->mysqli->connect_error) {
                                        die('Erreur de connexion ('.$Util->mysqli->connect_errno.')'. $Util->mysqli->connect_error);
                                    } else {
                                        if(($result = $Util->mysqli->query($Query))){
                                            while($ligne = $result->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?= $ligne['Id_Rendez_Vous' ]?></td>
                                                <td><?= $ligne['Date_Rendez_Vous'] ?></td>
                                                <td><?= $ligne['Salle_Rendez_Vous'] ?></td>
                                                <td><?= $ligne['Id_Patient'] ?></td>
                                                <td><?= $ligne['Id_Medecin'] ?></td>
                                            </tr>
                                            <?php }
                                        }
                                    }
                                }else{
                                    $Query = "SELECT * FROM rendez_vous WHERE Id_Medecin='$Medecin_Id'" ;
                                    //echo $Query;
                                    $Util->dbConnection();
                                    if ($Util->mysqli->connect_error) {
                                        die('Erreur de connexion ('.$Util->mysqli->connect_errno.')'. $Util->mysqli->connect_error);
                                    } else {
                                        if(($result = $Util->mysqli->query($Query))){
                                            while($ligne = $result->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?= $ligne['Id_Rendez_Vous' ]?></td>
                                                <td><?= $ligne['Date_Rendez_Vous'] ?></td>
                                                <td><?= $ligne['Salle_Rendez_Vous'] ?></td>
                                                <td><?= $ligne['Id_Patient'] ?></td>
                                                <td><?= $ligne['Id_Medecin'] ?></td>
                                            </tr>
                                            <?php }
                                        }
                                    }

                                }
                                ?> 
                               </tbody>
                                </table>
                                </form>
                            </div>
                            
                            
                        </div>
                    <div class="Right-body">
                        <div class="About-us">
                            <div class="Social-NW-head">
                                
                            </div>
                            <div class="Social-NW-body">
                                <a href="medecin_display.php"><i class="icon-home"></i> Menu</a>
                                <br/><hr>
                                <a href="list_consultation.php"><i class="icon-file"></i> Mes consultations</a>
                                <br/>
                                <a href="list_patient_medecin.php"><i class="icon-user"></i> Mes patients</a>
                                <br/>
                                <a href="list_rdv_medecin.php"><i class="icon-calendar"></i> Mes rendez-vous</a>
                                <br/><hr>
                                <a href="edit_consultation.php"><i class="icon-pencil"></i> Editer une consultation</a><br>
                                <a href="edit_ordonnance.php"><i class="icon-pencil"></i> Editer une ordonnance</a><br><hr>
                                
                                <a href="search_patient_medecin.php"><i class="icon-search"></i> Rechercher un patient</a><br>
                                <a href="search_consultation.php"><i class="icon-search"></i> Rechercher une consultation</a>
                                <hr/>
                                <a href="../Controller/deconnexion.php"><i class="icon-off"></i> Se déconnecter </a>
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    </div>
                    <div class="footer">
                        &COPY; Cabinet Médical 2021
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js')}}"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
    
    
    
</html>
