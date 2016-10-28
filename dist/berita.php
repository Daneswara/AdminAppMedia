<?php

require 'simple_html_dom.php';

// Create DOM from URL or file
$html = file_get_html('http://filkom.ub.ac.id/');

// Find all images 
$element = $html->find('div[class=col-md-6 col-md-pull-6]', 0);
foreach ($element->find('div') as $berita) {
    if ($berita->class == "cards-body") {
        foreach ($berita->find('a') as $link) {
            echo $link->href . '<br>';
            konten($link->href);
        }
    }
}

function konten($url) {
    $target = file_get_html($url);
    echo $target->find('h1[class=title-content margin-top-no margin-bottom-no font-raleway font-orange padding-bottom-no]', 0)->plaintext;
    echo "<br>";
}
?>
