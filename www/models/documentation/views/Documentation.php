<?php
require_once "../../../includes/Session.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once "../../../includes/Style.php";
    require_once "../../../includes/Scripts.php";
    ?>
    <script type="text/javascript" src="../controllers/DeleteDocumentation.js" defer></script>
    <title>Documentation</title>
</head>

<body>
    <?php
    require_once "../../../includes/Navbar.php";
    require_once "../../../data/mysql/includes/Database.php";
    require_once "../../../includes/Util.php";
    require_once "../data/UserDocumentation.php";
    require_once "../data/UserDocumentationHistory.php";
    require_once "../data/InstallDocumentation.php";
    require_once "../data/InstallDocumentationHistory.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="test-content col-12">
                <div class="user-doc">
                    <div class="sprint-title">Documentation utilisateur</div>
                    <?php
                    $database = new Database();
                    $db       = $database->getConnection();

                    $user_documentation = new UserDocumentation($db);
                    $user_documentation->read();
                    if (empty($user_documentation->path) == 1) {
                        echo '<form action="../controllers/UploadUserDocumentation.php" method="post" enctype="multipart/form-data">
                        <input class="btn btn-secondary" type="file" name="user_documentation" id="user_documentation" accept="pdf">
                        <button class="btn btn-primary" type="submit" value="Valider" name="submit"><i class="fas fa-check"></i>Valider</button>
                      </form>';
                    } else {
                        echo "<div> Fichier de documentation utilisateur actif : <b>" . explode("/", $user_documentation->path)[sizeof(explode("/", $user_documentation->path)) - 1] . "</b></div>";
                        echo "<button class='delete-documentation btn btn-danger'><i class='fas fa-trash-alt'></i>Supprimer</button>";
                        echo "<a href='" . $user_documentation->path . "' download><button class='btn btn-primary'><i class='fas fa-download'></i>Télécharger</button></a>";
                    }
                    ?>
                        <?php
                        $user_documentation_history = new UserDocumentationHistory($db);
                        $histories = $user_documentation_history->get();
                        if (empty($histories) != 1) {
                            echo '<div class="history">';
                            foreach ($histories as $history) {
                                $filename = explode("/", $history["path"])[sizeof(explode("/", $history['path'])) - 1];
                                echo
                                    "<div>
                            <form action='../controllers/UsePreviousUserDocumentation.php?path=" . $history['path'] . "' method='post' enctype='multipart/form-data'>
                            <div><span class='historic-file-name'><b>" . $filename . "</b> (" . explode(" ", $history['date'])[0] . ")<a href='".$history['path']."'></span><button type='button' class='btn btn-secondary'><i class='fas fa-download'></i>Télécharger</button></a><button class='btn btn-primary' type='submit' name='submit'><i class='fas fa-upload'></i> Réutiliser</button></div>
                            </form>
                        </div>";
                            }
                            echo "</div>";
                        }

                        ?>
                    </div>
            <div class="install-doc">
                <div class="sprint-title">Documentation d'installation</div>
                <?php

                $install_documentation = new InstallDocumentation($db);
                $install_documentation->read();
                if (empty($install_documentation->path) == 1) {
                    echo '<form action="../controllers/UploadInstallDocumentation.php" method="post" enctype="multipart/form-data">
    <input type="file" class="btn btn-secondary" name="install_documentation" id="install_documentation" accept="pdf">
    <button class="btn btn-primary" type="submit" value="Valider" name="submit"><i class="fas fa-check"></i>Valider</button>
  </form>';
                } else {
                    echo "<div> Fichier de documentation d'installation actif : <b>" . explode("/", $install_documentation->path)[sizeof(explode("/", $install_documentation->path)) - 1] . "</b></div>";
                    echo "<button class='delete-documentation btn btn-danger'><i class='fas fa-trash-alt'></i>Supprimer</button>";
                    echo "<a href='" . $install_documentation->path . "' download><button class='btn btn-primary'><i class='fas fa-download'></i>Télécharger</button></a>";
                }
                ?>
                    <?php

$install_documentation_history = new InstallDocumentationHistory($db);
$histories = $install_documentation_history->get();
if (empty($histories) != 1) {
                        echo '<div class="history">';
                        foreach ($histories as $history) {
                            $filename = explode("/", $history["path"])[sizeof(explode("/", $history['path'])) - 1];
                            echo
                                "<div>
                            <form action='../controllers/UsePreviousInstallDocumentation.php?path=" . $history['path'] . "' method='post' enctype='multipart/form-data'>
                        <div><span class='historic-file-name'><b>" . $filename . "</b> (" . explode(" ", $history['date'])[0] . ")<a href='".$history['path']."'></span><button type='button' class='btn btn-secondary'><i class='fas fa-download'></i>Télécharger</button></a><button class='btn btn-primary' type='submit' name='submit'><i class='fas fa-upload'></i> Réutiliser</button></div>
                        </form>
                        </div>";
                        }
                        echo '<div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>