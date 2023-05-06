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

function my_theme_supports_fn() // 5 min 
{
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action('init', 'my_theme_supports_fn');

function my_theme_js_css_fn() {
    wp_enqueue_script( 'examenjsmain', plugins_url( 'assets/js/main.js', __FILE__ ) , array('jquery'), 1.0, true );
    wp_enqueue_style ( 'examencssmain', plugins_url( 'assets/css/main.css', __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'my_theme_js_css_fn' );

function my_clean_theme_fn() // 5 min
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
 * - Bonus: Dentro del detalle de propiedad, puedes llamar una WP Query para obtener otras 2 propiedades que tengan la misma taxonomía que la actual y mostrarlas en un contenedor con el título "Recommended Properties"
 */
// code here

add_action( 'init', 'add_cpt_properties' );
function add_cpt_properties() {
     $args = array(
     'public' => true,
     'label' => 'properties'
);
register_post_type( 'properties', $args );
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


/**
 * ## Modifica el orden de los posts mostrados en los resultados de búsqueda utilizando un hook.
 *  
 * Si el usuario utiliza el searchform, esté será dirigido a la página de resultados
 * En esta página de resultados, buscamos que los resultados estén ordenados por `post_title` y fecha ASC
 *
 */
// code here


/**
 * ## Crea una función que cargue un archivo CSS y JS unicamente en las entradas de blog.
 * Hay 1 archivo CSS y un archivo JS en sus respectivas carpetas con el prefijo "blog-" esos archivos deben cargarse únicamente en las entradas de blog
 *
 */
// code here


/**
 * ## Registra un nuevo tamaño de imagen de 1240x720 para uso de este tema
 *
 * @bonus: Registra también la versi´ón @2x para pantallas retina
 */


/**
 * ## Crea una función que reemplace el texto "555-5555" por "555-6666" dentro del contenido de los posts.
 *
 */
// code here


/**
 * ## Gutenberg block: Registrar un estilo variante para el bloque core/button
 *
 */
// code here



/**
 * Bonus:
 * ## Añade un empaquetador de tu preferencia y cambia los imports a archivos minificados
 * - - Puede ser webpack, gulp, grunt, laravel-mix o cualquier otro
 * - - Los archivos serían por ejemplo /dist/css/*.min.css y /dist/js/*.min.js en lugar de los otorgados orginalmente
 * ##
 */