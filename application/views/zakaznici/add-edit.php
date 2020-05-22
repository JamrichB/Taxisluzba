<div class="container">
	<div class="row"><br></div>
	<div class="col-xs-12">
		<?php
		if(!empty($success_msg)){
			echo '<div class="alert alert-success">'.$success_msg.'</div>';
		}elseif(!empty($error_msg)){
			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
		}
		?>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php //echo $action; ?> Zakazníci <a href="<?php echo site_url('zakaznici/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
				<div class="panel-body">
					<form method="post" action="" class="form">
						<div class="form-group">
							<label for="title">Platba</label>
							<input type="text" class="form-control" name="platba" id="platba" placeholder="Vložte platbu" value="<?php echo !empty($post['platba'])?$post['platba']:''; ?>">
							<?php echo form_error('platba','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="title">Auto správne</label>
							<?php echo form_dropdown('id_cesty', $cesty, $vybrana_cesta, 'class="form-control"'); ?>
							<?php echo form_error('id_cesty','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<input type="submit" name="postSubmit" class="btn btn-primary" value="Poslať"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
