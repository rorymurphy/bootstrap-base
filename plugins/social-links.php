<?php

    class Social_Links {
        public $showFacebook=true;
        public $showTwitter=true;
        public $twitterAccount=null;
        public $showLinkedIn=false;
        public $showGooglePlus=true;
        
        function __construct($values) {
            foreach($values as $k=>$v){
                $this->$k = $v;
            }
        }
        
        function render(){
            $permalink = get_permalink();
            $urlpermalink = urlencode($permalink);
            $title = get_the_title();
            $urltitle = urlencode($title);
            $excerpt = get_the_excerpt();
            $urlexcerpt = urlencode($excerpt);
?>
<ul class="social-links">
    <li><a href="<?php printf('https://www.facebook.com/sharer/sharer.php?u=%1$s&t=%2$s', $urlpermalink, $urltitle, $urlexcerpt, 'Xintricity'); ?>" target="_blank" rel="noFollow"><i class="icon-facebook-sign"></i></a></li>
    <li><a href="<?php printf('https://twitter.com/share?url=%1$s&counturl=%1$s&text=%2$s&via=%4$s', $urlpermalink, $urltitle, $urlexcerpt, 'Xintricity'); ?>" target="_blank" rel="noFollow" onclick="window.open(this.href,'twitterpopup','height=500,width=800,scrollbars=1'); event.returnValue=false; return false;"><i class="icon-twitter-sign"></i></a></li>
    <li><a href="<?php printf('http://www.linkedin.com/shareArticle?mini=true&url=%1$s&title=%2$s&summary=%3$s', $urlpermalink, $urltitle, $urlexcerpt, 'Xintricity');?>" target="_blank" rel="noFollow"><i class="icon-linkedin-sign"></i></a>
</ul>
<?php
        }
    }

    function display_social_links($values=array()){
        $links = new Social_Links($values);
        $links->render();
    }