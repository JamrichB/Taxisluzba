<div class="container">
	<div class="row"><br></div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Detail záznamu <a href="<?php echo site_url('cesty/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
			<div class="panel-body">
				<div class="form-group">
					<label>ID:</label>
					<p><?php echo !empty($cesty['id'])?$cesty['id']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Datum:</label>
					<p><?php echo !empty($cesty['datum'])?$cesty['datum']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Trasa:</label>
					<p><?php echo !empty($cesty['trasa'])?$cesty['trasa']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Počet km:</label>
					<p><?php echo !empty($cesty['pocet_km'])?$cesty['pocet_km']:''; ?></p>
				</div>
				<div class="form-group">
					<label> Vodič správne:</label>
					<p><?php echo !empty($cesty['cely_vodic'])?$cesty['cely_vodic']:''; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
