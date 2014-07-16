<section class="header">
    <div class="header-inner">
        <?php
            $headerImg = get_header_image();

            if(!empty($headerImg)){
                printf('<a href="%2$s"><div class="header-image"><img src="%1$s"/></div></a>', $headerImg, get_bloginfo('wpurl'));
            }else{
                printf('<h1><a href="%2$s">%1$s</a></h1>', get_bloginfo('name'), get_bloginfo('wpurl'));
            }
        ?>
    </div>
    <?php if(wp_get_nav_menu_object('header-menu')){ ?>
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'header-menu',
                        'container_class' => 'navbar-collapse collapse',
                        'container_id' => 'header-nav',
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => null,
                        'walker' => new NavbarWalker
                    ));
                ?>
            </div>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</section>