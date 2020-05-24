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
				<div class="panel-heading">Pridať zákazníka <a href="<?php echo site_url('zakaznici/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
				<table class="table striped">
					<thead>
					<tr>
						<th width="10%">ID</th>
						<th width="25%">Platba</th>
						<th width="25%">Cesty</th>
						<th width="10%">Akcie</th>
					</tr>
					</thead>
					<tbody id="userData">
					<?php if(!empty($zakaznici)): foreach($zakaznici as $zakaznik): ?>
						<tr>
							<td><?php echo $zakaznik['id'].'.'; ?></td>
							<td><?php echo $zakaznik['platba']; ?></td>
							<td><?php echo $zakaznik['cela_cesta']; ?></td>
							<td>
								<a href="<?php echo site_url('zakaznici/view/'.$zakaznik['id']); ?>"class="glyphicon glyphicon-eye-open"></a>
								<a href="<?php echo site_url('zakaznici/edit/'.$zakaznik['id']); ?>"class="glyphicon glyphicon-edit"></a>
								<a href="<?php echo site_url('zakaznici/delete/'.$zakaznik['id']); ?>"class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
							</td>
						</tr>
					<?php endforeach; else: ?>
						<tr><td colspan="4">Žiadni zakaznici ......</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>


</div>
