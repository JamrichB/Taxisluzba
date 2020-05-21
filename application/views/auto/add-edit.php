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
				<div class="panel-heading"><?php echo $action; ?> Autá <a href="<?php echo site_url('auto/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
				<div class="panel-body">
					<form method="post" action="" class="form">
						<div class="form-group">
							<label for="title">Znacka</label>
							<input type="text" class="form-control" name="znacka" id="znacka" placeholder="Vložte značku auta" value="<?php echo !empty($post['znacka'])?$post['znacka']:''; ?>">
							<?php echo form_error('znacka','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="title">Model</label>
							<input type="text" class="form-control" name="model" placeholder="Vložte model auta" value="<?php echo !empty($post['model'])?$post['model']:''; ?>">
							<?php echo form_error('model','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<input type="submit" name="postSubmit" class="btn btn-primary" value="Poslať"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
