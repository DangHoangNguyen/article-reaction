<?php
/**
* Class Article Reaction DB
**/

if (!class_exists('Article_Reaction_DB')) {
	class Article_Reaction_DB{
	private $wpdb;
	 public function __construct()
	    {	
	    	//Variable
	    	global $wpdb;
	    	$this->wpdb = $wpdb;
	    	$this->table_name = $wpdb->prefix.'article_reaction';
	    	add_action('admin_init', array($this, 'install_article_reaction_table'));
	    }
	public function install_article_reaction_table()
	{
		$sql = "CREATE TABLE `". $this->table_name ."` (
			      id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			      count bigint(20),
			      post_id bigint(20),
			      PRIMARY KEY  (id)
			    );";   
		if ( $this->wpdb->get_var("SHOW TABLES LIKE '". $this->table_name ."'") == NULL ) {
			$this->wpdb->query($sql);
		}else{
			return;
		}
	}
		public function get_data($post_id)
		{
			$sql = 'SELECT count FROM `'. $this->table_name .'` WHERE post_id = '. $post_id .' ';
			$data = $this->wpdb->get_var ($sql);
			return $data;
		}
		public function insert_data($count, $post_id)
		{

	        $data = array('id' => null, 'count' => $count, 'post_id' => $post_id);
	        $format = array('%d','%d', '%d');
	        $insert = $this->wpdb->insert($this->table_name,$data,$format);
		}

		public function update_data($count, $post_id)
		{
			$data = [ 'count' => $count ]; 
			$format = array('%d','%d', '%d');
			$where = [ 'post_id' => $post_id ];
			$update= $this->wpdb->update( $this->table_name, $data, $where, $format); 
		}

	}
	
}
if(!isset($Article_Reaction_DB)){
	global $Article_Reaction_DB;
	$Article_Reaction_DB =  new Article_Reaction_DB();
}	
	
