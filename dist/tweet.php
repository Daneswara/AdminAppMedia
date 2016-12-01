<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
<script src="js/fire.js">
</script>
<?php
include "./ambildata.php";
$awal = microtime(true);
$query = array(
    "q" => "jokowi",
    "count" => 10
);
$results = search($query);
foreach ($results->statuses as $result) {
    ?><script>addTweet('<?php echo $result->id_str ?>', 'jokowi', '<?php echo $result->user->screen_name ?>')</script><?php
}
$akhir = microtime(true);
$lama = $akhir - $awal;

echo "<p>Lama eksekusi script adalah: " . $lama . " detik</p>";
?>
