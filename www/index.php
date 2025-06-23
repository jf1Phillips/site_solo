<?php
$root = '..';
require "$root/www/php_function/split_file.php";
require "$root/www/php_function/put_file_content.php";
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
    <link rel="stylesheet" type="text/css" href="styles/content_file.css"/>
    <link rel="stylesheet" type="text/css" href="styles/contact_us.css"/>
    <link rel="stylesheet" type="text/css" href="styles/general.css"/>
    <link rel="stylesheet" type="text/css" href="styles/menu.css"/>
    <script src="script/load_file.js" type="text/javascript"></script>
    <title>Solidarité Logement</title>
</head>
<body>
<!-- <body onload="getAllFile()"> -->
    <!-- MENU OF THE WEBSITE -->
    <div id="menu">
        <a href=<?=$index?> title="Solidarité Logement" id="logo">
            <img src="img/Solo.jpg" alt="Solidarité Logement" />
        </a>
        <div>
            <a href=<?=$index?> class="menuLink">L'Association</a>
            <a href="#wePropose" class="menuLink">Services</a>
        </div>

        <script>
            const header = document.getElementById('menu');
            window.addEventListener('scroll', () => {
                if (window.scrollY >= 20) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        </script>
    </div>
    <!-- END OF THE WEBSITE MENU -->

    <!-- CONTENT PAGE -->
    <div id="page_content">
        <?php
            $links = $pdo->query("SELECT link FROM text")->fetchAll(PDO::FETCH_COLUMN);
            $folder = $env['TEXT_FOLDER'];
            $id = 0;

            foreach ($links as $link) {
                put_file_content($link, $folder, $id);
                ++$id;
            }
        ?>
        <!-- <div id="whoWeAre">
            <div class="vertLine"></div>
            <p class="big_title">Qui sommes nous ?</p>
            <div class="contentInfo">
                <div>
                    <p class="title">Nos origines</p>
                    <p id="origines" class="putText text_file/Origines.txt greyText"></p>
                </div>
                <div>
                    <p class="title">Notre mission aujourd'hui</p>
                    <p id="mission" class="putText text_file/Mission.txt greyText"></p>
                </div>
                <div>
                    <p class="title">Notre méthode</p>
                    <p id="methode" class="putText text_file/Methode.txt greyText"></p>
                </div>
            </div>
        </div>

        <div id="wePropose">
            <div class="vertLine"></div>
            <p class="big_title">Ce que nous vous proposons</p>
            <div class="contentInfo">
                <div>
                    <p class="title">Titre</p>
                    <p id="propose" class="putText text_file/Propose.txt greyText"></p>
                </div>
            </div>
        </div> -->
    </div>
    <!-- END OF CONTENT PAGE -->

    <div id="contactUs">
        <div id="inlineContactUs">
            <p id="titleContactUs" class="greyText">Nous contacter</p>
            <p id="ourMail" class="greyText">Mail: <a href=<?="mailto:$contact"?>><?=$contact?></a></p>
        </div>
    </div>

</body>
<!-- <script>
    function getAllFile() {
        var all_p = document.getElementsByClassName("putText");

        for (i = 0; all_p[i]; i++) {
            listClass = all_p[i].classList;
            loadFile(listClass[1], all_p[i].id);
        }
    }
</script> -->
</html>