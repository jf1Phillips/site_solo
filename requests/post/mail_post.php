<?php
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["form_id"]) &&
            $_POST["form_id"] === "admin_mail_form") {
        $to = escapeshellarg($_POST['to']);
        $subject = escapeshellarg($_POST['subject']);
        $content = escapeshellarg($_POST['content']);

        // Exécute le script Python
        $output = shell_exec("python3 ../../send_mail.py $to $subject $content");
        $message = "<p>" . $output . "</p>";
    }
?>
