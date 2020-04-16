<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('WP_iv_membership_widget')) {
   /**
	* Widget Boilerplate
	*/
	class WP_iv_membership_widget extends WP_Widget
	{

	  /**
	   * Constructor
	   *
	   * Registers the widget details with the parent class
	   */
	  function __construct()
	  {
		 // widget actual processes
	  	parent::__construct($id = 'wp_pb_widget', $name = ' Form', $options = array('description' => __('Form', 'wp-pb')));
	  }

	  /**
	   * Creates a form in the theme widgets page
	   * @param $instance
	   */
	  function form($instance)
	  {
		 // outputs the options form on admin
	  	if ($instance) {
	  		$value = esc_attr($instance['field']);
	  	} else {
	  		$value = __('Form List', 'wp-pb');
	  		
	  	}
	  	$iv_membership_display = '';
	  	$iv_membership_name = '';
	  	?>
	  	<p>
	  		<label for="<?php echo $this->get_field_id('field'); ?>"><?php _e('Form', 'wp-pb') ?></label><br/>
						<!--
						<input class="widefat" id="<?php echo $this->get_field_id('field'); ?>"
							   name="<?php echo $this->get_field_name('field'); ?>" type="text" value="<?php echo $value; ?>"/>
							-->
							<select class="widefat" id="<?php echo $this->get_field_id('field'); ?>"
								name="<?php echo $this->get_field_name('field'); ?>">
								<?php	
								global $wpdb, $post;			
								
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership'";		
								$products_rows = $wpdb->get_results($sql); 	
								if(sizeof($products_rows)>0){									
									foreach ( $products_rows as $row ) 
									{	
										echo '<option value="'.$row->post_title.'"'. ($value ==$row->post_title ? "selected" : "").' >'. $row->post_title.'</option>';	
										$post_id = $row->ID		;	
										
									}
									
								}	
								?>
								
							</select>	   
						</p>
						
						
						
						
						<?php
						
					}

	  /**
	   * Update the form on submit
	   *
	   * @param $new_instance
	   * @param $old_instance
	   * @return array
	   */
	  function update($new_instance, $old_instance)
	  {
	  	$instance = $old_instance;
	  	$instance['field'] = strip_tags($new_instance['field']);
	  	return $instance;
	  }

	  /**
	   * Displays the widget
	   *
	   * @param $args
	   * @param $instance
	   */
	  function widget($args, $instance)
	  {
		 // Extract the content of the widget
	  
	  	
	  }

	}
}
