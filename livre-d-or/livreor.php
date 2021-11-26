<?php 
session_start();
include('bdd.php');

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
    
{
    $connect = "Vous êtes connecté(e)";
}
else
{
    $connect = "Connexion";
}

$req = $bdd->query('SELECT login, date, commentaire FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC')


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre D'or</title>
</head>
<body>
<header class="page-header" >
        <div class="banner">
            <h1 class="titre1">
                <a href="./index.php">
                    Accueil
                </a>
            </h1>
        </div>
            <nav>
                <ul>          
                    <li><a href="index.php">Accueil</a>
                    </li>
                    <li><a href="connexion.php"><?php echo $connect; ?></a>
                   </li>
                   <?php if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
                    { ?>
                    <li><a href="deconnexion.php"><input type="submit" name="boutondeco" class="boutondeco" value="Déconnexion"></a></li>
                    <?php
                    }    
                    ?>
                
                </ul>
            </nav>
    </header>
    <br>
    <main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
      				  <div align="center">
    <h2 align="center">Livre d'or</h2><br>

    <?php   while ($com = $req->fetch()){ 

                echo '<div class="moncom"><p>';
                echo $com['commentaire'];
                echo '<p></div>';
                echo 'publié par ';
                echo $com['login']."";
                echo '<br>';
                echo 'le ';
                echo $com['date'];
                echo '<br>';
                echo '<br>';       
    } 
    ?>
     <?php if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
     { ?>
     <a href="commentaire.php" class ="formconnexion">Postez un commentaire</a><br><br>
      <?php
     }   ?>
    


      				  </div>
      		  </section>
            </div>
   </main>
   <footer>
                <div class="footerr">
                    <div>

                            <a href="https://github.com/marc-keil/marc_keil_module_connexion">
                            <img src="https://zupimages.net/up/21/43/vxwj.png" width="125" height="125">
                            </a>
                        
                    </div>


                        
                </div>
            </footer>
</body>
</html>

<?php

 ?>