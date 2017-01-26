<?php include ROOT . '/views/layouts/header.php'; ?>
<?php 



	foreach ($listObjSql as $key =>$value ) {
		echo 
		'<div class="dialog">
			<h2 class="title">'.$value['nameUser'].'(<span>'.$value['date'].'</span>)</h2>
			'.$value['email'].'
			<div class="content">&nbsp'.$value['message'].'</div>
		</div></br>';
	}
?>
<?php include ROOT . '/views/layouts/footer.php'; ?>