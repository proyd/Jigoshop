<?php
/**
 * Product Search Widget
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package    Jigoshop
 * @category   Widgets
 * @author     Jigowatt
 * @since	   1.0
 * @copyright  Copyright (c) 2011 Jigowatt Ltd.
 * @license    http://jigoshop.com/license/commercial-edition
 */

class Jigoshop_Widget_Product_Search extends WP_Widget {

	/** constructor */
	function Jigoshop_Widget_Product_Search() {
		$widget_ops = array( 'description' => __( "Search box for products only.", 'jigoshop') );
		parent::WP_Widget('product_search', __('Product Search', 'jigoshop'), $widget_ops);
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract($args);

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		echo $before_widget;
		
		if ($title) echo $before_title . $title . $after_title;
		
		?>
		<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
			<div>
				<label class="screen-reader-text" for="s"><?php _e('Search for:', 'jigoshop'); ?></label>
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search for products', 'jigoshop'); ?>" />
				<input type="submit" id="searchsubmit" value="<?php _e('Search', 'jigoshop'); ?>" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>
		<?php
		
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		global $wpdb;
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jigoshop') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
		<?php
	}
} // Jigoshop_Widget_Product_Search