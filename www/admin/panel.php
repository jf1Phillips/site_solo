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
</head>
<body>
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
    </section>
    <!-- END OF CONTENT PAGE -->
</body>
</html>
