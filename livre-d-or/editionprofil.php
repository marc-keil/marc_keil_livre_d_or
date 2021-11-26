<?php
session_start();
include('bdd.php');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    // $getid = intval($_SESSION['id']);
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();
	if(isset($_POST['submit']) && $_POST['submit'] == 1) {

		  if(isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login'])
		{
			$login= $_POST['newlogin']; 
			$requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
			$requetelogin->execute(array($login));
			$loginexist = $requetelogin->rowCount(); // rowCount = Si une ligne existe = PAS BON

			if($loginexist !== 0) 
			{
				$msg = "Le login existe déjà !";
			}
			else 
			{
			$newlogin = htmlspecialchars($_POST['newlogin']);
			$insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
			$insertlogin->execute(array($newlogin, $_SESSION['id']));
			header('Location: profil.php');
			}
		}	
	 if(!$_POST['newmdp'] || !$_POST['newmdp2'])
    {
    $msg = "Champs du mot de passe vide";
    }

    if(isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2']))
    {
    
       $mdp1 = $_POST['newmdp'];
       $mdp2 = $_POST['newmdp2'];
        
        if($mdp1 == $mdp2)
        {
            $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
            $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertmdp->execute(array($hachage, $_SESSION['id']));
            header('Location: profil.php');
        }
        else
        {
            $msg = "Vos mots de passes ne correspondent pas !";
        }
    
    }
 
    
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylessss.css">
    <title>Edition profil</title>
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
        <div align="center">
            <h2>Edition de mon profil</h2>
            <br />
            <form method="POST" action="">
			<input id="hidden" name="submit" type="hidden" value= 1>
            <table>
                <tr>
                    <td class=test align="right">    
                    <label for="login">Login :</label><br /><br />
                    </td>
                    <td class=test>
                    <input type="text" name="newlogin" placeholder="Login" value="<?php echo $infoutilisateur['login']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="newmdp">Password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp" placeholder="Mot de passe" > <br /><br />
                    </td>
                    </tr>
                    <td class=test align="right">    
                    <label for="newmdp2">Confirmation du password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp2" placeholder="Confirmation mot de passe" > <br /><br />
                    </td>
                </tr>
            </table>
            
            <?php 
        if(isset($msg))
        {
        echo '<font color="red">'.$msg.'</font><br /><br />'; 
        }
        ?>	
			<form method="POST" action="">
            <input type="submit" class ="formconnexion"name="confirmation" value="Confirmé !">
			</form>
            <br><br>
		<a href="profil.php" class ="formconnexion">Retour</a><br><br><br>

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
else 
{
header("Location: connexion.php");
}

?>