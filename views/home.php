<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/router/public/css/home.css">
    <title>view|home</title>
</head>
<body>
   <!-- Horné Menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Stredná Odborná Škola</a>
    <div class="navbar-nav">
      <a class="nav-link" href="#">O škole</a>
      <a class="nav-link" href="#">Štúdium</a>
      <a class="nav-link btn btn-primary text-white ms-lg-3" href="/router/public/login">Login</a>
    </div>
  </div>
</nav>

<!-- Hero Sekcia -->
<header class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Budujeme vašu budúcnosť</h1>
        <p class="lead">Vitajte na stránkach našej školy.</p>
    </div>
</header>

<!-- Sekcia Noviniek -->
<section class="container my-5">
    <h2 class="text-center mb-4">Aktuálne novinky</h2>
    <div class="row">
        <!-- Tieto karty neskôr nahradíme PHP cyklom (foreach) -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Deň otvorených dverí</h5>
                    <p class="card-text">Príďte sa pozrieť do našich priestorov už 15. mája...</p>
                    <a href="#" class="btn btn-outline-primary">Viac info</a>
                </div>
            </div>
        </div>
        <!-- ... ďalšie karty ... -->
    </div>
</section> 
   
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>