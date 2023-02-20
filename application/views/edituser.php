<div class="container mx-auto px-4 h-full">
	<div class="row justify-content-center h-full">
		<input type="hidden" id="title" value="Edit User">
		<div class="col-lg-6">
			<div class="card shadow-lg rounded-lg border-0">
				<div class="card-header bg-transparent">
					<div class="text-center mb-3">
					</div>
					<div class="btn-wrapper text-center">
					</div>
				</div>
				<div class="card-body px-4 py-5">
					<div class="text-muted text-center mb-3 font-weight-bold">
					</div>
					<form action="<?php echo base_url('/users/update'); ?>" method="post">
						<input type="hidden" name="id" value="<?= $user['id'] ?>"/>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
							   value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="form-group">
							<label class="text-uppercase text-secondary font-weight-bold" for="name">
								Name
							</label>
							<input type="text" id="name" name="name" value="<?= $user['name'] ?>"
								   class="form-control border-0 py-3 px-4 bg-light rounded-lg text-secondary"
								   placeholder="Name">
						</div>
						<div class="form-group mt-4">
							<label class="text-uppercase text-secondary font-weight-bold" for="email">
								Email
							</label>
							<input type="email" id="email" name="email" value="<?= $user['email'] ?>"
								   class="form-control border-0 py-3 px-4 bg-light rounded-lg text-secondary"
								   placeholder="Email">
						</div>
						<div class="text-center mt-6">
							<button type="submit" id="editUser"
									class="btn btn-primary btn-block py-2 px-4 rounded-lg">
								Update
							</button>
						</div>
					</form>
					<?php if ($this->session->flashdata('success')) { ?>
						<div class="alert alert-success mt-4" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

