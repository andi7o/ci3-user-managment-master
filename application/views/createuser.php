<input type="hidden" id="title" value="Create User">
<div class="container mx-auto px-4 h-full">
	<div class="row justify-content-center h-full">
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
					<form action="<?php echo base_url('/users/createUser'); ?>" method="post">

						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
							   value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="form-group">
							<label class="text-uppercase text-secondary font-weight-bold" for="name">
								Name
							</label>
							<input type="text" id="name" name="name"
								   class="form-control border-0 py-3 px-4 bg-light rounded-lg text-secondary"
								   placeholder="Name" value="<?php echo set_value('name'); ?>">

							<?php echo form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

						</div>
						<div class="form-group mt-4">
							<label class="text-uppercase text-secondary font-weight-bold" for="email">
								Email
							</label>
							<input type="email" id="email" name="email"
								   class="form-control border-0 py-3 px-4 bg-light rounded-lg text-secondary"
								   placeholder="Email" value="<?php echo set_value('email'); ?>">

							<?php echo form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

						</div>
						<div class="text-center mt-6">
							<button type="submit" id="createUser"
									class="btn btn-primary btn-block py-2 px-4 rounded-lg btn-green">
								Add
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
