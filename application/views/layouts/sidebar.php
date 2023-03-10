<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
<!--	<a href="#" class="brand-link">-->
<!--		<img src="https://via.placeholder.com/150x150.png?text=Logo" alt="AdminLTE Logo"-->
<!--			 class="brand-image img-circle elevation-3" style="opacity: .8">-->
<!--		<span class="brand-text font-weight-light">AdminLTE 3</span>-->
<!--	</a>-->
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->

				<li class="nav-item menu-is-opening menu-open">
					<a href="<?php echo base_url('/');?>" class="nav-link active">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
<!--							<i class="fa fa-angle-left" aria-hidden="true" style="margin-left: 120px; font-weight: 900;"></i>-->

						</p>
					</a>
					<ul class="nav nav-treeview" style="display: block;">
						<li class="nav-item">
							<a href="<?php echo base_url('/users');?>" class="nav-link active">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
									<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
								</svg>
								<p>Users</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
