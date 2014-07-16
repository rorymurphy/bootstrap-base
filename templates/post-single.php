<article>
    <?php if(has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
         <? the_post_thumbnail('large'); ?>
    </div>
    <?php endif; ?>
    
    <h2 class="post-title"><?php the_title(); ?></h2>
    <div class="post-meta">
        <div class="post-author">Posted By <?php the_author(); ?></div>
        <div class="post-date"><?php the_date() ?></div>
        <div class="post-share">Share this post: <?php display_social_links(); ?></div>
    </div>
    <div class="post-content"><?php the_content(); ?></div>
</article>