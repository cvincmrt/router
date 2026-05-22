<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/router/public/css/detail.css">
    <title>view|detail</title>
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

<h2>Detail novinky: </h2>
<?php if(isset($novelty)): ?>
    <p>id = <?= $novelty->getId(); ?></p>
<?php endif; ?>   
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>