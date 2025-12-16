<?php
$root = '..';

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
    <meta name="description" content="Solidarité Logement accompagne les jeunes travailleurs et étudiants en alternance à Paris dans leur recherche de logement. Association d’intérêt général depuis 40 ans, nous mettons en place un soutien personnalisé pour aider les jeunes à trouver un logement stable, sécurisé et adapté à leurs besoins. Propriétaires et bénévoles partenaires, rejoignez un projet solidaire pour soutenir la jeunesse dans ses premiers pas professionnels.">
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
    <link rel="canonical" href="https://www.solidarite-logement.org/">
    <link rel="icon" href="img/icon/icon.ico" type="image/x-icon">
    <title>Solidarité Logement - Association jeunes travailleurs</title>

    <!-- for send -->
    <meta property="og:title" content="Solidarité Logement - Accompagnement des jeunes travailleurs à Paris">
    <meta property="og:description" content="Depuis 40 ans, Solidarité Logement aide les jeunes travailleurs et étudiants en alternance à trouver un logement stable et sécurisé à Paris.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.solidarite-logement.org/">
    <meta property="og:image" content="https://www.solidarite-logement.org/img/Solo.jpg">
</head>
<body>
    <!-- MENU OF THE WEBSITE -->
    <section id="menu">
        <a href=<?=$index?> title="Solidarité Logement" id="logo">
            <img src="img/Solo.jpg" alt="Solidarité Logement" />
        </a>
        <div>
            <?php
                // $file = $root."/".$env['TEXT_FOLDER']."/".$env['TITLES_FILE'];
                // $content = file($file);
                // $id = 0;

                // if (file_exists($file)) {
                //     foreach ($content as $line) {
                //         echo "<a href='#$id' class='menuLink'>$line</a>";
                //         ++$id;
                //     }
                // }
            ?>
        </div>
    </section>
    <!-- END OF THE WEBSITE MENU -->

    <!-- CONTENT PAGE -->
    <section class="contentAndContact">
        <section id="page_content">
            <?php
                $links = $pdo->query("SELECT id, title, content, link_img, height FROM text")->fetchAll(PDO::FETCH_ASSOC);

                foreach ($links as $row) {
                    put_file_content($row, $env["IMG_FOLDER"]);
                }
            ?>
        </section>
        <!-- contact us section -->
        <div class="contact-form">
            <h2>Nous contacter</h2>
            <form action="" method="POST" id="contactForm">
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
                    <textarea id="message" name="content" required placeholder="Votre message" rows="5"></textarea>
                </div>
                <button type="submit" class="btn-submit">Envoyer</button>
            </form>
            <p class="form-status" id="formStatus"></p>
        </div>
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
    <style>
        .dots::after {
            content: "";
            animation: dotty 0.8s steps(4) infinite;
        }

        @keyframes dotty {
            0%   { content: ""; }
            25%  { content: "."; }
            50%  { content: ".."; }
            75%  { content: "..."; }
            100% { content: ""; }
        }

    </style>

    <script>
        const form = document.getElementById('contactForm');
        const status = document.getElementById('formStatus');
        const sendBtn = document.querySelector('.btn-submit');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            sendBtn.classList.add('dots');
            try {
                const response = await fetch('/send.php', {
                    method: 'POST',
                    body: formData
                });
                const text = await response.text();
                if (text.trim() === 'OK') {
                    status.textContent = "Message envoyé !";
                    status.style.color = "green";
                    form.reset();
                } else {
                    status.textContent = "Erreur : " + text;
                    status.style.color = "red";
                }
            } catch (err) {
                status.textContent = "Erreur réseau.";
                status.style.color = "red";
            }
            sendBtn.classList.remove('dots');
        });

    </script>

</body>
</html>
