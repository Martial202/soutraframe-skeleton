<!-- content -->
<div class="bloc1 mt-5">
	<div class="row">
		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-primary card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-2"><i class="fa fa-cog fa-spin"></i>
							<div class="icon-big text-center">
								<i class="flaticon-users"></i>
							</div>
						</div>
                        <a href="<?=RACINE_2?>clients/list-today">
						<div class="col- col-stats">
							<div class="numbers">
								<p class="card-category">Clients  </p>
								<h4 class="card-title" style="font-size: 25px;"><?= $t_client["total"]; ?></h4>
							</div>
						</div>
                        </a>
					</div>
				</div>
			</div>
		</div>

        <div class="col-sm-6 col-md-3">
			<div class="card card-stats card-info card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-2"><i class="fa fa-cog fa-spin"></i>
							<div class="icon-big text-center">
								<i class="fa fa-user-plus"></i>
							</div>
						</div>
                        <a href="<?=RACINE_2?>f-client/client-form">

						<div class="col- col-stats">
							<div class="numbers">
								<p class="card-category">Nouveau client </p>
							</div>
						</div>
                        </a>
					</div>
				</div>
			</div>
		</div>

        <div class="col-sm-6 col-md-3">
			<div class="card card-stats card-success card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-2"><i class="fa fa-cog	"></i>
							<div class="icon-big text-center">
								<i class="flaticon-success"></i>
							</div>
						</div>
						<div class="col- col-stats">
							<div class="numbers">
								<p class="card-category">Total Encaissé </p>
								<h4 class="card-title" style="font-size: 25px;"><?= $t_cotise['total']??0; ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="col-sm-6 col-md-3">
			<div class="card card-stats card-danger card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-2"><i class="fa fa-cog fa-spin"></i>
							<div class="icon-big text-center">
								<i class="fa fa-book-open"></i>
							</div>
						</div>
                        <a href="<?=RACINE_2?>demande/view-today">
					
						<div class="col- col-stats">
							<div class="numbers">
								<p class="card-category">Mes Carnets vendus</p>
							</div>
						</div>
                        </a>
					</div>
				</div>
			</div>
		</div>

		<hr>
		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-info card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-2"><i class="fa fa-cog"></i>
							<div class="icon-big text-center">
								<i class="flaticon-agenda-1"></i>
							</div>
						</div>
					
						<div class="col- col-stats">
							<div class="numbers">
								<p class="card-category">Inscriptions</p>
								<h4 class="card-title" style="font-size: 25px;"><?= $t_ins['total']??0; ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		
	</div>

</div>
<!-- content -->