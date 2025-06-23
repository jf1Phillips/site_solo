<?php
function put_file_content($link, $folder, $id) {
    global $root;
    $file = "$root/$folder/$link";
    if (!file_exists($file))
        return;
    $array = split_file($file);
    echo "
    <div id='$id'>
        <p class='big_title'>$array[0]</p>
        <div class='contentInfo'>
            <p class='greyText'>$array[1]</p>
        </div>
    </div>
    ";
}
?>
