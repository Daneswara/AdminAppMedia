<?php
	
	function tokenisasi($query){
		$hapusini = array("`", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "=", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", ",", ".", "/", "'", ";", "[", "]", "\\", "<", ">", "?", ":", "\"", "{", "}", "|");
		$arrlength = count($query->statuses);
		$hasil = array(100);
		for($x = 0; $x < $arrlength; $x++) {
			$hasil[$x] = strtolower($query->statuses[$x]->text);
			$hasil[$x] = preg_replace("/[^A-Za-z0-9 .]/", '', $hasil[$x]);
		}
		
		$hasil = str_replace($hapusini, "", $hasil);
		$hasil = str_replace(" - ", " ", $hasil);
		$hasil = str_replace("- ", " ", $hasil);
		$hasil = str_replace(" -", " ", $hasil);
		$hasil = str_replace("\n", " ", $hasil);
		$hasil = str_replace("  ", " ", $hasil);
		return $hasil;
	}
	function filterring($teksTemp){
		$stop = file_get_contents('stop.txt');
		$stopword = explode("\n", $stop);
		
		$twet = $teksTemp;
		$jml = count($twet);
		for ($i = 0; $i < $jml; $i++) {
			$kalimat = explode(" ", $twet[$i]);
			$jmlkal = count($kalimat);
			for($j = 0; $j < $jmlkal; $j++) {
				if (in_array($kalimat[$j], $stopword)) {
					unset($kalimat[$j]);
				}
			}
			$twet[$i] = implode(" ", $kalimat);
		}
		return $twet;
	}
	function steaming($query){
		
	}
?>