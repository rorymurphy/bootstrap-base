<?php

class Bootstrap_Shortcodes {
    
    function __construct() {
        add_shortcode('row', array($this, 'row_shortcode'));
        add_shortcode('carousel', array($this, 'carousel_shortcode'));
        add_shortcode('lightbox', array($this, 'lightbox_shortcode'));
        add_shortcode('jumbotron', array($this, 'jumbotron'));
        add_action('wp_footer', array($this, 'render_footer'), 99);
    }
    
    function carousel_shortcode($atts, $content) {
        if(!isset($this->carousel_count)){
            $this->carousel_count = 0;
        }
        $id = 'carousel-' . $this->carousel_count++;
        $this->carousel_items = array();
        add_shortcode('carousel-item', array($this, 'carousel_item_shortcode'));
        $content = do_shortcode($content);       
        remove_shortcode('carousel-item');
        
//        $content = preg_replace('/^[\n\r\s]*(?:<p>[\n\r\s]*\<\/p>[\n\r\s]*)+/', '', $content);
//        $content = preg_replace('/(?:<p>[\n\r\s]*\<\/p>[\n\r\s]*)+[\n\r\s]*$/', '', $content);
        $indicators = '';
        for($i=0; $i < count($this->carousel_items); $i++){
            $indicators .= sprintf('<li data-target="#%1$s" data-slide-to="%2$s" %3$s></li>', $id, $i, (0===$i)?'class="active"':'');
        }

        $result = sprintf('<div id="%1$s" class="carousel slide"><ol class="carousel-indicators">%2$s</ol>'
                . '<div class="carousel-inner">%3$s</div>'
                . '<a class="left carousel-control" href="#%1$s" data-slide="prev">'
                . ' <span class="glyphicon glyphicon-chevron-left"></span>'
                . '</a>'
                . '<a class="right carousel-control" href="#%1$s" data-slide="next">'
                . '  <span class="glyphicon glyphicon-chevron-right"></span>'
                . '</a>'
                . '</div>',
                $id, $indicators, implode('', $this->carousel_items));
        unset($this->carousel_items);
        return $result;
    }
    
    function carousel_item_shortcode($atts, $content){
        $active = (0 === count($this->carousel_items));
        array_push($this->carousel_items,
                sprintf('<div class="item%1$s">%2$s</div>', $active?' active':'', $this->cleanup_autop( do_shortcode($content) )));
    }
    
    function row_shortcode($atts, $content){
//        extract(shortcode_atts(array(
//        ), $atts));

        $this->columns = array();
        add_shortcode('column', array($this, 'column_shortcode'));
        $content = do_shortcode($content);
        remove_shortcode('column');
        $result = sprintf('<div class="row">%1$s</div>', implode('', $this->columns));
        unset($this->columns);
        return $result;
    }
    
    function column_shortcode($atts, $content){
        $atts = shortcode_atts(array(
            'width' => '12',
            'width-small' => null,
            'width-large' => null
        ), $atts);
        
        $width = intval($atts['width']);
        $widthSmall = ($atts['width-small'] === null)? '' : ('col-sm-' + $atts['width-small']);
        $widthLarge = ($atts['width-large'] === null)? '' : ('col-lg-' + $atts['width-large']);
        $content = $this->cleanup_autop( do_shortcode($content) );
        array_push($this->columns, sprintf('<div class="col-md-%1$s%2$s%3$s">%4$s</div>', $width, $widthSmall, $widthLarge, $content));
    }
    
    function lightbox_shortcode($atts, $content){
        shortcode_atts(array(
            'title' => '',
            'trigger-text' => '',
            'trigger-class' => '',
            'modal-class' => 'fade'
        ), $atts);
        
        if(!property_exists($this, 'lightbox_counter')){ $this->lightbox_counter = 0; }
        else{ $this->lightbox_counter++; }
        $atts['id'] = 'lightbox' + $this->lightbox_counter;
        $atts['content'] = $this->cleanup_autop( $content );
        render_view(__FILE__, 'lightbox', $atts);
    }
    
    function jumbotron($atts, $content){
        return sprintf('<div class="jumbotron">%1$s</div>', $this->cleanup_autop( do_shortcode($content) ));
    }
    
    function render_footer(){
    ?>
<script type="text/javascript">
    jQuery('[data-toggle="tooltip"]').tooltip();
</script>
<?php
    }
    
    function cleanup_autop($str){
        
        if($this->strstartswith('</p>', $str)){
            $str = substr($str, 4);
        }
        if($this->strendswith('<p>', $str)){
            $str = substr($str, 0, strlen($str) - 3);
        }
        return $str;
    }
    
    function strstartswith($needle, $haystack){
        return substr($haystack, 0, strlen($needle)) == $needle;
    }
    
    function strendswith($needle, $haystack){
        return strlen($haystack) >= strlen($needle)
            && substr($haystack, strlen($haystack) - strlen($needle), strlen($needle)) == $needle;
    }
}


$__bootstrap_shortcodes = new Bootstrap_Shortcodes();