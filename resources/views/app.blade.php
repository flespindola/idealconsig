<!DOCTYPE HTML>
<!--
	Ideal Consig - Made by Fabio Espindola (https://github.com/flespindola)
-->
<html>
	<head>		
		<title>Ideal Consig - Empréstimo para negativados</title>
		<meta name="title" content="Empréstimo para negativados!">
		<meta name="description" content="Faça seu empréstimo online e rápido com a IdealConsig! Empréstimo na conta de luz, no cartão de crédito e pelo FGTS. Simule agora, é rápido e fácil.">
		<meta name="keywords" content="empréstimo para negativados, empréstimo na conta de luz, empréstimo no cartão de crédito, empréstimo no fgts">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="Portuguese">
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-grid.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <title inertia>{{ config('app.name', 'Awesome App') }}</title>
		<noscript><link rel="stylesheet" href="/assets/css/noscript.css" /></noscript>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic" rel="stylesheet" />
        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.tsx', "resources/js/Pages/{$page['component']}.tsx"])
        @inertiaHead
	</head>
	<body class="landing">
		<div id="page-wrapper">
			<header id="header" class="alt" style="background-color: #044bfe">
				<h1>
					<a href="/">
						<img style="margin: 0px" class="logo" src="images/logo_branco_small.png" alt="Ideal Consig" />
					</a>
				</h1>
				<nav id="nav">
					<ul>
						<li class="special">
							<a style="text-decoration: none" href="#menu" class="menuToggle"><span>Menu</span></a>
							<div id="menu">
								<ul>
									<li><a href="/">Início</a></li>
									<li><a href="Simulação">Simulação</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</header>
			<section id="banner">
			@inertia
			</section>

			<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Ideal Consig | <?php echo date('Y'); ?></li>
				</ul>
			</footer>

		</div>
	</body>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
</html>