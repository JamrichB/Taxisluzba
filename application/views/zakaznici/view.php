<div class="container">
	<div class="row"><br></div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Detail záznamu <a href="<?php echo site_url('zakaznici/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
			<div class="panel-body">
				<div class="form-group">
					<label>ID:</label>
					<p><?php echo !empty($zakaznici['id'])?$zakaznici['id']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Platba:</label>
					<p><?php echo !empty($zakaznici['platba'])?$zakaznici['platba']:''; ?></p>
				</div>
				<div class="form-group">
					<label>Cesta správne:</label>
					<p><?php echo !empty($zakaznici['cela_cesta'])?$zakaznici['cela_cesta']:''; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

