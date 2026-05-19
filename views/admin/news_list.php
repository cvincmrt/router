<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>News list</title>
</head>
<body>
    <div class="container my-3">
        <h2 class="mb-3">News list</h2>

        <?php if(isset($_SESSION["flash_success"])) :?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_SESSION["flash_success"]); ?>
            </div>
            <?php unset($_SESSION["flash_success"]); ?>
        <?php endif; ?>

         <?php if(isset($_SESSION["flash_error"])) :?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_SESSION["flash_error"]); ?>
            </div>
            <?php unset($_SESSION["flash_error"]); ?>
        <?php endif; ?>
        
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image_path</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($newsList) && !empty($newsList)) :?>
                    <?php foreach($newsList as $novelty) :?>
                        <tr>
                            <td><?= htmlspecialchars($novelty->getTitle()); ?></td>
                            <td><?= htmlspecialchars($novelty->getContent()); ?></td>
                            <td>
                                <?php if($novelty->getImagePath()): ?>
                                    <img src="/router/public<?= htmlspecialchars($novelty->getImagePath()); ?>" class="img-thumbnail" alt="calculator" style="max-width:60px;">
                                <?php else: ?>
                                    <span class="text-muted small">No image</span>    
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($novelty->getCreatedAt()); ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-auto">
                                        <form action = "/router/public/admin/news/delete" method = "POST" onsubmit="return confirm('Are you sure you want to delete this novelty?');">
                                            <input type="hidden" name="id" value="<?= $novelty->getId(); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>

                                    <div class="col-auto">
                                        <form action = "/router/public/admin/news/edit" method = "GET">
                                            <input type="hidden" name="id" value="<?= $novelty->getId(); ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                </div>                   
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                        
                <?php endif; ?> 
            </tbody>
        </table>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>