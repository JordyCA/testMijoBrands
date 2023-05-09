<?php if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<section>

    <?php
    $queryCustomPost = new WP_Query(array(
        'post_type' => 'properties',
        'post_status' => 'publish',
    ));

    while ($queryCustomPost->have_posts()) { 
        $queryCustomPost->the_post();    
    ?>
        <h1> <?php echo get_the_title() ?> </h1>
        <div class="property-content__container">                                                        
            <?php echo get_the_content();?>
        </div>
        
    <?php }

    wp_reset_query();
    ?>

</section>


<?php get_footer(); ?>