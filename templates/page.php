<article>
    <?php if(has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
         <? the_post_thumbnail('large'); ?>
    </div>
    <?php endif; ?>
    <div class="post-content"><?php the_content(); ?></div>
</article>