<article>
    <?php if(has_post_thumbnail()) : 
         the_post_thumbnail('large');
      endif;
    ?>
    <h2 class="post-title"><a href="<?php print the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="post-meta">
        <div class="post-author">Posted By <?php the_author(); ?></div>
        <div class="post-date"><?php the_date() ?></div>
    </div>
    <div class="post-content"><?php the_excerpt(); ?></div>
</article>
