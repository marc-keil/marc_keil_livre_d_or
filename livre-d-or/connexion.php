<?php
include('bdd.php');
session_start();

        if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
        {
            header("Location: profil.php");
        }




if(isset($_POST['formconnexion']))
{
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $passwordconnect = $_POST['passwordconnect'];
    // password_hash($_POST['passwordconnect'], PASSWORD_BCRYPT);
    if(!empty($loginconnect) AND !empty($passwordconnect))
        {
            $requeteutilisateur = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
            $requeteutilisateur->execute(array($loginconnect));   // Execute le prepare
            $result = $requeteutilisateur->fetchAll();   // Return TOUTE la requete ( tableau )
            if (count($result) > 0){ // S'il trouve pas de même login, il return mauvais login
                $sqlPassword = $result[0]['password'];  // Récupere le resultat du tableau (0)  /!\ SI PAS LE 0 ça marche pas /!\ et la colonne password
                if(password_verify($passwordconnect, $sqlPassword)) // Si passwordconnect est hashé et qu'il est pareil que sql password c'est bon 
                    {
                    $_SESSION['id'] = $result[0]['id'];
                    $_SESSION['login'] = $result[0]['login'];
                    $_SESSION['nom'] = $result[0]['nom'];
                    $_SESSION['prenom'] = $result[0]['prenom'];
                    header("Location: profil.php");
                    
                    }
                else 
                    {
                    $erreur = "Mauvais mot de passe !";
                    }
            }
            else
                $erreur = "Mauvais login !";
        }
    else
        {
         $erreur = "Tous les champs doivent être remplis !";
        }
}




?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Connexion</title>
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
            <h2>Connexion</h2>
            <br /><br />
            <form method="POST" action="" class="patate">
            <label for="loginconnect">Login :</label><br>
            <input type="text" name="loginconnect" placeholder="Login"><BR><BR>
            <label for="password">Password :</label><br>
            <input type="password" name="passwordconnect" placeholder="Password">
            <br /><br />
            <input type="submit" name="formconnexion" class="formconnexion" value="Se connecter !"><br><BR><br>
        </form>

   
        <?php 
        if(isset($erreur))
        {
        echo '<font color="red">'.$erreur.'</font><br><br>';
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