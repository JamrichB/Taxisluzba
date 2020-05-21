<div class="container">
	<div class="row"><br></div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Detail záznamu <a href="<?php echo site_url('vodici/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
			<div class="panel-body">
				<div class="form-group">
					<label>ID:</label>
					<p><?php echo !empty($vodici['id_vodici'])? $vodici['id_vodici']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Meno:</label>
					<p><?php echo !empty($vodici['meno'])? $vodici['meno']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Priezvisko:</label>
					<p><?php echo !empty($vodici['priezvisko'])? $vodici['priezvisko']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Auto správne:</label>
					<p><?php echo !empty($vodici['cele_auto'])? $vodici['cele_auto']:''; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
