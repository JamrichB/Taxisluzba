<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Cesta', 'Cena'],
				<?php
				foreach($charts as $chart){
					echo "['".$chart['cesta']."', ".$chart['cena']."],";
				}
				?>
			]);

			var options = {
				title: 'Cena každej cesty:'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
	</script>

</head>
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
		<h1>Zoznam ciest</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default ">
				<div class="panel-heading">Pridať cestu <a href="<?php echo site_url('cesty/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
				<table class="table striped">
					<thead>
					<tr>
						<th width="10%">ID</th>
						<th width="25%">Datum</th>
						<th width="25%">Trasa</th>
						<th width="20%">Pocet_km</th>
						<th width="20%">Vodici</th>
						<th width="10%">Akcie</th>
					</tr>
					</thead>
					<tbody id="userData">
					<?php if(!empty($cesty)): foreach($cesty as $cesta): ?>
						<tr>
							<td><?php echo $cesta['id'].'.'; ?></td>
							<td><?php echo $cesta['datum']; ?></td>
							<td><?php echo $cesta['trasa']; ?></td>
							<td><?php echo $cesta['pocet_km']; ?></td>
							<td><?php echo $cesta['cely_vodic']; ?></td>
							<td>
								<a href="<?php echo site_url('cesty/view/'.$cesta['id']); ?>"class="glyphicon glyphicon-eye-open"></a>
								<a href="<?php echo site_url('cesty/edit/'.$cesta['id']); ?>"class="glyphicon glyphicon-edit"></a>
								<a href="<?php echo site_url('cesty/delete/'.$cesta['id']); ?>"class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
							</td>
						</tr>
					<?php endforeach; else: ?>
						<tr><td colspan="4">Žiadne cesty ......</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
			<div id="piechart" style="width:900px; height: 500px;"></div>

		</div>
	</div>


</div>
