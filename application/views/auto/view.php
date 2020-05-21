<div class="container">
	<div class="row"><br></div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Detail záznamu <a href="<?php echo site_url('auto/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
			<div class="panel-body">
				<div class="form-group">
					<label>ID:</label>
					<p><?php echo !empty($auto['id_auto'])?$auto['id_auto']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Znacka:</label>
					<p><?php echo !empty($auto['znacka'])?$auto['znacka']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Model:</label>
					<p><?php echo !empty($auto['model'])?$auto['model']:''; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
