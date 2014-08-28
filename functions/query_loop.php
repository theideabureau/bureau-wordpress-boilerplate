<?php // functions/query_loop.php

/**
 * An improved version of WP_Query
 *
 * Features
 * - Accepts the same arguments as WP_Query
 * - Can be used within a foreach
 * - Can be counted within count()
 * - Automatically calls have_posts() and the_post() on each iteration
 * 
 * @param  array $args
 * @return array
 */
class query_loop implements Iterator, Countable {

	public $post_ids = array();
	
	public function __construct( $args = array() ) {

		// init WP_Query
		$this->query = new WP_Query($args);

		// compile a list of post_ids
		foreach ( $this->query->posts as $post ) {
			$this->post_ids[] = $post->ID;
		}

	}

	function count() {
		return count($this->query->posts);
	}
 
	function rewind() {
		$this->query->rewind_posts();
	}
 
	function current() {
		$this->query->the_post();
		return $this->query->post;
	}
 
	function key() {
		return $this->query->post->ID;
	}
 
	function next() {
		//$this->query->the_post();
	}
 
	function valid() {
		if ( $this->query->have_posts() ) {
			return true;
		} else {
			wp_reset_postdata();
			return false;
		}
	}

	function have_posts() {
		return $this->query->have_posts();
	}

}