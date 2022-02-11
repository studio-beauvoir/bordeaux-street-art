<?php
////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteStatut.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Del accents sur string
require_once __DIR__ . '/../../util/delAccents.php';

// Insertion classe Statut
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php'; 

// Instanciation de la classe Statut
$monStatut = new STATUT(); 

// Ctrl CIR
// Insertion classe User
require_once __DIR__ . '/../../CLASS_CRUD/user.class.php';
// Instanciation de la classe User
$monUser = new USER();

// Insertion classe Membre
//require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
// Instanciation de la classe Membre
//$monMembre = new MEMBRE();

// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // controle des saisies du formulaire
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }
    // modification effective du statut
    $idStat = ctrlSaisies($_POST['id']);
    $monStatut->delete($idStat);
    // header("Location: ./deleteStatut.php");
    header("Location: ./statut.php");

    // Gestion des erreurs => msg si saisies ko
    $erreur = true;
    $errSaisies =  "Erreur, la saisie est obligatoire !";


    // A faire dans un 2ème temps
    // Ctrl CIR : inexistence Foreign Key => del possible




}   // End of if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initStatut.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Statut</h1>
    <h2>Suppression d'un statut</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET
    $statut = $monStatut->get_1Statut($_GET['id']);

    $libStat = $statut['libStat'];

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Statut...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libStat"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat ?>" disabled="disabled" />
        </div>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="./statut.php" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;">Annuler</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;"/>
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    <br>
    <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i>
<?php
require_once __DIR__ . '/footerStatut.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
