<?php
/**
* Class Article Reaction Admin
**/

if (!class_exists('Article_Reaction_Admin')) {
    class Article_Reaction_Admin{
        /*
        *Hook
        */
         function __construct() {
            add_action( 'wp_ajax_store_like_count_ajax', array($this,'store_like_count') );
            add_action( 'wp_ajax_nopriv_store_like_count_ajax', array($this,'store_like_count') );
            add_action('the_content', array($this, 'render_front_end'));
        }

        /*
        *Install Article Reaction DB
        */
        public function install_table()
        {
                global $Article_Reaction_DB;
                $Article_Reaction_DB =  new Article_Reaction_DB();
                $Article_Reaction_DB->install_article_reaction_table();
            
        }

        /*
        *Get Post ID
        */
        public function get_post_id()
        {
            global $post;
            return $this->post_id = $post->ID;
        }

        /*
        *Save Like Count
        */
        public function store_like_count()
        {

            global $Article_Reaction_DB;
            $like_count = $Article_Reaction_DB->get_data($_POST['postId']);
            
            if($like_count == null){
                $Article_Reaction_DB->insert_data(1, $_POST['postId']);

            }elseif($like_count != null){
                $like_count+=1;
                $Article_Reaction_DB->update_data($like_count, $_POST['postId']);
            }else{
                return;
            }
            
        }

        /*
        *Count Number HTML
        */
        public function count_html()
        {
            global $Article_Reaction_DB;
            return '<input hidden id="getPosId" value="'. $this->get_post_id() .'"><span id="like_count">'. $Article_Reaction_DB->get_data($this->get_post_id()) .'</span>';  
        }

        /*
        *Show Article Reaction In Front End
        */
        public function render_front_end()
        {   
            global $post;
            
            if(is_single() && !is_admin()){
                $the_content = '';
                $the_content .='<input hidden id="admin_ajax_url" value="'. admin_url("admin-ajax.php") .'">
                <div class="a_r_wrap">
                    <span name="ar_btn" id="ar_btn"><i class="fas fa-thumbs-up"></i></span>'. $this->count_html() .'
                </div>';
                $the_content .= get_the_content();

            }
            return $the_content;                        
        }

    }
    new Article_Reaction_Admin();
}
 ?>
