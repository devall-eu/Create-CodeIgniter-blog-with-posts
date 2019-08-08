<?php if (isset($blog)): ?>
<div>
    <div>
        <?php if ($params['singlearticlepicture'] == 1): ?>
            <div>
                <img src="assets/images/<?php echo $blog->picture; ?>" alt="<?php echo $blog->title; ?>">
            </div>
        <?php endif; ?>
        <div>
            <h2><?php echo $blog->title; ?></h2>
            <ul>
                <li><i class="fa fa-list"></i> <?php echo $blog->name; ?></li>
                <li><i class="fa fa-user"></i> <?php echo $blog->full_name; ?></li>
                <li><i class="fa fa-calendar"></i> <?php echo date('d.m.Y', strtotime($blog->added)); ?></li>
                <?php if ($params['singlearticletags'] == 1): ?>
                    <li><i class="fa fa-tags"></i><?php echo str_replace(',', ', ', $blog->marks); ?></li>
                <?php endif; ?>
            </ul>
            <div><?php echo $blog->short_content; ?></div>
            <br>
            <?php echo $blog->content; ?>
        </div>
    </div>
    <?php if (isset($prev) || isset($next)): ?>
    <div>
        <div>
            <?php if (isset($prev)): ?>
                <div>
                    <div>
                        <a href="<?php echo base_url('index.php/blog/post/' . $prev->slug); ?>">
                            <?php if ($params['singlearticlepicture'] == 1): ?>
                                <img src="assets/images/<?php echo $prev->picture; ?>" alt="">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo base_url('index.php/blog/post/' . $prev->slug); ?>">
                            <span></span>
                        </a>
                    </div>
                    <div>
                        <p>Prev Post</p>
                        <a href="<?php echo base_url('index.php/blog/post/' . $prev->slug); ?>">
                            <h4><?php echo $prev->title; ?></h4>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($next)): ?>
                <div>
                    <div>
                        <p>Next Post</p>
                        <a href="<?php echo base_url('index.php/blog/post/' . $next->slug); ?>">
                            <h4><?php echo $next->title; ?></h4>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo base_url('index.php/blog/post/' . $next->slug); ?>">
                            <span></span>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo base_url('index.php/blog/post/' . $next->slug); ?>">
                            <?php if ($params['singlearticlepicture'] == 1): ?>
                                <img src="assets/images/<?php echo $next->picture; ?>" alt="">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
    <h4>The requested post was not found.</h4>
<?php endif; ?>
