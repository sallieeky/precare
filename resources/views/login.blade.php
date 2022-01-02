@extends("base_views.authenticate_base")
@section("title", "Login")
@section("main")
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<h1 class="h2">Selamat Datang di PRECARE</h1>
							<p class="lead">
                Silakan login menggunakan akun admin AWOK
							</p>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="{{ asset("img/logo_precare.png") }}" alt="Precare" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									@if (session("pesan"))
									<div class="alert alert-warning alert-dismissible fade show" style="display: flex; padding: 12px 12px; border-radius: 3px; margin: 5px 0; background-color:#dc3545; justify-content: space-between" role="alert">
										<strong style="color: white">{{ session("pesan") }}</strong>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									@endif
									<form action="/login" method="POST">
										@csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Masukkan Email" value="{{ old("email") }}" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan Password" />
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection