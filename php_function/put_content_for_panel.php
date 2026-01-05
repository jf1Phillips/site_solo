<?php
function put_content_for_panel($row, $img_folder) {
    $file_img = "$img_folder/".$row['link_img'];
    $title = $row["title"];
    $id = $row["id"];

    // extract content
    $break = "__PARAGRAPH_BREAK__";
    $content = str_replace($break, "</br></br>",
                str_replace("\n", " \n",
                str_replace("\n\n", $break, $row["content"])));

    $between = $row["link_img"] != null ? "
        <p class='big_title'>$title</p>
        <div class='contentInfo'>
            <p class='greyText'>$content</p>
            <img src='$file_img' class='text_img'
                style='height:{$row['height']}px;'/>
        </div>
    " : "
        <p class='big_title'>$title</p>
        <div class='contentInfo'>
            <p class='greyText'>$content</p>
        </div>
    ";

    echo "
    <div class='editableDiv'>
        <button class='deleteEditableDiv' onclick='deleteDiv($id)'>
            <span></span>
            <span></span>
        </button>
        <div id='$id' class='scroll_class'>
            $between
        </div>
    </div>
    ";
}
?>
