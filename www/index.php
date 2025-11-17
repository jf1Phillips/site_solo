<?php
// mdp require
// require "./mdp.php";
$root = '..';


require "$root/php_function/split_file.php";
require "$root/php_function/put_file_content.php";
require "$root/config.php";
$env = parse_ini_file(__DIR__."/$root/.env");

$index = $env["INDEX"];
$contact = $env["CONTACT_MAIL"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="Description" content="Aider les personnes en difficulté à résoudre leurs
    démarches face au problème du logement" />
    <meta name="Keywords" content="Solidarité Logement, Logement, Propriétaire,
    monde associatif, associations du 16eme arrondissement, 16eme arrondissement, Locataires, recherche logement, 
    Fonds de Solidarité pour le Logement" />
    <link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Manrope' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="styles/content_file.css"/>
    <link rel="stylesheet" type="text/css" href="styles/contact_us.css"/>
    <link rel="stylesheet" type="text/css" href="styles/general.css"/>
    <link rel="stylesheet" type="text/css" href="styles/menu.css"/>
    <link rel="stylesheet" type="text/css" href="styles/move_to_top.css"/>
    <title>Solidarité Logement</title>
</head>
<body>
    <!-- MENU OF THE WEBSITE -->
    <section id="menu">
        <a href=<?=$index?> title="Solidarité Logement" id="logo">
            <img src="img/Solo.jpg" alt="Solidarité Logement" />
        </a>
        <div>
            <?php
                $file = $root."/".$env['TEXT_FOLDER']."/".$env['TITLES_FILE'];
                $content = file($file);
                $id = 0;

                if (file_exists($file)) {
                    foreach ($content as $line) {
                        echo "<a href='#$id' class='menuLink'>$line</a>";
                        ++$id;
                    }
                }
            ?>
        </div>
    </section>
    <!-- END OF THE WEBSITE MENU -->

    <!-- CONTENT PAGE -->
    <section id="page_content">
        <?php
            $links = $pdo->query("SELECT link, link_img, height FROM text")->fetchAll(PDO::FETCH_ASSOC);
            $folder = $env['TEXT_FOLDER'];
            $img_folder = $env['IMG_FOLDER'];
            $id = 0;

            foreach ($links as $row) {
                put_file_content($row, $folder, $img_folder, $id);
                ++$id;
            }
        ?>
    </section>
    <!-- END OF CONTENT PAGE -->

    <!-- BUTTON TOP -->
    <div id="div_top_button">
        <a href="#0" id="moveToTop">^</a>
    </div>
    <!-- END BUTTON TOP -->
    <script>
            const header = document.getElementById('menu');
            const top_button = document.getElementById('div_top_button');
            window.addEventListener('scroll', () => {
                if (window.scrollY >= 20) {
                    header.classList.add('scrolled');
                    top_button.style.display = 'block';
                } else {
                    header.classList.remove('scrolled');
                    top_button.style.display = 'none';
                }
            });
    </script>

    <div class="contact-form">
        <h2>Nous contacter</h2>

        <form action="send.php" method="POST" id="contactForm">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required placeholder="Votre nom">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required placeholder="Votre adresse e-mail">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required placeholder="Votre message" rows="5"></textarea>
            </div>

            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
        <p class="form-status" id="formStatus"></p>
    </div>

</body>
</html>
