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




if(isset($_POST['forminscription']))
{
    $erreur = "";
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    if(!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
    {
        $loginlenght = strlen($login);
        $passwordlenght = strlen($password);
        $password2lenght = strlen($password2);

        $requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount(); // rowCount = Si une ligne existe = PAS BON 
              
        if($loginlenght > 255)
            $erreur = "Votre login ne doit pas dépasser 255 caractères !";
        elseif($passwordlenght > 255)
            $erreur = "Votre password ne doit pas dépasser 255 caractères !";
        elseif($password !== $password2)
            $erreur = "Vos mots de passe ne correspondent pas !";

        if($loginexist !== 0) 
            $erreur = "Votre login est déjà pris !";

        if ($erreur == "") {
            $hachage = password_hash($password, PASSWORD_BCRYPT);
            $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(login, password) VALUES(?,?)"); // Prépare une requête à l'exécution et retourne un objet (PDO)
            $insertmbr->execute(array($login,$hachage)); // Exécute une requête préparée PDO
            $erreur = "Votre compte à été crée !"; 
            header('Location: connexion.php');
        }
    }
    else 
    {
        $erreur = "Tout les champs doivent être remplis !";
    }
    
}

?>

<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Inscription</title>
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
        <div align="center">
            <h2>Remplissez notre formulaire d'inscription</h2>
            <br /><br />
            <form method="POST" action="">
            <table>
                <tr class=test>
                    <td align="right">    
                    <label for="login">Login : </label>
                    </td>
                    <td>
                    <input type="text" placeholder="Votre login" name="login" id="login" value="<?php if(isset($login)) { echo $login; } ?>" >
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="password">Password : </label>
                    </td>
                    <td>
                    <input type="password" placeholder="Votre password" name="password" id="password">
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="password2">Confirmation du password : </label>
                    </td>
                    <td>
                    <input type="password" placeholder="Confirmation password" name="password2" id="password2">
                    </td>
                </tr>
            </table>
            <br />
            <input type="submit" name="forminscription" class="forminscription" value="Je m'inscris"><br><BR><br>
        </form>
        </form>

        <?php 
        if(isset($erreur))
        {
        echo '<font color="red">'.$erreur.'</font>'; 
        }
        ?>
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
    
</html>