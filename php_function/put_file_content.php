<?php

function put_file_content($row, $img_folder) {
    $file_img = "$img_folder/".$row['link_img'];
    $title = $row["title"];
    $id = $row["id"];

    // extract content
    $break = "__PARAGRAPH_BREAK__";
    $content = str_replace($break, "</br></br>",
                str_replace("\n", " \n",
                str_replace("\n\n", $break, $row["content"])));

    if ($row['link_img'] != null) {
        echo "
        <div id='$id' class='scroll_class'>
            <p class='big_title'>$title</p>
            <div class='contentInfo'>
                <p class='greyText'>$content</p>
                <img src='$file_img' class='text_img'
                 style='height:{$row['height']}px;'/>
            </div>
        </div>
        ";
    } else {
        echo "
        <div id='$id' class='scroll_class'>
            <p class='big_title'>$title</p>
            <div class='contentInfo'>
                <p class='greyText'>$content</p>
            </div>
        </div>
        ";
    }
}
?>
