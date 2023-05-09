<?php

/**
 * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 *
 * ¡Bienvenido/a al test técnico! Esta prueba ha sido diseñada para evaluar tus habilidades y conocimientos como desarrollador/a de WordPress.
 *
 * Queremos conocer tu experiencia en el desarrollo de temas y plugins, así como tus habilidades en el uso de hooks, funciones, custom post types, taxonomías y otras herramientas propias de WordPress.
 *
 * Durante la prueba, te pediremos que realices una serie de tareas que implicarán la modificación y creación de diferentes elementos en WordPress.
 * Estas tareas están basadas en situaciones comunes que podrías enfrentar en tu día a día como desarrollador/a.
 *
 * Nuestro objetivo es evaluar tu capacidad para resolver problemas de manera efectiva, escribir código limpio y fácil de mantener, y aplicar buenas prácticas de desarrollo. Esperamos que aproveches al máximo esta oportunidad para demostrar tus habilidades y conocimientos técnicos.
 *
 * ¡Buena suerte y mucho éxito en la prueba técnica!
 *
 * @author Mijo Brands <developer@mijobrands.com>
 *
 * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 */

/**
 * Por favor llena las siguientes variables
 *
 * @var Nombre: Jordy Jesus Castro Avendaño
 * @var Email: jordycastroavendano@gmail.com
 * @var Exp: 4 - Años de experiencia como Desarrollador de Wordpress
 */

/** - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 * Asumiendo que este documento es el punto de entrada de un tema de Wordpress,
 * resuelve los siguientes ejercicios
 * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 */

/**
 * # Inicializa el tema con las siguientes especificaciones
 * - Soporte HTML5 con searchform
 * - Soporte title tag
 * - Soporte post thumbnails
 * - Añade el CSS y JS del tema
 * - Quitar cabeceras de Wordpress innecesarias (limpieza de código)
 * - Quitar emojis
 */

function my_theme_supports_fn()
{
    add_theme_support('html5', array('search-form'));
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('init', 'my_theme_supports_fn');

function my_theme_js_css_fn()
{
    wp_enqueue_script('examenjsmain', plugins_url('dist/js/main.js', __FILE__), array('jquery'), 1.0, true);
    wp_enqueue_style('examencssmain', plugins_url('dist/css/main.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'my_theme_js_css_fn');

function my_clean_theme_fn()
{
    remove_action('wp_head', 'rsd_link'); // elimina la cabecera para el servicio Really Simple Discovery (RSD)
    remove_action('wp_head', 'wp_generator'); // elimina la versión de WordPress
    remove_action('wp_head', 'feed_links', 2); // elimina los enlaces de los feeds
    remove_action('wp_head', 'wlwmanifest_link'); // elimina la cabecera del Windows Live Writer
    remove_action('wp_head', 'wp_shortlink_wp_head'); // elimina los enlaces cortos de WordPress
    remove_action('wp_head', 'rest_output_link_wp_head'); // elimina la cabecera para el API REST
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); // elimina la cabecera para los enlaces de incrustación de WordPress
    remove_action('wp_head', 'wp_resource_hints', 2); // elimina las sugerencias de recursos para navegadores
    remove_action('wp_head', 'print_emoji_detection_script', 7); // elimina la detección de emojis
    remove_action('wp_print_styles', 'print_emoji_styles'); // elimina los estilos de emojis
}
add_action('init', 'my_clean_theme_fn');


/**
 * ## Registra un custom post type
 *
 * - Nombre: Property
 * - Tendra un archive page
 * - Su slug será "properties"
 * - Aparece en b´úsquedas pero no en el API
 * - Deshabilitar gutenberg
 *
 * - Crea el archivo para el listado de estos elementos
 * - - Sólo es necesario que lleve el header, loop y footer
 *
 * - Crea el archivo en el tema para el detalle de estos elementos, con header, content y footer
 * - Solo muestra el título en h1 con la clase .property-title
 * - Mete el content en un div llamado .property-content__container
 *
 * - Bonus: Dentro del detalle de propiedad, puedes llamar una WP Query para obtener otras 2 propiedades 
 * que tengan la misma taxonomía que la actual y mostrarlas en un contenedor con el título "Recommended Properties"
 */
// code here

add_action('init', 'add_cpt_properties');
function add_cpt_properties()
{
    $args = array(
        'label' => 'Property',
        'public' => true,
        'rewrite' => array('slug' => 'properties'),
        'show_in_rest' => false,
        'post_type' => 'properties'
    );
    register_post_type('Property', $args);
}

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');
add_filter('use_block_editor_for_post_type', function ($enabled, $post_type) {
    return 'properties' === $post_type ? false : $enabled;
}, 10, 2);
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 20);


add_shortcode('shortcodeview', 'shortcode_view');

function shortcode_view()
{
    require_once plugin_dir_path(__FILE__) . 'views/view.php';
}



/**
 * ## Registra una taxonomia nueva para el post type creado anteriormente
 *
 * - Nombre: Type
 * - Slug: "property-type"
 * - Opciones: House, Condo, Land
 * - Publicamente visible, excepto en API
 * - Crea el archivo para listar las propiedades que estén en esta taxonomia
 * - - Sólo se requiere el header, loop y footer
 */
// code here
add_action('init', 'add_new_taxomy');

function add_new_taxomy()
{

    register_taxonomy('property-type', 'property', array(
        'labels' => array(
            'name' => 'Type',
        ),
        'rewrite' => array('slug' => 'property-type'),
        'public' => true,

    ));
    wp_insert_term('House', 'property-type');
    wp_insert_term('Condo', 'property-type');
    wp_insert_term('Land', 'property-type');
}

add_shortcode('shortcodeviewtax', 'shortcode_view_tax');

function shortcode_view_tax()
{
    require_once plugin_dir_path(__FILE__) . 'views/viewtax.php';
}

/**
 * ## Modifica el orden de los posts mostrados en los resultados de búsqueda utilizando un hook.
 *  
 * Si el usuario utiliza el searchform, esté será dirigido a la página de resultados
 * En esta página de resultados, buscamos que los resultados estén ordenados por `post_title` y fecha ASC
 *
 */
// code here

function modify_get_search_query_defaults($search)
{
    if ($search->is_search()) {
        $search->query_vars['orderby'] = array(
            'post_title' => 'ASC',
            'post_date' => 'ASC'
        );
    }
    return $search;
}

add_filter( "parse_query", "modify_get_search_query_defaults", 10, 1 );


/**
 * ## Crea una función que cargue un archivo CSS y JS unicamente en las entradas de blog.
 * Hay 1 archivo CSS y un archivo JS en sus respectivas carpetas con el prefijo "blog-" esos archivos deben cargarse únicamente en las entradas de blog
 *
 */
// code here
function add_blog_css_js() {
    if ( is_single() ) {
        wp_enqueue_style( 'blogstyles', plugins_url('dist/css/blog-styles.css', __FILE__));
        wp_enqueue_script( 'blogjavascript', plugins_url('dist/js/blog-scripts.js', __FILE__) );
    }
}
add_action( 'wp_enqueue_scripts', 'add_blog_css_js' );

/**
 * ## Registra un nuevo tamaño de imagen de 1240x720 para uso de este tema
 *
 * @bonus: Registra también la versi´ón @2x para pantallas retina
 */

 function add_image_size_high() {
    add_image_size( 'imageHigh', 1240, 720, true );
    add_image_size( '1536x720', 1240, 720);
}
add_action( 'after_setup_theme', 'add_image_size_high' );


/**
 * ## Crea una función que reemplace el texto "555-5555" por "555-6666" dentro del contenido de los posts.
 *
 */
// code here
add_filter('the_content', 'changue_numbers');
function changue_numbers($content){
    return str_replace('555-5555', '555-5556', $content);

}

/**
 * ## Gutenberg block: Registrar un estilo variante para el bloque core/button
 *
 */
// code here 
function new_style_button() {
    wp_register_style(
        'button-black',
        plugins_url('dist/css/button.css', __FILE__),
        array( 'wp-block-library' ),
        '1.0'
    );

    register_block_style(
        'core/button',
        array(
            'name' => 'button-black', 
            'label'        => __( 'Button Black', 'boton rojo con negro' ),
            'style_handle' => 'button-black',
        )
    );
}
add_action( 'init', 'new_style_button' );





/**
 * Bonus:
 * ## Añade un empaquetador de tu preferencia y cambia los imports a archivos minificados
 * - - Puede ser webpack, gulp, grunt, laravel-mix o cualquier otro
 * - - Los archivos serían por ejemplo /dist/css/*.min.css y /dist/js/*.min.js en lugar de los otorgados orginalmente
 * ##
 */
