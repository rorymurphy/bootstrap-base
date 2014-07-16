<?php
get_header();
get_template_part('templates/page-header');
?>
<section id="main-content">
    <div class="row">
        <div class="col-md-9">
            <?php if(have_posts()):
                the_post();
                get_template_part('templates/post', 'single');
                comments_template( '', true );
            endif;
            ?>
        </div>
        <div class="col-md-3">
            <?php dynamic_sidebar('blog-rail'); ?>
        </div>
    </div>
</section>
<?php get_footer();
