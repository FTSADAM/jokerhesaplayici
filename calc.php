<?php

$names = $_POST['partnerName'];
$prices = $_POST['partnerPrice'];


for ($i=0; $i < count($prices); $i++) {
	$total += $prices[$i];
}

if ($total >= 30 && $total < 40){
		$discount = "30 yerine 20 tl öde";
		$calc = number_format($total,2) % 30 + fmod($total, 1);
		$disTotal = 20 + number_format($calc,2);
}else if ($total >= 40 && $total < 70){
		$discount = "40 yerine 25 tl öde";
		$calc = floatval($total) % 40 + fmod($total, 1);
		$disTotal = 25 + number_format($calc,2);
}else if ($total >= 70 && $total < 120){
		$discount = "70 yerine 45 tl öde";
		$calc = number_format($total,2) % 70 + fmod($total, 1);
		$disTotal = 45 + number_format($calc,2);
}else if ($total >= 120){
		$discount = "120 yerine 75 tl öde";
		$control = $total/120;

		if ($control > 1){
			$disTotal = number_format($total,2) - 45;
		}else {
			$calc = number_format($total,2) % 120 + fmod($total, 1);
			$disTotal = 75 + number_format($calc,2);
		}
}
	echo '
	<div id="modalContent">

	<ul>
		<li>Toplam tutar: <strong>'.$total.'</strong></li>
		<li>Uygulanan joker indirimi: <strong>'.$discount.'</strong></li>
		<li>Joker uygulanmış toplam tutar: <strong>'.number_format($disTotal,2).'</strong></li>
		<li>Joker uygulanmış ve yuvarlanmış toplam tutar: <strong>'.number_format($disTotal,0).'</strong></li>
	</ul>




	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>İsim</th>
				<th>Yeni ücret</th>
				<th>Yeni ücret - yuvarlanmış</th>
				<th>Joker olmadan</th>
				<th>Kazanç</th>
				<th>Yüzde</th>
			</tr>
		</thead>
		<tbody>';

for ($i=0; $i < count($names); $i++) {
			$newprice = $disTotal * $prices[$i] / $total;
			$gain = $prices[$i] - $newprice;
			$percent = $newprice * 100 / $disTotal;
			echo '<tr>
				<td>'.$names[$i].'</td>
				<td>'.number_format($newprice,2).'</td>
				<td>'.number_format($newprice,0).'</td>
				<td>'.number_format($prices[$i],2).'</td>
				<td>'.number_format($gain,2).'</td>
				<td>% '.number_format($percent,2).'</td>
						</tr>';
		}


				echo '</tbody>
	</table>
	          </div>';
?>
