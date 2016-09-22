<?php
class Wli_Popular_Posts extends WP_Widget {
	
	/**
	 * 
	 * Unique identifier for your widget.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * widget file.
	 *
	 * @since    1.0.1
	 *
	 * @var      string
	 */
	protected $widget_slug = 'wli_popular_posts';

	/**
	 *   Wli_Popular_Posts constructor
	 *
	 *  @since    			1.0.1
	 *
	 *  @return             void
	 *  @var                No arguments passed
	 *  @author             weblineindia
	 *
	 */
	public function __construct()
	{
		parent::__construct(
				$this->get_widget_slug(),
				__( 'Popular Posts by Webline', $this->get_widget_slug() ),
				array(
						'classname'     =>  $this->get_widget_slug().'-class',
						'description'   => __('A Simple plugin to show the posts as per the filter applied.',$this->get_widget_slug()),
				)
		);
		if ( ! class_exists( 'Walker_Category_Checklist_Widget' ) ) {
			require_once( 'walker.php' );
		}
	}

	/**
	 * get_widget_slug() is use to get the widget slug.
	 *
	 * @since     1.0.1
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

	/**
	 *  form() is used to generates the administration form for the widget.
	 *
	 *  @since    			1.0.1
	 *
	 *  @return             void
	 *  @var                $instance
	 *  @author             weblineindia
	 *
	 */

	function form( $instance ) {
		$defaults = array(
				'category' 	 	 		=> array(),
				'title'	   	 	 		=> 'Popular Posts',
				'no_posts' 	 	 		=> '3',
				'days_filter'	 		=> 'None',
				'sort_by'		 		=> 'Comments',
				'no_comments'	 		=> 'yes',
				'views_count'	 		=> 'yes',
				'post_date'		 		=> 'yes',
				'featured_image' 		=> 'yes',
				'featured_width' 		=> '100',
				'featured_height'		=> '100',
				'featured_align'		=> 'left',
                'content'		 		=> 'yes',
				'content_length' 		=> '25',
				'readmore_text'			=> '[...]',
				'exc_curr_post' 		=> 'no',
				'relative_date' 		=> 'no'
		);
		
		$instance		= wp_parse_args( (array) $instance, $defaults );
		
		$title			= esc_attr($instance['title'] );
		$no_posts		= esc_attr($instance['no_posts'] );
		$days_filter	= $instance['days_filter'];
		$sort_by		= $instance['sort_by'];
		$category		= $instance['category'];
		$comments 		= $instance['no_comments'];
		$views_count 	= $instance['views_count'];
		$post_date		= $instance['post_date'];
		$featured_image = $instance['featured_image'];
		$featured_width = esc_attr($instance['featured_width']);
		$featured_height= esc_attr($instance['featured_height']);
		$featured_align = $instance['featured_align'];
		$content		= $instance['content'];
		$content_length = esc_attr($instance['content_length']);
		$readmore_text  = esc_attr($instance['readmore_text']);
		$exc_curr_post	= $instance['exc_curr_post'];
		$relative_date	= $instance['relative_date'];
		?>
		<style>
			.categorychecklist
			{
				border: 1px solid #EEE; 
				padding: 2px 0px 0px 5px; 
				max-height: 100px; 
				overflow: auto;
				margin-top:-10px;
			}
			.pp_input_box{width: 31.3337%; margin:-2% 1% 4% 0; float: left;}
		</style>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', $this->get_widget_slug()); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('no_posts'); ?>"><?php _e('No. of Posts to Show', $this->get_widget_slug()); ?></label> 
			<input class="widefat" maxlength="4" id="<?php echo $this->get_field_id('no_posts'); ?>" name="<?php echo $this->get_field_name('no_posts'); ?>" type="text" value="<?php echo $no_posts; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('days_filter'); ?>"><?php _e('Show Post Before (Days)', $this->get_widget_slug()); ?></label> 
			<select id="<?php echo $this->get_field_id('days_filter'); ?>" name="<?php echo $this->get_field_name('days_filter'); ?>" class="widefat">
				<?php $filterby=array( 'None', '7', '15', '30', '45' );?>
				<?php foreach($filterby as $post_type) { ?>
				<option <?php selected( $instance['days_filter'], $post_type ); ?> value="<?php echo $post_type; ?>">
					<?php echo $post_type; ?>
				</option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort By', $this->get_widget_slug()); ?></label> 
			<select id="<?php echo $this->get_field_id('sort_by'); ?>" name="<?php echo $this->get_field_name('sort_by'); ?>" class="widefat">
				<option <?php selected( $instance['sort_by'], 'Comments'); ?> value="Comments">Comments</option>
				<option <?php selected( $instance['sort_by'], 'Post Views Count'); ?> value="Post Views Count">Post Views Count</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('no_comments'); ?>"><?php _e('Show No. of Comments', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('no_comments'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['no_comments'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('no_comments'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['no_comments'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('views_count'); ?>"><?php _e('Show Post Views Count', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('views_count'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['views_count'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('views_count'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['views_count'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('post_date'); ?>"><?php _e('Show Post Date', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('post_date'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['post_date'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('post_date'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['post_date'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('featured_image'); ?>"><?php _e('Show Featured Image', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('featured_image'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['featured_image'], true ); ?>>Yes &nbsp;&nbsp;			
			<input type="radio" name="<?php echo $this->get_field_name('featured_image'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['featured_image'], true ); ?>>No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('featured_width'); ?>"><?php _e('Featured Image (Width,Height,Align)', $this->get_widget_slug()); ?></label> 
		</p>
		
		<p class="pp_input_box">
			<input class="widefat" id="<?php echo $this->get_field_id('featured_width'); ?>" name="<?php echo $this->get_field_name('featured_width'); ?>" type="text" value="<?php echo $featured_width; ?>" />
		</p>
		
		<p class="pp_input_box">
			<input class="widefat" id="<?php echo $this->get_field_id('featured_height'); ?>" name="<?php echo $this->get_field_name('featured_height'); ?>" type="text" value="<?php echo $featured_height; ?>" />
		</p>
	
		<p class="pp_input_box">
			<select id="<?php echo $this->get_field_id( 'featured_align' ); ?>" name="<?php echo $this->get_field_name( 'featured_align' ); ?>" class="widefat">
				<option value="left" <?php selected( $instance['featured_align'], 'left' ); ?>>Left</option>
				<option value="right" <?php selected( $instance['featured_align'], 'right' ); ?>>Right</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Show Excerpt', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('content'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['content'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('content'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['content'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('content_length'); ?>"><?php _e('Excerpt Length', $this->get_widget_slug()); ?></label><br>
			<input class="widefat" id="<?php echo $this->get_field_id('content_length'); ?>" name="<?php echo $this->get_field_name('content_length'); ?>" type="text" value="<?php echo $content_length;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('readmore_text'); ?>"><?php _e('Read More Text', $this->get_widget_slug()); ?></label><br>
			<input class="widefat" id="<?php echo $this->get_field_id('readmore_text'); ?>" name="<?php echo $this->get_field_name('readmore_text'); ?>" type="text" value="<?php echo $readmore_text;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select Category', $this->get_widget_slug()); ?></label>
			<?php
			$walker = new Walker_Category_Checklist_Widget($this->get_field_name('category'), $this->get_field_id('category'));
			echo '<ul class="categorychecklist">';
			wp_category_checklist( 0, 0, $instance['category'], FALSE, $walker, FALSE);
			echo '</ul>';
			?>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" value="yes" <?php checked($instance['exc_curr_post'], 'yes'); ?> id="<?php echo $this->get_field_id('exc_curr_post'); ?>" name="<?php echo $this->get_field_name('exc_curr_post'); ?>" />
			<label for="<?php echo $this->get_field_id('exc_curr_post'); ?>"><?php _e( 'Exclude Current Post', $this->get_widget_slug()); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" value="yes" <?php checked($instance['relative_date'], 'yes'); ?> id="<?php echo $this->get_field_id('relative_date'); ?>" name="<?php echo $this->get_field_name('relative_date'); ?>" />
			<label for="<?php echo $this->get_field_id('relative_date'); ?>"><?php _e('Show Relative Date', $this->get_widget_slug()); ?></label>
		</p>
	
<?php
	}

	/**
	 *  update() is used to replace the new value when the Saved button is clicked.
	 *
	 *  @since    			1.0.1
	 *
	 *  @return             $instance
	 *  @var                $new_instance,$old_instance
	 *  @author             weblineindia
	 *
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']			= sanitize_text_field($new_instance['title']);
		$instance['no_posts'] 		= sanitize_text_field($new_instance['no_posts']);
		$instance['days_filter']	= $new_instance['days_filter'];
		$instance['sort_by']		= $new_instance['sort_by'];
		$instance['category']		= isset($new_instance['category'])?$new_instance['category'] :array();
		$instance['no_comments']	= isset($new_instance['no_comments'])?$new_instance['no_comments'] :'yes';
		$instance['views_count']	= isset($new_instance['views_count'])?$new_instance['views_count'] :'yes';
		$instance['post_date']		= isset($new_instance['post_date'])?$new_instance['post_date'] :'yes';
		$instance['featured_image'] = isset($new_instance['featured_image'])?$new_instance['featured_image'] :'yes';
		$instance['featured_width']	= sanitize_text_field($new_instance['featured_width']);
		$instance['featured_height']= sanitize_text_field($new_instance['featured_height']);
		$instance['featured_align'] = $new_instance['featured_align'];
		$instance['content']		= isset($new_instance['content'])?$new_instance['content'] :'yes';
		$instance['content_length']	= sanitize_text_field($new_instance['content_length']);
		$instance['readmore_text']	= sanitize_text_field($new_instance['readmore_text']);
		$instance['exc_curr_post']	= isset($new_instance['exc_curr_post'])?$new_instance['exc_curr_post'] :'no';
		$instance['relative_date']	= isset($new_instance['relative_date'])?$new_instance['relative_date'] :'no';
		return $instance;
	}
	
	/**
	 *  time_ago() is used to convert date to time duration.
	 *
	 *  @since    			1.0.3
	 *
	 *  @return             $since
	 *  @var                $from,$to
	 *  @author             Weblineindia
	 *
	 */
	public function time_ago( $from, $to = '' ) {
		if ( empty( $to ) ) {
			$to = time();
		}
	
		$diff = (int) abs( $to - $from );
	
		if ( $diff < HOUR_IN_SECONDS ) {
			$mins = round( $diff / MINUTE_IN_SECONDS );
			if ( $mins <= 1 )
				$mins = 1;
			$since = sprintf( _n( '%s min', '%s mins', $mins ), $mins );
		} elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
			$hours = round( $diff / HOUR_IN_SECONDS );
			if ( $hours <= 1 )
				$hours = 1;
			$since = sprintf( _n( '%s hour', '%s hours', $hours ), $hours );
		} elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
			$days = round( $diff / DAY_IN_SECONDS );
			if ( $days <= 1 )
				$days = 1;
			$since = sprintf( _n( '%s day', '%s days', $days ), $days );
		} elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
			$weeks = round( $diff / WEEK_IN_SECONDS );
			if ( $weeks <= 1 )
				$weeks = 1;
			$since = sprintf( _n( '%s week', '%s weeks', $weeks ), $weeks );
		} elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
			$months = round( $diff / MONTH_IN_SECONDS );
			if ( $months <= 1 )
				$months = 1;
			$since = sprintf( _n( '%s month', '%s months', $months ), $months );
		} elseif ( $diff >= YEAR_IN_SECONDS ) {
			$years = round( $diff / YEAR_IN_SECONDS );
			if ( $years <= 1 )
				$years = 1;
			$since = sprintf( _n( '%s year', '%s years', $years ), $years );
		}
	
		return $since." ago";
	}
	
	/**
	 * widget() is used to show the frontend part .
	 *
	 *  @since    1.0.1
	 *
	 *  @return             void
	 *  @var                $args,$instance
	 *  @author             weblineindia
	 *
	 */
	function widget($args, $instance) {
	
		global $content_length,$readmore_text;
		
		extract( $args,EXTR_SKIP);
	
		wp_enqueue_style( 'popularposts-style', PP_URL . '/admin/assets/css/popular-posts-style.css' );
		
		$title		 	= apply_filters( 'widget_title', $instance['title'] );
		$no_posts	 	= $instance['no_posts'];
		$days_filter 	= $instance['days_filter'];
		$sort_by		= $instance['sort_by'];
		$category	 	= $instance['category'];
		$comments 		= $instance['no_comments'];
		$views_count 	= $instance['views_count'];
		$post_date		= $instance['post_date'];
		$featured_image = $instance['featured_image'];
		$featured_width = !empty($instance['featured_width'])?$instance['featured_width']:'100';
		$featured_height= !empty($instance['featured_height'])?$instance['featured_height']:'100';
		$featured_align = $instance['featured_align'];
		$content		= $instance['content'];
		$content_length = !empty($instance['content_length'])?$instance['content_length']:'25';
		$readmore_text  = !empty($instance['readmore_text'])?$instance['readmore_text']:'[...]';
		$exc_curr_post	= $instance['exc_curr_post'];
		$relative_date	= $instance['relative_date'];
		
		echo $before_widget;
	
		echo $before_title . $title . $after_title;

		if($sort_by == "Comments")
		{
			$args = array(
					'posts_per_page'=>	$no_posts,
					'orderby'		=>	'comment_count',
					'order'			=>  'DESC',
					'category__in'  =>  $category,
					'date_query'    =>  array(
						array(
								'column' => 'post_date_gmt',
								'after'  => $days_filter.'days ago',
						)
					)
			);
		}
		else
		{
			$args = array(
					'posts_per_page'=>	$no_posts,
					'meta_key'		=>  'wli_pp_post_views_count',
					'orderby'		=>	'meta_value_num',
					'category__in'  =>  $category,
					'date_query'    =>  array(
							array(
									'column' => 'post_date_gmt',
									'after'  => $days_filter.'days ago',
							)
					)
			);
		}
	
		if($exc_curr_post == "yes" && is_single())
		{
			$args['post__not_in'] = array(get_the_ID());
		}
		
		$the_query = new WP_Query( $args );
			
		if ( $the_query->have_posts() ) {
			add_filter( 'excerpt_length','wli_popular_posts_excerpt_length');
			add_filter( 'excerpt_more','wli_popular_posts_excerpt_more' );
			echo '<ul>';
			while ( $the_query->have_posts() )
			{
				$the_query->the_post();
				?>
					<li>
						<?php 
						if($featured_image =='yes')
						{
							if ( has_post_thumbnail() )
							{
							?>
								<div class="post_thumb <?php echo ($featured_align == 'left')?'post_thumb_left':'post_thumb_right';?>">
			                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_post_thumbnail(array($featured_width,$featured_height));?>
									</a>
		                        </div>
	                        <?php
	                        }	
						}
						?>
                        <h3>
	                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
							</a>
                        </h3>
						<?php 
						if($content == 'yes')
						{
							the_excerpt();
						}
						?>
        				<?php 
        				if($comments == 'yes' || $post_date == 'yes' || $views_count == 'yes')
        				{        				
        				?>
							<div class="bottom_bar">
		                        <p>
			                        <?php
			                        if($views_count == 'yes')
			                        {
			                        	$post_views = wli_popular_posts_get_post_views(get_the_ID());
										$views_title = sprintf( _n( '%s Post View', '%s Post Views', $post_views, $this->get_widget_slug() ), $post_views );
				
			                        	echo "<span><img title='".$views_title."' src='".PP_URL ."/admin/assets/images/view_icon.png'/> ".$post_views."</span>";
			                        }
									if($comments == 'yes')
									{
										$comments_count = wp_count_comments(get_the_ID());
										$comments_title = sprintf( _n( '%s Comment', '%s Comments', $comments_count->approved, $this->get_widget_slug() ), $comments_count->approved );
										echo "<span><a href='".get_comments_link( get_the_ID() )."' title='".$comments_title."'><img src='".PP_URL ."/admin/assets/images/comment_icon.png'/> ".$comments_count->approved."</a></span>";
									}
									if($post_date == 'yes')
									{
										if($relative_date == "yes")
											$date = $this->time_ago(get_the_date('U'),current_time('timestamp'));
										else
											$date = get_the_date();
										
										echo "<span><img title='".$date."' src='".PP_URL ."/admin/assets/images/date_icon.png'/> ".$date."</span>";
									}
									?>
		                        </p>
	                        </div>
						<?php 
        				}
						?>
					</li>
		 		<?php 
				}
				echo '</ul>';
				remove_filter('excerpt_length','wli_popular_posts_excerpt_length');
				remove_filter('excerpt_more','wli_popular_posts_excerpt_more');
			}
				
			wp_reset_postdata();
				
			echo $after_widget;
		}
}
add_action( 'widgets_init', create_function('', 'return register_widget("Wli_Popular_Posts" );'));


if ( ! function_exists ('wli_popular_posts_excerpt_length' ) ) {
	function wli_popular_posts_excerpt_length( $length ) {
		global $content_length;
		return $content_length;
	}
}

if ( ! function_exists ('wli_popular_posts_excerpt_more' ) ) {
	function wli_popular_posts_excerpt_more( $more ) {
		global $readmore_text;
		return '<a href="'.get_the_permalink().'"> '.$readmore_text.'</a>';
	}
}

function wli_popular_posts_set_post_views($postID) {
	$count_key = 'wli_pp_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 1;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '1');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wli_popular_posts_track_post_views ($post_id) {
	if ( !is_single() ) return;
	if ( empty ( $post_id) ) {
		global $post;
		$post_id = $post->ID;
	}
	wli_popular_posts_set_post_views($post_id);
}
add_action( 'wp_head', 'wli_popular_posts_track_post_views');

function wli_popular_posts_get_post_views($postID){
	$count_key = 'wli_pp_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}