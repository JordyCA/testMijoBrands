<?php if (!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
	  <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
	<button type="submit" class=" button-black " value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>"> teste</button>
</form>

<ul>
<?php 
$taxonomies = get_terms( array(
    'taxonomy' => 'property-type', //Custom taxonomy name
    'hide_empty' => false
) );

foreach($taxonomies as $term) {
    echo '<li>' . $term->name . '</li>';
}
?>
</ul>
<?php get_footer(); ?>