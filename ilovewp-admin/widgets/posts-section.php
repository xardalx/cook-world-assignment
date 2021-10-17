<?php

/*------------------------------------------*/
/* AcademiaThemes: Recent Posts             */
/*------------------------------------------*/
 
class nutmeg_widget_posts_section extends WP_Widget {
	
	public function __construct() {

		parent::__construct(
			'ilovewp-widget-posts-section',
			esc_html__( 'Nutmeg: Recent Posts', 'nutmeg' ),
			array(
				'classname'   => 'widget-nutmeg-posts',
				'description' => esc_html__( 'Displays a list of posts optionally filtered by category.', 'nutmeg' )
			)
		);

	}
	
	public function widget( $args, $instance ) {
		
		extract( $args );

		/* User-selected settings. */
		$title 				= apply_filters( 'widget_title', empty($instance['widget_title']) ? '' : $instance['widget_title'], $instance );
		$category 			= isset($instance['category']) ? $instance['category'] : false;
		$show_num 			= isset($instance['show_num']) ? $instance['show_num'] : 3;
		$show_format 		= isset($instance['show_format']) ? $instance['show_format'] : 'compact';
		$show_thumb 		= isset($instance['show_thumb']) ? $instance['show_thumb'] : 'landscape';
		$show_date 			= isset($instance['show_date']) ? $instance['show_date'] : false;

		if ( isset($category) ) {
			$categoryLink = get_category_link($category);
		}

		if ( $args['id'] == 'homepage-under-title' ) {
			if (current_user_can( 'manage_options' ) ) {
				echo $before_widget;
				
				if ( $title ) {
					echo $before_title;
					echo $title;
					echo $after_title;
				}				
				?><p><?php esc_html_e('The Nutmeg: Recent Posts widget cannot be displayed in this widgetized area.','nutmeg'); ?></p><?php
				echo $after_widget;
			}
			return;
		}

		ob_start();

		$widget_loop = new WP_Query( array( 'posts_per_page' => $show_num, 'orderby' => 'date', 'order' => 'DESC', 'category_name' => $category ) );

		$i = 0; 

		if ( $widget_loop->have_posts() ) { 

			if ( $show_thumb == 'landscape' ) { $thumbnail_name    = 'nutmeg-thumb-landscape'; }
			elseif ( $show_thumb == 'square' ) { $thumbnail_name   = 'post-thumbnail'; }
			elseif ( $show_thumb == 'portrait' ) { $thumbnail_name = 'nutmeg-thumb-portrait'; }

			echo $before_widget;

			if ( $title ) { echo $before_title; echo $title; echo $after_title; }

			echo '<ul class="widget-nutmeg-posts-list widget-nutmeg-posts--' . esc_attr($show_format) . '">';

			while ( $widget_loop->have_posts() ) : $widget_loop->the_post(); $i++;

				echo '<li class="widget-nutmeg-posts-item">';

				if ( $show_thumb != '0' && has_post_thumbnail() ) { ?>
				<div class="entry-thumbnail">
					<div class="entry-thumbnail-wrapper"><?php 

						$image_attributes 	= array('alt' => esc_attr( __('Thumbnail for ','nutmeg' ) ) . get_the_title());
						echo '<a href="' . esc_url( get_permalink() ) . '">';
						the_post_thumbnail($thumbnail_name, $image_attributes);
						echo '</a>'; ?>
					</div><!-- .entry-thumbnail-wrapper -->
				</div><!-- .entry-thumbnail --><?php } ?>

				<div class="entry-preview">
					<div class="entry-preview-wrapper">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php 
						if ( $show_date == 1 ) { 
							echo '<p class="entry-meta"><span class="post-meta-span post-meta-span-time"><time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time></span></p><!-- .entry-meta -->';
						}
						?>
					</div><!-- .entry-preview-wrapper -->
				</div><!-- .entry-preview --><?php
				echo '</li><!-- .widget-nutmeg-posts-item -->';

			endwhile;

			echo '</ul><!-- .widget-nutmeg-posts -->';

			echo $after_widget;

			//Reset query_posts
			wp_reset_query();			

		} // if there are posts

		ob_end_flush();

	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['widget_title'] 		= sanitize_text_field ( $new_instance['widget_title'] );
		$instance['category'] 			= sanitize_text_field ( $new_instance['category'] );
		$instance['show_num'] 			= (int) $new_instance['show_num'];
		$instance['show_format'] 		= isset( $new_instance['show_format'] ) ? sanitize_text_field($new_instance['show_format']) : 'compact';
		$instance['show_thumb'] 		= isset( $new_instance['show_thumb'] ) ? (bool) $new_instance['show_thumb'] : 0;
		$instance['show_date'] 			= isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : 0;

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'widget_title' 		=> __('Recent Posts','nutmeg'), 
			'category' 			=> 0, 
			'show_num' 			=> '3', 
			'show_format' 		=> 'compact', 
			'show_thumb' 		=> 'landscape', 
			'show_date' 		=> 1
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php esc_html_e('Widget Title', 'nutmeg'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" value="<?php echo esc_attr($instance['widget_title']); ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e('Category of posts', 'nutmeg'); ?>:</label>
				<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat">
					<option value="0"><?php esc_html_e('- show from all categories -', 'nutmeg'); ?></option>
					<?php
					
					$cats = get_categories('hide_empty=0');
					foreach ($cats as $cat) {
						$option = '<option value="'.esc_attr($cat->slug);
						if ($cat->slug == $instance['category']) { $option .='" selected="selected';}
						$option .= '">';
						$option .= esc_html($cat->cat_name);
						$option .= ' (' . esc_html($cat->category_count) . ')';
						$option .= '</option>';
						echo $option;
					}
				?>
				</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php esc_html_e('Number of posts to display', 'nutmeg'); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" class="widefat">
				<?php 
				$i = 0;
				while ($i < 10) {
					$i++;
					?><option value="<?php echo esc_attr($i); ?>"<?php if ($instance['show_num'] == $i) { echo ' selected="selected"';} ?>><?php echo esc_html($i); ?></option><?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_format' ); ?>"><?php esc_html_e('Posts Format', 'nutmeg'); ?>:</label>
				<select id="<?php echo $this->get_field_id('show_format'); ?>" name="<?php echo $this->get_field_name('show_format'); ?>" class="widefat">
					<option value="compact"><?php esc_html_e('Compact', 'nutmeg'); ?></option>
					<?php
					echo '<option value="large"';
					if ('large' == $instance['show_format']) { echo ' selected="selected"'; }
					echo '>' . esc_attr('Large','nutmeg') . '</option>';
				?>
				</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php esc_html_e('Post Thumbnail', 'nutmeg'); ?>:</label>
				<select id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" class="widefat">
					<option value="0"><?php esc_html_e('Don\'t display', 'nutmeg'); ?></option>
					<?php
					echo '<option value="landscape"';
					if ('landscape' == $instance['show_thumb']) { echo ' selected="selected"'; }
					echo '>' . esc_attr('Landscape','nutmeg') . '</option>';
					echo '<option value="square"';
					if ('square' == $instance['show_thumb']) { echo ' selected="selected"'; }
					echo '>' . esc_attr('Square','nutmeg') . '</option>';
					echo '<option value="portrait"';
					if ('portrait' == $instance['show_thumb']) { echo ' selected="selected"'; }
					echo '>' . esc_attr('Portrait','nutmeg') . '</option>';
				?>
				</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $instance['show_date'] ); ?>  id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php esc_html_e('Display date', 'nutmeg'); ?></label>
		</p>
		
		<?php
	}
}