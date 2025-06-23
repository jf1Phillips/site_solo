<?php
function split_file($path): array {
    $break = "__PARAGRAPH_BREAK__";

    if (!file_exists($path)) {
        return ["", ""];
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if (!$lines || count($lines) === 0) {
        return ["", ""];
    }
    $title = $lines[0];
    $content = substr(file_get_contents($path), strlen($title));
    $content = str_replace($break, "</br></br>",
                str_replace("\n", " \n",
                str_replace("\n\n", $break, $content)));
    return [$title, $content];
}
?>
