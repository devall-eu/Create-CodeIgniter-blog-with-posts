<?php foreach ($articles as $article): ?>
    <article>
        <?php if ($params['blogpicture'] == 1): ?>
            <div>
                <img src="assets/images/<?php echo $article->picture; ?>" alt="<?php echo $article->title; ?>">
                <a href="#">
                    <p><?php echo date('d.m.Y', strtotime($article->added)); ?></p>
                </a>
            </div>
        <?php endif; ?>

        <div>
            <a href="<?php echo base_url('index.php/blog/post/' . $article->slug); ?>">
                <h2><?php echo $article->title; ?></h2>
            </a>
            <ul>
                <li><i class="fa fa-list"></i> <?php echo $article->name; ?></li>
                <li><i class="fa fa-user"></i> <?php echo $article->full_name; ?></li>
                <?php if ($params['articletags'] == 1): ?>
                    <li><i class="fa fa-tags"></i> <?php echo str_replace(',', ', ', $article->marks); ?></li>
                <?php endif; ?>
            </ul>
            <p><?php echo $article->short_content; ?></p>
        </div>
    </article>
    <hr>
<?php endforeach; ?>

<nav>
    <?php foreach ($links as $link) {
        echo $link;
    } ?>
</nav>
<br>
<div><?php echo $pagermessage; ?></div>