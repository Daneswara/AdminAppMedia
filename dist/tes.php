<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script src="js/fire.js">
</script>
<?php
$awal = microtime(true);
require 'simple_html_dom.php';

// Islampos.com
try {
    
    $html = file_get_html('https://www.islampos.com/');
    $element = $html->find('li[class=infinite-post]', 0);
    $query1 = $element->find('a', 0);
    $url = $query1->href;
    $query2 = $element->find('h2', 0)->plaintext;
    $judul = $query2;
    $html2 = file_get_html($url);
    $element2 = $html2->find('div[id=content-main]', 0);
    $isi = "";
    foreach ($element2->find('p[!class]') as $berita) {
        $isi = $isi.$berita->plaintext."<br><br>";
    }
    $query3 = $html2->find('div[id=post-feat-img]', 0);
    $gambar = $query3->find('img', 0)->src;
    echo $url."<br>";
    echo $judul."<br>";
    echo $gambar."<br>";
    echo $isi;
    
    // tambah ke firebase
    ?>
    <script>
                
        </script>
    <?php
} catch (Exception $e) {
    echo 'Error Islampos.com: ' . $e->getMessage();
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
