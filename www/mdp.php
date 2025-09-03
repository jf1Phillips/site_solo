<?php
$root = '..';

$env = parse_ini_file(__DIR__ . "/$root/.env");
$mdp_check = $env["MDP_ENTER"];

if (!isset($_POST['password']) || $_POST['password'] !== $mdp_check) {
    ?>
    <form method="POST">
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">Entrer</button>
    </form>
    <?php
    exit;
}
?>
