@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ESTADISTICAS</title>

@endsection

@section('content')

<div class="wrapper">
	<div class="content-wrapper">
		<div class="container">
			<!-- Main content -->
			<div class="content">
				<div class="container-fluid mt-4">
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Online Store Visitors</h3>
										<a href="javascript:void(0);">View Report</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg">820</span>
											<span>Visitors Over Time</span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
											<span class="text-success">
												<i class="fas fa-arrow-up"></i> 12.5%
											</span>
											<span class="text-muted">Since last week</span>
										</p>
									</div>
									<!-- /.d-flex -->

									<div class="position-relative mb-4">
										<canvas id="visitors-chart" height="200"></canvas>
									</div>

									<div class="d-flex flex-row justify-content-end">
										<span class="mr-2">
											<i class="fas fa-square text-primary"></i> This Week
										</span>

										<span>
											<i class="fas fa-square text-gray"></i> Last Week
										</span>
									</div>
								</div>
							</div>
							<!-- /.card -->
						</div>

						<!-- /.col-md-6 -->
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Sales</h3>
										<a href="javascript:void(0);">View Report</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg">$18,230.00</span>
											<span>Sales Over Time</span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
											<span class="text-success">
												<i class="fas fa-arrow-up"></i> 33.1%
											</span>
											<span class="text-muted">Since last month</span>
										</p>
									</div>
									<!-- /.d-flex -->

									<div class="position-relative mb-4">
										<canvas id="sales-chart" height="200"></canvas>
									</div>

									<div class="d-flex flex-row justify-content-end">
										<span class="mr-2">
											<i class="fas fa-square text-primary"></i> This year
										</span>

										<span>
											<i class="fas fa-square text-gray"></i> Last year
										</span>
									</div>
								</div>
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col-md-6 -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->

				<!-- Control Sidebar -->
				<aside class="control-sidebar control-sidebar-dark">
					<!-- Control sidebar content goes here -->
				</aside>
				<!-- /.control-sidebar -->
		</div>
	</div>
</div>
				@endsection