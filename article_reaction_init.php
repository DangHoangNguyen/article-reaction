<?php
/**
 * Plugin Name: Article Reaction
 * Description: Show the like button in article
 * Plugin URI: 
 * Version: 1.0
 * Author: Castiel.Dang
 * Author URI: https://www.linkedin.com/in/nguyen-dang-hoang-236190167/
 * Text Domain: article-reaction
**/

//Define 
define( 'ARTICLE_REACTION_PHP', plugin_dir_path( __FILE__ ) );
define( 'ARTICLE_REACTION_CSS', plugin_dir_url( __FILE__ ) );

//Enqueue
function a_r_enqueue()
{
	wp_enqueue_style( 'a-r-font-awesome', ARTICLE_REACTION_CSS . 'assets/css/fontawesome/css/all.min.css');
	wp_enqueue_style( 'a-r-style-css', ARTICLE_REACTION_CSS . 'assets/css/style.css');
	wp_enqueue_script('a-r-jquery-js', ARTICLE_REACTION_CSS. 'assets/js/jquery.min.js');
	wp_enqueue_script('a-r-ajax', ARTICLE_REACTION_CSS. 'assets/js/ajax.js');
}
add_action('wp_enqueue_scripts', 'a_r_enqueue');


//Require Class
require_once( ARTICLE_REACTION_PHP . 'class/class_article_reaction_admin.php' );
require_once( ARTICLE_REACTION_PHP . 'class/class_article_reaction_db.php' );

