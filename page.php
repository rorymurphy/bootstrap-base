<?php
get_header();
get_template_part('templates/page-header');
?>
<section id="main-content">
    <div class="main-content-inner">
        <?php if(have_posts()):
            the_post();
            get_template_part('templates/page');
        endif; ?>
    </div>
</section>
<?php
get_footer();
