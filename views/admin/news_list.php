<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News list</title>
</head>
<body>
    <?php if(isset($newsList)) :?>
        <?php foreach($newsList as $novelty) :?>
            <h2><?=$novelty->getContent(); ?></h2>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>