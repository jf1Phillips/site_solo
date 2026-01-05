<?php 
require '../../config.php';
require '../../php_function/put_content_for_panel.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="../styles/content_file.css"/>
    <link rel="stylesheet" type="text/css" href="../styles/contact_us.css"/>
    <link rel="stylesheet" type="text/css" href="../styles/general.css"/>
    <link rel="stylesheet" type="text/css" href="../styles/menu.css"/>
    <link rel="stylesheet" type="text/css" href="../styles/move_to_top.css"/>
    <link rel="stylesheet" type="text/css" href="../styles/admin_panel.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Manrope' rel='stylesheet'>
</head>
<body>
    <div class="modal-overlay hidden">
        <div class="confirmDelete">
            <p>Cette action est irréversible</p>
            <div>
                <button onclick="removePopup()">Annuler</button>
                <button>Supprimer</button>
            </div>
        </div>
    </div>
    <!-- CONTENT PAGE -->
    <section class="contentAndContact">
        <section id="page_content">
            <?php
                $links = $pdo->query("SELECT id, title, content, link_img, height FROM text")->fetchAll(PDO::FETCH_ASSOC);

                foreach ($links as $row) {
                    put_content_for_panel($row, "../".$env["IMG_FOLDER"]);
                }
            ?>
        </section>
        <script>
            const popup = document.querySelector('.modal-overlay');
            function deleteDiv(index) {
                popup.classList.remove("hidden");
                console.log(index);
            }
            function removePopup() {
                popup.classList.add("hidden");
            }
        </script>
    </section>
    <!-- END OF CONTENT PAGE -->
</body>
</html>
