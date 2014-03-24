<?php // functions/query_loop.php

/**
 * an improved version of WP_Query
 * allows for us in foreach, can be used with count()
 * @param  array $args
 * @return array
 */
class query_loop implements Iterator, Countable {
	
	public function __construct( $args = array() ) {
		$this->query = new WP_Query( $args );
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
}