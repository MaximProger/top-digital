<?php

if (!function_exists('top_digital_setup')) {
    function top_digital_setup() {
        add_theme_support('custom-logo', [
            'height'      => 50,
            'width'       => 130,
            'flex-width'  => false,
            'flex-height' => false,
            'header-text' => '',
            'unlink-homepage-logo' => false, // WP 5.5
        ]);
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 730, 480, true );
    }
    add_action('after_setup_theme', 'top_digital_setup');
}

// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'top_digital_scripts' );

function top_digital_scripts() {
    wp_enqueue_style( 'main', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array("main"));
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array("main"));
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array("main"));
    wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array("main"));
    wp_enqueue_style( 'top-digital', get_template_directory_uri() . '/css/style.css', array("bootstrap"));
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
    wp_enqueue_script( 'jquery', '', '', null,true);
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), null,true);
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('popper'), null,true);
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), null,true);
    wp_enqueue_script( 'easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), null,true);
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), null,true);
    wp_enqueue_script( 'counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), null,true);
    wp_enqueue_script( 'google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), null,true);
    wp_enqueue_script( 'contact', get_template_directory_uri() . '/plugins/jquery/contact.js', array('jquery'), null,true);
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('google-map'), null,true);
}

// инициализация меню
function top_digital_menus() {
    $locations = array(
        'header'  => __( 'Header Menu', 'top_digital' ),
        'footer-left'   => __( 'Footer Left Menu', 'top_digital' ),
        'footer-right'   => __( 'Footer Right Menu', 'top_digital' ),
    );

    register_nav_menus( $locations );
}

add_action('init', 'top_digital_menus');

// добавляем класс для li
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->li_class)) {
        $classes[] = $args->li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

// добавляем класс для ссылок
function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
    // размеры которые нужно удалить
    return array_diff( $sizes, [
        'medium_large',
        'large',
        '1536x1536',
        '2048x2048',
    ] );
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

// выводим пагинацию
the_posts_pagination( array(
    'end_size' => 2,
) );

// регистрируем виджеты
function top_digital_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html('Сайдабр блога', 'top_digital'),
        'id'            => "sidebar-blog",
        'before_widget' => '<div class="col-lg-12"><div class="sidebar-widget  %2$s">',
        'after_widget'  => "</div></div>",
        'before_title'  => '<h5 class="mb-3">',
        'after_title'   => "</h5>",
        'before_sidebar' => '', // WP 5.6
        'after_sidebar'  => '', // WP 5.6
    ));

    register_sidebar(array(
        'name'          => esc_html('Текст в подвале', 'top_digital'),
        'id'            => "sidebar-footer-text",
        'before_widget' => '<div class="footer-widget footer-link">',
        'after_widget'  => "</div>",
        'before_title'  => '<h4>',
        'after_title'   => "</h4>",
    ));

    register_sidebar(array(
        'name'          => esc_html('Контакты в подвале', 'top_digital'),
        'id'            => "sidebar-footer-contacts",
        'before_widget' => '<div class="footer-widget footer-text">',
        'after_widget'  => "</div>",
        'before_title'  => '<h4>',
        'after_title'   => "</h4>",
    ));
}

add_action('widgets_init', 'top_digital_widgets_init');

/**
 * Добавление нового виджета File_Widget.
 */
class File_Widget extends WP_Widget {

    // Регистрация виджета используя основной класс
    function __construct() {
        // вызов конструктора выглядит так:
        // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
        parent::__construct(
            'file_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: file_widget
            'Полезные файлы',
            array( 'description' => 'Описание виджета', /*'classname' => 'my_widget',*/ )
        );

        // скрипты/стили виджета, только если он активен
        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
            add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
            add_action('wp_head', array( $this, 'add_my_widget_style' ) );
        }
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args     аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $file_name_1 = @ $instance['file_name_1'];
        $file_link_1 = @ $instance['file_link_1'];
        $file_name_2 = @ $instance['file_name_2'];
        $file_link_2 = @ $instance['file_link_2'];

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo '<div class="download-list">';
        echo '<a href="'.$file_link_1.'"> <i class="fa fa-file-pdf"></i>'.$file_name_1.'</a>';
        echo '<a href="'.$file_link_2.'"> <i class="fa fa-file-pdf"></i>'.$file_name_2.'</a>';
        echo '</div>';
        echo $args['after_widget'];
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    function form( $instance ) {
        $title = @ $instance['title'] ?: 'Полезные файлы';
        $file_name_1 = @ $instance['file_name_1'] ?: 'Название файла';
        $file_link_1 = @ $instance['file_link_1'] ?: 'URL файл';
        $file_name_2 = @ $instance['file_name_2'] ?: 'Название файла';
        $file_link_2 = @ $instance['file_link_2'] ?: 'URL файл';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'file_name_1' ); ?>"><?php _e( 'Название файла 1:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'file_name_1' ); ?>" name="<?php echo $this->get_field_name( 'file_name_1' ); ?>" type="text" value="<?php echo esc_attr( $file_name_1 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'file_link_1' ); ?>"><?php _e( 'Ссылка на файл 1:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'file_link_1' ); ?>" name="<?php echo $this->get_field_name( 'file_link_1' ); ?>" type="text" value="<?php echo esc_attr( $file_link_1 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'file_name_2' ); ?>"><?php _e( 'Название файла 2:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'file_name_2' ); ?>" name="<?php echo $this->get_field_name( 'file_name_2' ); ?>" type="text" value="<?php echo esc_attr( $file_name_2 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'file_link_2' ); ?>"><?php _e( 'Ссылка на файл 2:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'file_link_2' ); ?>" name="<?php echo $this->get_field_name( 'file_link_2' ); ?>" type="text" value="<?php echo esc_attr( $file_link_2 ); ?>">
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance новые настройки
     * @param array $old_instance предыдущие настройки
     *
     * @return array данные которые будут сохранены
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['file_name_1'] = ( ! empty( $new_instance['file_name_1'] ) ) ? strip_tags( $new_instance['file_name_1'] ) : '';
        $instance['file_link_1'] = ( ! empty( $new_instance['file_link_1'] ) ) ? strip_tags( $new_instance['file_link_1'] ) : '';
        $instance['file_name_2'] = ( ! empty( $new_instance['file_name_2'] ) ) ? strip_tags( $new_instance['file_name_2'] ) : '';
        $instance['file_link_2'] = ( ! empty( $new_instance['file_link_2'] ) ) ? strip_tags( $new_instance['file_link_2'] ) : '';

        return $instance;
    }

    // скрипт виджета
    function add_my_widget_scripts() {
        // фильтр чтобы можно было отключить скрипты
        if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
            return;

        $theme_url = get_stylesheet_directory_uri();

        wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
    }

    // стили виджета
    function add_my_widget_style() {
        // фильтр чтобы можно было отключить стили
        if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
            return;
        ?>
        <?php
    }

}
// конец класса File_Widget

// регистрация File_Widget в WordPress
function register_file_widget() {
    register_widget( 'File_Widget' );
}
add_action( 'widgets_init', 'register_file_widget' );