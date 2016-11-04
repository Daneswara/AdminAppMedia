<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script src="js/fire.js">
</script>
<?php
$awal = microtime(true);
require 'simple_html_dom.php';

// Detik.com
try {
    $html = file_get_html('http://news.detik.com/');
    $element = $html->find('a[data-action=Newsfeed / NHL]', 6);
    $url = $element->href;

    $html = file_get_html('http:' . $element->href);
//judul
    $berita = $html->find('article', 0);
    $judul = $berita->find('h1', 0)->plaintext;
// gambar
    $gambar = $berita->find('div[class=pic_artikel]', 0);
    $image = $gambar->find('img', 0)->src;
// berita
    $isi = $berita->find('div[class=detail_text]', 0)->plaintext;
    $isiberita = str_replace("
", "<br>", $isi);

    // tambah ke firebase
    ?>
    <script>
        tambahBerita('Detik.com', '<?php echo $url ?>', '<?php echo $judul ?>', '<?php echo $image ?>', '<?php echo $isiberita ?>');
    </script>
    <?php
} catch (Exception $e) {
    echo 'Error Detik.com: ' . $e->getMessage();
}


/**
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
 * */
$akhir = microtime(true);
$lama = $akhir - $awal;
echo "<p>Lama eksekusi script adalah: " . $lama . " detik</p>";
?>
