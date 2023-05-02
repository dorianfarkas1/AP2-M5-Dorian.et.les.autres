<h2 class="page-header text-center"><?= $title ?></h2>	
	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Numéro de traversée </th>
				<th>Date de Départ</th>
				<th>Heure de départ </th>
				<th>Nom du navire</th>
				
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					foreach ($lesTraversees as $uneTraversee){
						?>
							<tr>
								<td><?= $uneTraversee['num'] ?></td>
								<td><?= $uneTraversee['date'] ?></td>
								<td><?= $uneTraversee['heure'] ?></td>
								<td><?= $uneTraversee['nom'] ?></td>
							</tr>						 
							<td>
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_<?= $row['id'] ?>">
									<i class="bi bi-pencil-square"></i> Affecter
								</button>
							</td>
						</tr>
						<?php
						include('crudBateau/edit_delete_modal.php');
					}
				?>
			</tbody>
		</table>
	</div>

<?php include('crudBateau/add_modal.php') ?>

<script src=""></script>
<script></script>
<script></script>
<script></script>

<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

	//hide alert
	$(document).on('click', '.close', function(){
        $('.alert').hide();
	});
});
</script>