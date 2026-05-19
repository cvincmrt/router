<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Edit novelty</title>
</head>
<body>
    <?php if(isset($novelty)): ?>
        <div class="container my-3">
            <h2 class="mb-5">Edit novelty</h2>
            
            <form action="/router/public/admin/news/edit" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?= $novelty->getId(); ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($novelty->getTitle()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" placeholder="Content" id="content" name="content"><?= htmlspecialchars($novelty->getContent()); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Current picture</label>
                        
                        <?php if ($novelty->getImagePath()): ?>
                            <img src="/router/public<?= htmlspecialchars($novelty->getImagePath()); ?>" alt="Current image"  style="max-width: 100px; display: block;">
                        <?php else: ?>
                            <p class="text-muted small">No image uploaded yet.</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-5">
                        <label for="image" class="form-label">Upload New Picture</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Save change</button> 
                    <a href="/router/public/admin/news" class="btn btn-secondary">Cancel</a>              
            </form>
            
        </div>
    <?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
