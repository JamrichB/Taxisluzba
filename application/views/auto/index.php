<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Znacka', 'Zakaznik'],
				<?php
				foreach($charts as $chart){
					echo "['".$chart['znacka']."', ".$chart['customer']."],";
				}
				?>
			]);

			var options = {
				title: 'Obľúbenosť áut medzi zákazníkmi'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
	</script>
	<script>
		function myFunction() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
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
		<h1>Zoznam áut</h1>
		<input style="margin-bottom: 10px; margin-left: 15px; width: 200px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Vyhľadajte auto podľa značky" title="Type in a name">
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default ">
				<div class="panel-heading"> Pridaj auto <a href="<?php echo site_url('auto/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
				<table id="myTable" class="table table-striped">
					<thead>
					<tr>
						<th width="20%">ID</th>
						<th width="30%">Znacka</th>
						<th width="30%">Model</th>
						<th width="20%">Akcia</th>
					</tr>
					</thead>
					<tbody id="userData">
					<?php if(!empty($auto)): foreach($auto as $auto1): ?>
						<tr>
							<td><?php echo $auto1['id'].'.'; ?></td>
							<td><?php echo $auto1['znacka']; ?></td>
							<td><?php echo $auto1['model']; ?></td>
							<td>
								<a href="<?php echo site_url('auto/view/'.$auto1['id']); ?>"class="glyphicon glyphicon-eye-open"></a>
								<a href="<?php echo site_url('auto/edit/'.$auto1['id']); ?>"class="glyphicon glyphicon-edit"></a>
								<a href="<?php echo site_url('auto/delete/'.$auto1['id']); ?>"class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
							</td>
						</tr>
					<?php endforeach; else: ?>
						<tr><td colspan="4">Žiadne auta ......</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
			<div id="piechart" style="width:900px; height: 500px;"></div>

		</div>
	</div>


</div>
