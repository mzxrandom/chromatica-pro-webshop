<?php 
	require_once 'jezgra/init.php';
	include 'dijelovi/zaglavlje.php';
	include 'dijelovi/navigacija.php';
	include 'dijelovi/baner.php';
	include 'dijelovi/lijeva_traka.php';

	$istaknutiProizvodi = $db->query("SELECT * FROM proizvodi WHERE istaknuto = 1 ORDER BY RAND()");
	$brojPr = mysqli_num_rows($istaknutiProizvodi);
?>
	
<div class="col-md-8">
	<div class="row">
		<h2 class="text-center">Istaknuti Proizvodi</h2>
		<?php while ($proizvod = mysqli_fetch_assoc($istaknutiProizvodi)) : 
			$marka_id = $proizvod['marka'];
			$marka = mysqli_fetch_assoc($db->query("SELECT marka FROM marke WHERE id = '$marka_id'"));
		?>
			<div class="col-md-4 text-center proizvod-thumb">
				<h4><?= $proizvod['naziv_proizvoda'] . ' - ' . $marka['marka']; ?></h4>
				<?php $fotke = explode(',', $proizvod['slika']); ?>
				<img src="<?= $fotke[0]; ?>" alt="<?= $proizvod['naziv_proizvoda']; ?>" class="slika-thumb">
				<p class="cijena"><?= novac($proizvod['cijena']); ?></p>
				<button type="button" class="btn btn-small btn-info" onclick="detaljiSkocniProzor(<?= $proizvod['id']; ?>)">Više o proizvodu</button>
			</div>
		<?php endwhile; ?>

		<?php if ($brojPr == 0) : ?>
			<h5 class="text-center" style="margin-top: 80px;">Nema proizvoda</h5>
		<?php endif; ?>
	</div>
</div>

<?php
	include 'dijelovi/desna_traka.php';
	include 'dijelovi/podnozje.php';
?>