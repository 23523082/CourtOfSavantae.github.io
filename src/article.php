<?php 
require 'dbconnections.php'; 
require 'articlescript.php'; ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="contentstyle.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>My Blog</h1>
        </div>
    </header>

    <div class="container">
        <article class="article">
            <h1><?php echo htmlspecialchars($title); ?></h1>
            <div class="meta">
                <small>Posted on: <?php echo htmlspecialchars($date); ?></small>
            </div>
        <?php if (!empty($image)) : ?>
            <img src="<?php echo htmlspecialchars($image); ?>" />
        <?php endif;?>
            <p><?php echo htmlspecialchars($paragraph1); ?></p>
        <?php if (!empty($linkyt)) : ?>
            <div class="video-responsive">
            <iframe 
                src="https://www.youtube.com/embed/<?php echo htmlspecialchars($linkyt);?>" 
                title="YouTube video player" 
                 frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
            </iframe>
    </div>
<?php endif; ?>
        </article>
    </div>

    <footer>
        <p>&copy; 2023 My Blog. All rights reserved.</p>
    </footer>
</body>
</html>
