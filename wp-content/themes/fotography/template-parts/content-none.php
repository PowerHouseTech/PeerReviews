<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FotoGraphy
 */
?>

<section class="no-results not-found">
    <header class="page-title">
        <h1>
            <span class="outer">
                <?php esc_html_e('Nothing Found', 'fotography'); ?>
                <div class="clearfix"></div>
                <span class="inner">
                </span>
            </span>
        </h1>
    </header>

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php printf(wp_kses(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fotography'), array('a' => array('href' => array()))), esc_url(admin_url('post-new.php'))); ?></p>

        <?php elseif (is_search()) : ?>

            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fotography'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fotography'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
