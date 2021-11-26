<?php
session_start();
include('bdd.php');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $getid = intval($_SESSION['id']); // Convertie ma valeur en int ( ID = un numéro )
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?'); // créer une requete qui va récuperer tout de mon utilisateur de mon id actuel
    $requtilisateur->execute(array($getid)); // return le tableau de mon utilisateur
    $infoutilisateur = $requtilisateur->fetch(); // récupere les informations que j'appelle

    if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
    
{
    $connect = "Vous êtes connecté(e)";
}
else
{
    $connect = "Connexion";
}
        
    

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Espace Membre</title>
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
                   <li><a href="livreor.php">Livre D'or</a>
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
    <main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
      				  <div align="center">
						  <h2>Profil de <?php echo $infoutilisateur['login'] ?> </h2>
						  <br /><br />
						  Login = <?php echo $infoutilisateur['login'] ?>
						  <br /><br />
						  <a class="profila" href="editionprofil.php"> Editer son profil</a>
						  <br /><br />
                          <a href="commentaire.php" class ="formconnexion">Postez un commentaire</a><br><br>
						  <br><br>
						  <a href="deconnexion.php">
							  <input type="submit" class ="deco" name="deconnexion" value="Se déconnecté"><br><br><br>
						  </a>

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

}
else {
    header("Location: connexion.php");
}
?>