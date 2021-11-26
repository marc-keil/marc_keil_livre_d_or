<meta charset="utf-8" />
<?php
session_start();
include('bdd.php');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0 )
{
    $getid = intval($_SESSION['id']); // Convertie ma valeur en int ( ID = un numéro )
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?'); // créer une requete qui va récuperer tout de mon utilisateur de mon id actuel
    $requtilisateur->execute(array($getid)); // return le tableau de mon utilisateur
    $infoutilisateur = $requtilisateur->fetch(); // récupere les informations que j'appelle
    $c_msg = "";
    if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
    
    {
        $connect = "Vous êtes connecté(e)";
    }
    else
    {
        $connect = "Connexion";
    }

    if(isset($_POST['submit_commentaire'])) 
    {
        
        if(isset($_POST['commentaire']) && !empty($_POST['commentaire']))
        {
            $comlenght = strlen($_POST['commentaire']);

            if($comlenght > 255)
            $c_msg = "Votre commentaire ne doit pas dépasser 255 caractères !<br><br>";

        if ($c_msg == "") {
            $commentaire = htmlspecialchars($_POST['commentaire']);
            $postage = $bdd->prepare('INSERT INTO commentaires (id_utilisateur, commentaire, date) VALUES (?,?, NOW())');
            $postage->execute(array($getid,$commentaire));
            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span><br><br>";
            header("Location: livreor.php");
            unset($_POST);

        }
        }
        else
        {
            $c_msg = "Champs vide";
            unset($_POST);
        }
        
      
    }
}
else 
{
header("Location: connexion.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Commentaire</title>
</head>
<body>
<header class="page-header" >
       <div class="banner"">
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
                    <li><a href="livreor.php">Livre D'or</a>
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
    <main class="jacky">
            <div class="tajine">
                <section class="oui"><br/>
<div align=center>
<h2>Commentaires:</h2>
<form method="POST">
    Votre pseudo : <?php echo $infoutilisateur['login'] ?><br><br>
   <textarea name="commentaire" placeholder="Votre commentaire..." style="width: 300px; height: 100px"></textarea><br /><br>
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" class ="formconnexion" />
</form>
<br>
<?php if(isset($c_msg)) { echo $c_msg; } ?>
<a href="profil.php" class ="formconnexion">Retour</a><br>
<br /><br />
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