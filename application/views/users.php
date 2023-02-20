<script src="/application/src/users/global.js"></script>

<input type="hidden" id="title" value="Users">
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>User <b>Management</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="<?php echo base_url('users/create/') ?>" class="btn btn-success" data-toggle="modal">
							<i class="material-icons">&#xE147;</i> <span>Add New Employee</span>
						</a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>created_At</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users

				as $user) : ?>
				<tr class="bg-white" id="<?= $user->id; ?>">
					<td><?= $user->id; ?></td>
					<td><?= $user->name; ?></td>
					<td><?= $user->email; ?></td>
					<td><?=
						date('d.m.Y H:i:s', strtotime($user->created_at));
						?>
					</td>
					<td>
						<div class="d-flex justify-content-center">
							<a href="<?php echo base_url('users/edit/' . $user->id) ?>">
								<button type="button" data-inline="true" class=" btn btn-warning mr-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										 class="bi bi-pen" viewBox="0 0 16 16">
										<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
									</svg>
								</button>
							</a>
							<!-- Delete Button -->
							<div class="container d-flex justify-content-center">

								<button type="button" class="delete btn btn-danger" data-toggle="modal"
										data-target="#exampleModal<?= $user->id ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										 class="bi bi-trash3-fill" viewBox="0 0 16 16">
										<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
									</svg>
								</button>
							</div>

							<!-- Delete Modal -->
							<form class="delete-form" action="<?php echo base_url('/users/deleteUser/' . $user->id); ?>"
								  method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
									   value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="id" value="<?= $user->id ?>">
								<div class="modal fade" id="exampleModal<?= $user->id ?>" tabindex="-1" role="dialog"
									 aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Delete Employee</h4>
												<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p>Are you sure you want to delete these Records?</p>
												<p class="text-warning"><small>This action cannot be undone.</small></p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light" data-dismiss="modal">
													Cancel
												</button>
												<button type="submit" onclick="deleteUser <?= $user->id ?>"
														class="btn btn-danger">Delete
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
					</td>
		</div>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>

		<div class="clearfix">
			<div class="hint-text">
				<form action="<?php echo site_url('users/index'); ?>" method="get" id="form-per-page">
					<label for="per_page">Entries per view:</label>
					<select name="per_page" id="per_page">
						<option value="4" <?php if ($per_page == 4) {
							echo 'selected';
						} ?>>4
						</option>
						<option value="8" <?php if ($per_page == 8) {
							echo 'selected';
						} ?>>8
						</option>
						<option value="12" <?php if ($per_page == 12) {
							echo 'selected';
						} ?>>12
						</option>
					</select>
				</form>
			</div>


			<?php echo $pagination; ?>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function () {
		// Handle click event on Delete button
		$("#deleteButton<?= $user->id ?>").click(function () {
			// Get the ID of the user to be deleted
			var userId = <?= $user->id ?>;

			// Set the form action URL dynamically based on the user ID
			var formAction = "<?php echo base_url('/users/deleteUser/') ?>" + userId;
			$(".delete-form").attr("action", formAction);
		});
	});
</script>
