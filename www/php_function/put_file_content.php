<?php
function put_file_content($row, $folder, $img_folder, $id) {
    global $root;
    $link = $row['link'];
    $link_img = $row['link_img'];
    $file = "$root/$folder/$link";
    $file_img = "$img_folder/$link_img";

    if (!file_exists($file))
        return;
    $array = split_file($file);
    if ($link_img != null) {
        echo "
        <div id='$id' class='scroll_class'>
            <p class='big_title'>$array[0]</p>
            <div class='contentInfo'>
                <p class='greyText'>$array[1]</p>
                <img src='$file_img' class='text_img'/>
            </div>
        </div>
        ";
    } else {
        echo "
        <div id='$id' class='scroll_class'>
            <p class='big_title'>$array[0]</p>
            <div class='contentInfo'>
                <p class='greyText'>$array[1]</p>
            </div>
        </div>
        ";
    }
}
?>
