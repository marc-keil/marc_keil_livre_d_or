<?php
session_start();
include('bdd.php');
$connect = "";



if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
    {
     $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
     $requtilisateur->execute(array($_SESSION['id']));
     $infoutilisateur = $requtilisateur->fetch();
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="stylessss.css">
            <title>Accueil</title>
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
                    <li><a href="">Vous êtes connecté(e)</a>
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
                    <p class="h5"><br/>Bonjour <?php echo $infoutilisateur['login'] ?><br/><br>
                    Accedez à votre espace membre :</p><br/>
                    <a href="profil.php"><button type="button" class="button">Consultez votre profil</button><br/><br/></a>  
                    <p class="h2">ou</p>
                    <a href="commentaire.php"><button type="button" class="button">Postez un commentaire</button><br><br><br>     
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
        
    else
    {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Accueil</title>
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
            <li><a href="inscription.php">Inscription</a>
            </li>
            <li><a href="livreor.php">Livre D'or</a>
                    </li>
            <li><a href="connexion.php">Connexion</a>
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
            <p class="h5">Vous souhaitez un nouveau compte ?<br/>Consultez et échangez vos comptes entre membres.<br/>
            Pour accéder à notre espace membre, veuillez-vous connecter.</p><br/>
            <a href="connexion.php"><button type="button" class="button">Connexion</button><br/><br/></a>
            <p class="h4">ou</p><br/>
            <a href="inscription.php"><button type="button" class="button">Inscrivez-vous</button></a><br><BR><br>             
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
?>