<?php
class fotography_widget extends WP_Widget {

    function fotography_widget() {
        global $control_ops, $post_cat, $post_num, $post_length;
        $widget_ops = array(
            'classname' => 'pfc-widget',
            'description' => __('Fotography Latest Post', 'fotography')
        );
        parent::__construct('fotography_widget', __('FG : Latest Post', 'fotography'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        $title = !empty($instance['title']) ? $instance['title'] : 'Latest Post';
        $post_number = !empty($instance['post_number']) ? $instance['post_number'] : '3';
        $feature_image = $instance['feature_image'];
        $post_image_like = !empty($instance['post_image_like']) ? $instance['post_image_like'] : 'no';
        $post_comment = !empty($instance['post_comment']) ? $instance['post_comment'] : 'yes';
        $post_category = !empty($instance['post_category']) ? $instance['post_category'] : 'gallery';
        
        echo $before_title; ?>
            <?php echo esc_attr($title); ?>
        <?php echo $after_title; ?>

        <div class="latest-gallery-widget">
            <ul>
                <?php
                $args = array(
                    'posts_per_page' => $post_number,
                    'cat' => $post_category
                );

                $query = new WP_Query($args);
                if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                ?>  
                <li class="clearfix">
                        <div class="latest-gallery-thumb">
                            <?php if (!empty($feature_image) && $feature_image != '0') : ?>
                                <a class="entry-img" href="<?php esc_url(the_permalink()); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        esc_url(the_post_thumbnail(array(150, 150)));
                                    }
                                    ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="latest-gallery-title-comment">							
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
  
                                <div class="latest-gallery-comment">	
                                    <i class="fa fa-comments-o fa-lg"></i>
                                    <span class="comments-count"><?php comments_number('0', '1', '%'); ?></span>                                                                        
                                </div>
                        </div>
                        </li>
                    <?php
                    endwhile;
                endif;
                wp_reset_query();
                ?>
            </ul>
        </div>		

        <?php
        echo $after_widget;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'post_type' => '', 'post_number' => '', 'feature_image' => '',
            'post_image_like' => '', 'post_comment' => '', 'post_category' => ''));
        $title = isset($instance['title']) ? $instance['title'] : '';
        $post_type = isset($instance['post_type']) ? $instance['post_type'] : '';
        $post_number = isset($instance['post_number']) ? $instance['post_number'] : '';
        $feature_image = isset($instance['feature_image']) ? $instance['feature_image'] : '';
        $post_image_like = isset($instance['post_image_like']) ? $instance['post_image_like'] : '';
        $post_comment = isset($instance['post_comment']) ? $instance['post_comment'] : '';
        $post_category = isset($instance['post_category']) ? $instance['post_category'] : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title', 'fotography'); ?>:
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="fotography Title"/>		
        </p>		


        <p>
            <label for="<?php echo $this->get_field_id('post_category'); ?>">
                <?php _e('Category', 'fotography'); ?> :
            </label>
            <select class="widefat" id="<?php echo $this->get_field_id('post_category'); ?>" name="<?php echo $this->get_field_name('post_category'); ?>">
                <option value="0">&mdash;<?php __('Select Post Category', 'fotography'); ?>&mdash;</option>
                <?php
                //select category for Blogs
                $categories = get_categories();
                $cats = array();
                $cats[] = 'Select Category';
                foreach ($categories as $category) {
                    ?>
                    <option value='<?php echo $category->slug; ?>' <?php
                    if (@$post_category == $category->slug) {
                        echo 'selected="selected"';
                    }
                    ?> ><?php echo esc_attr($category->name); ?></option>	
                    <?php
                }
                ?>		
            </select>
        </p> 


        <p>
            <label for="<?php echo $this->get_field_id('post_number'); ?>">
    <?php _e('Number of posts to show', 'fotography'); ?> :
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo intval($post_number); ?>" placeholder="Number Of Post"/>		
        </p>

        <p>
            <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('feature_image'); ?>" name="<?php echo $this->get_field_name('feature_image'); ?>" <?php checked($feature_image, 1); ?>>
            <label for="<?php echo $this->get_field_id('feature_image'); ?>">Display Feature Image?</label>
        </p>			
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['post_type'] = sanitize_text_field($new_instance['post_type']);
        $instance['post_number'] = sanitize_text_field($new_instance['post_number']);
        $instance['feature_image'] = isset($new_instance['feature_image']) ? 1 : 0;
        $instance['post_image_like'] = sanitize_text_field($new_instance['post_image_like']);
        $instance['post_comment'] = sanitize_text_field($new_instance['post_comment']);
        $instance['post_category'] = sanitize_text_field($new_instance['post_category']);
        return $instance;
    }

}

function fotography_widget_reg() {
    register_widget('fotography_widget');
}

add_action('widgets_init', 'fotography_widget_reg');
?>
