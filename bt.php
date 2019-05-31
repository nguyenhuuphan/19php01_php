<?php

echo "<h1>1</h1>";

$count = 0;
$qt5 = $qt2 = $qt1 = 1;
$qt5*5 + $qt1*1 + $qt2*2 == 100;
for ($qt5=1; $qt5 <= 100 ; $qt5++) { 
	for($qt1 = 1; $qt1 <=100; $qt1++){
		if($qt5*5 + $qt1*1 <= 100) {
			echo $count . '-----' . $qt5 . " tờ 50.000, " . $qt2 . " tờ 20.000, " . (100 - 5*$qt5 - 2*$qt2) . " tờ 10.000" . "<br>";
                $count++;
		}
	}
}

echo $count;



echo "<h1>2</h1>";

$von = 20000000;
$laimoithang = $von * 0.006;
$tonglai = $laimoithang * 36;
$ketqua = $von + $tonglai;
echo $ketqua;

echo "<h1>3</h1>";

$von = 150000000;
$laimoithang = $von * 0.007;
$tonglai = $laimoithang * 36;
$tong = $von + $tonglai;
$k = 1;
echo $tong . "<br>";
for ($i=1; $i <= 36 ; $i++) { 
	if($i%3==0) {
		$tong = $tong - (3000000 + $k*1000000);
		echo $k . '-----------' . $tong; echo "<br>";
		$k++;
	}
}
echo $tong;