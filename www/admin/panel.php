<?php exit(); ?>
<?php require '../../config.php'; ?>
<?php require '../../requests/post/mail_post.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel</title>
</head>
<body>
    <!-- START OF PANEL -->
    <div class="div_panel">
        <form action="" method="POST" id="admin-form">
            <input type="hidden" name="form_id" value="admin_mail_form">
            <fieldset>
                <legend>Admin panel</legend>
                <label for="name">Email</label>
                <input type="text" id="name" name="to" required>
                <label for="sub">Subject</label>
                <input type="text" id="sub" name="subject" required>
                <label for="cont">Content</label>
                <input type="text" id="cont" name="content" required>
            </fieldset>

            <button type="submit">Send Message</button>
        </form>
    </div>
    <!-- END OF ADMIN PANEL -->

    <?= $message ?>
</body>
</html>