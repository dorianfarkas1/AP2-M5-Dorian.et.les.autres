
<h1 class="page-header text-center"><?php $title ?></h1>
<div class="row">
		<div class="row">
		<?php
			if(isset($_SESSION['error'])){
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $_SESSION['error'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?= $_SESSION['success'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
				unset($_SESSION['success']);
			}
		?>
		</div>

		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnew">
			Ajouter
		</button>
		<div class="height10">
		</div>
	</div>	
		
	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Nom</th>
				<th>Description</th>
				<th>Photo</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					
					foreach ($lesPorts as $row){
						?>
						<tr>
							<td><?= $row['nom'] ?></td>
							<td><?= substr($row['description'], 0, 50)."..." ?></td>
							<td><img height='100px' src='images/ports/<?= $row['photo'] ?>'></td>
							<td>
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_<?= str_replace(" ", "_", $row['nom_court']); ?>">
									<i class="bi bi-pencil-square"></i> Modifier
								</button>
								<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_<?= str_replace(" ", "_", $row['nom_court']); ?>">
									<i class="bi bi-trash3"></i> Supprimer
								</button>
							</td>
						</tr>
						<?php
						include('crudPort/edit_delete_modal.php');
					}
				?>
			</tbody>
		</table>
	</div>

<?php include('crudPort/add_modal.php') ?>


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
