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
				<div class="panel-heading"><?php //echo $action; ?> Cesty <a href="<?php echo site_url('cesty/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
				<div class="panel-body">
					<form method="post" action="" class="form">
						<div class="form-group">
							<label for="title">Datum</label>
							<input type="text" class="form-control" name="datum" id="datum" placeholder="Vložte datum" value="<?php echo !empty($post['datum'])?$post['datum']:''; ?>">
							<?php echo form_error('datum','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="title">Trasa</label>
							<input type="text" class="form-control" name="trasa" id="trasa" placeholder="Vložte trasu" value="<?php echo !empty($post['trasa'])?$post['trasa']:''; ?>">
							<?php echo form_error('trasa','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="title">Počet km</label>
							<input type="text" class="form-control" name="pocet_km" id="pocet_km" placeholder="Vložte počet km" value="<?php echo !empty($post['pocet_km'])?$post['pocet_km']:''; ?>">
							<?php echo form_error('pocet_km','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="title">Vodič správne</label>
							<?php echo form_dropdown('id_vodici', $vodici, $vybrany_vodic, 'class="form-control"'); ?>
							<?php echo form_error('id_vodici','<p class="help-block text-danger">','</p>'); ?>
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

