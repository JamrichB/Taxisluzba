<div class="container">
	<?php if(!empty($success_msg)){ ?>
		<div class="col-xs-12">
			<div class="alert alert-success"><?php echo $success_msg; ?></div>
		</div>
	<?php }elseif(!empty($error_msg)){ ?>
		<div class="col-xs-12">
			<div class="alert alert-danger"><?php echo $error_msg; ?></div>
		</div>
	<?php } ?>
	<div class="row">
		<h1>Zoznam vodičov</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default ">
				<div class="panel-heading">Pridať vodiča <a href="<?php echo site_url('vodici/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
				<table class="table striped">
					<thead>
					<tr>
						<th width="10%">ID</th>
						<th width="25%">Meno</th>
						<th width="25%">Priezvisko</th>
						<th width="20%">Auto</th>
						<th width="10%">Akcie</th>
					</tr>
					</thead>
					<tbody id="userData">
					<?php if(!empty($vodici)): foreach($vodici as $vodic): ?>
						<tr>
							<td><?php echo $vodic['id'].'.'; ?></td>
							<td><?php echo $vodic['meno']; ?></td>
							<td><?php echo $vodic['priezvisko']; ?></td>
							<td><?php echo $vodic['cele_auto']; ?></td>
							<td>
								<a href="<?php echo site_url('vodici/view/'.$vodic['id']); ?>"class="glyphicon glyphicon-eye-open"></a>
								<a href="<?php echo site_url('vodici/edit/'.$vodic['id']); ?>"class="glyphicon glyphicon-edit"></a>
								<a href="<?php echo site_url('vodici/delete/'.$vodic['id']); ?>"class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
							</td>
						</tr>
					<?php endforeach; else: ?>
						<tr><td colspan="4">Žiadni vodici ......</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div>
