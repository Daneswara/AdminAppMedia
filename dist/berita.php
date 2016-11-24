<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script src="js/fire.js">
</script>
<?php
$awal = microtime(true);
$jumlahberita = 0;
$log = "";
require 'simple_html_dom.php';

detikcom();
islampos();
$akhir = microtime(true);
$lama = $akhir - $awal;
saveHistory();
echo "<p>Lama eksekusi script adalah: " . $lama . " detik</p>";

function detikcom() {
    // Detik.com
    try {
        $html = file_get_html('https://news.detik.com/indeks');
        $element = $html->find('div[class=desc_idx ml10]', 2);
        $url = $element->find('a', 0)->href;

        $html = file_get_html($url);
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
        $isiberita = addslashes($isiberita);
        // tambah ke firebase
        ?>
        <script>
            url = '<?php echo $url ?>';
            //url = "//news.detik.com/berita/d-3337148/pungli-di-pelabuhan-kemenhub-tangkap-saja";
            cariLink(function(carilink) {
                // Do some calculations
                if (carilink == 0) {
                    console.log("Tidak ada");
                    tambahBerita('Detik.com', '<?php echo $url ?>', '<?php echo $judul ?>', '<?php echo $image ?>', '<?php echo $isiberita ?>');
        <?php
        global $jumlahberita;
        $jumlahberita+= 1;
        ?>
                } else {
                    console.log("URL Detik sudah pernah disimpan");
                }
            }, url);

        </script>
        <?php
    } catch (Exception $e) {
        global $log;
        $log = 'Error Detik.com: ' + $e->getMessage() + '<br>';
    }
}

function islampos() {
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
        $isiberita = "";
        foreach ($element2->find('p[!class]') as $berita) {
            $isiberita = $isiberita . $berita->plaintext . "<br><br>";
        }
        $isiberita = str_replace("
", "<br>", $isiberita);
        $isiberita = addslashes($isiberita);
        $query3 = $html2->find('div[id=post-feat-img]', 0);
        $image = $query3->find('img', 0)->src;
        // tambah ke firebase
        ?>
        <script>
            url = '<?php echo $url ?>';
            //url = "//news.detik.com/berita/d-3337148/pungli-di-pelabuhan-kemenhub-tangkap-saja";
            cariLink(function(carilink) {
                // Do some calculations
                if (carilink == 0) {
                    console.log("Tidak ada");
                    tambahBerita('Islampos.com', '<?php echo $url ?>', '<?php echo $judul ?>', '<?php echo $image ?>', '<?php echo $isiberita ?>'.trim());
        <?php
        global $jumlahberita;
        $jumlahberita+= 1;
        ?>
                } else {
                    console.log("URL Islampos sudah pernah disimpan");
                }
            }, url);

        </script>
        <?php
    } catch (Exception $e) {
        global $log;
        $log = 'Error Islampos.com: ' + $e->getMessage() + '<br>';
    }
}

function saveHistory() {
    global $jumlahberita, $lama, $log;
    ?><script>
            addHistoryBerita('<?php echo $jumlahberita ?>', 0, 'Sukses', '<?php echo $lama ?>', '<?php echo $log ?>');
    </script><?php
}
?>
