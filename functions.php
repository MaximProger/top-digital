<?php

if (!function_exists('top_digital_setup')) {
    function top_digital_setup() {
        // добавляем пользовательский логотип
        add_theme_support('custom-logo', [
            'height'      => 50,
            'width'       => 130,
            'flex-width'  => false,
            'flex-height' => false,
            'header-text' => '',
            'unlink-homepage-logo' => false, // WP 5.5
        ]);
        // подключаем поддержку html5 тегов
        add_theme_support( 'html5', array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'script',
            'style',
        ) );
        // добавляем динамический title
        add_theme_support('title-tag');
        // включаем миниатюры для постов
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

// кастомизируем комментарии
class Bootstrap_Walker_Comment extends Walker {

    /**
     * What the class handles.
     *
     * @since 2.7.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'comment';

    /**
     * Database fields to use.
     *
     * @since 2.7.0
     * @var string[]
     *
     * @see Walker::$db_fields
     * @todo Decouple this
     */
    public $db_fields = array(
        'parent' => 'comment_parent',
        'id'     => 'comment_ID',
    );

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::start_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="children">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="children">' . "\n";
                break;
        }
    }

    /**
     * Ends the list of items after the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::end_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
     *                       Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= "</ol><!-- .children -->\n";
                break;
            case 'ul':
            default:
                $output .= "</ul><!-- .children -->\n";
                break;
        }
    }

    /**
     * Traverses elements to create list from elements.
     *
     * This function is designed to enhance Walker::display_element() to
     * display children of higher nesting levels than selected inline on
     * the highest depth level displayed. This prevents them being orphaned
     * at the end of the comment list.
     *
     * Example: max_depth = 2, with 5 levels of nested content.
     *     1
     *      1.1
     *        1.1.1
     *        1.1.1.1
     *        1.1.1.1.1
     *        1.1.2
     *        1.1.2.1
     *     2
     *      2.2
     *
     * @since 2.7.0
     *
     * @see Walker::display_element()
     * @see wp_list_comments()
     *
     * @param WP_Comment $element           Comment data object.
     * @param array      $children_elements List of elements to continue traversing. Passed by reference.
     * @param int        $max_depth         Max depth to traverse.
     * @param int        $depth             Depth of the current element.
     * @param array      $args              An array of arguments.
     * @param string     $output            Used to append additional content. Passed by reference.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }

        $id_field = $this->db_fields['id'];
        $id       = $element->$id_field;

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        /*
         * If at the max depth, and the current element still has children, loop over those
         * and display them at this level. This is to prevent them being orphaned to the end
         * of the list.
         */
        if ( $max_depth <= $depth + 1 && isset( $children_elements[ $id ] ) ) {
            foreach ( $children_elements[ $id ] as $child ) {
                $this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
            }

            unset( $children_elements[ $id ] );
        }

    }

    /**
     * Starts the element output.
     *
     * @since 2.7.0
     * @since 5.9.0 Renamed `$comment` to `$data_object` and `$id` to `$current_object_id`
     *              to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::start_el()
     * @see wp_list_comments()
     * @global int        $comment_depth
     * @global WP_Comment $comment       Global comment object.
     *
     * @param string     $output            Used to append additional content. Passed by reference.
     * @param WP_Comment $data_object       Comment data object.
     * @param int        $depth             Optional. Depth of the current comment in reference to parents. Default 0.
     * @param array      $args              Optional. An array of arguments. Default empty array.
     * @param int        $current_object_id Optional. ID of the current comment. Default 0.
     */
    public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        // Restores the more descriptive, specific name for use within this method.
        $comment = $data_object;

        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment']       = $comment;

        if ( ! empty( $args['callback'] ) ) {
            ob_start();
            call_user_func( $args['callback'], $comment, $args, $depth );
            $output .= ob_get_clean();
            return;
        }

        if ( 'comment' === $comment->comment_type ) {
            add_filter( 'comment_text', array( $this, 'filter_comment_text' ), 40, 2 );
        }

        if ( ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) && $args['short_ping'] ) {
            ob_start();
            $this->ping( $comment, $depth, $args );
            $output .= ob_get_clean();
        } elseif ( 'html5' === $args['format'] ) {
            ob_start();
            $this->html5_comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        } else {
            ob_start();
            $this->comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        }

        if ( 'comment' === $comment->comment_type ) {
            remove_filter( 'comment_text', array( $this, 'filter_comment_text' ), 40 );
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.7.0
     * @since 5.9.0 Renamed `$comment` to `$data_object` to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::end_el()
     * @see wp_list_comments()
     *
     * @param string     $output      Used to append additional content. Passed by reference.
     * @param WP_Comment $data_object Comment data object.
     * @param int        $depth       Optional. Depth of the current comment. Default 0.
     * @param array      $args        Optional. An array of arguments. Default empty array.
     */
    public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
        if ( ! empty( $args['end-callback'] ) ) {
            ob_start();
            call_user_func(
                $args['end-callback'],
                $data_object, // The current comment object.
                $args,
                $depth
            );
            $output .= ob_get_clean();
            return;
        }
        if ( 'div' === $args['style'] ) {
            $output .= "</div><!-- #comment-## -->\n";
        } else {
            $output .= "</li><!-- #comment-## -->\n";
        }
    }

    /**
     * Outputs a pingback comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment The comment object.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function ping( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
        <div class="comment-body">
            <?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
        <?php
    }

    /**
     * Filters the comment text.
     *
     * Removes links from the pending comment's text if the commenter did not consent
     * to the comment cookies.
     *
     * @since 5.4.2
     *
     * @param string          $comment_text Text of the current comment.
     * @param WP_Comment|null $comment      The comment object. Null if not found.
     * @return string Filtered text of the current comment.
     */
    public function filter_comment_text( $comment_text, $comment ) {
        $commenter          = wp_get_current_commenter();
        $show_pending_links = ! empty( $commenter['comment_author'] );

        if ( $comment && '0' == $comment->comment_approved && ! $show_pending_links ) {
            $comment_text = wp_kses( $comment_text, array() );
        }

        return $comment_text;
    }

    /**
     * Outputs a single comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function comment( $comment, $depth, $args ) {
        if ( 'div' === $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }

        $commenter          = wp_get_current_commenter();
        $show_pending_links = isset( $commenter['comment_author'] ) && $commenter['comment_author'];

        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
        }
        ?>
        <<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ( 'div' !== $args['style'] ) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if ( 0 != $args['avatar_size'] ) {
                echo get_avatar( $comment, $args['avatar_size'] );
            }
            ?>
            <?php
            $comment_author = get_comment_author_link( $comment );

            if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
                $comment_author = get_comment_author( $comment );
            }

            printf(
            /* translators: %s: Comment author link. */
                __( '%s <span class="says">says:</span>' ),
                sprintf( '<cite class="fn">%s</cite>', $comment_author )
            );
            ?>
        </div>
        <?php if ( '0' == $comment->comment_approved ) : ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
            <?php
            printf(
                '<a href="%s">%s</a>',
                esc_url( get_comment_link( $comment, $args ) ),
                sprintf(
                /* translators: 1: Comment date, 2: Comment time. */
                    __( '%1$s at %2$s' ),
                    get_comment_date( '', $comment ),
                    get_comment_time()
                )
            );

            edit_comment_link( __( '(Edit)' ), ' &nbsp;&nbsp;', '' );
            ?>
        </div>

        <?php
        comment_text(
            $comment,
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                )
            )
        );
        ?>

        <?php
        comment_reply_link(
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply">',
                    'after'     => '</div>',
                )
            )
        );
        ?>

        <?php if ( 'div' !== $args['style'] ) : ?>
            </div>
        <?php endif; ?>
        <?php
    }

    /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $commenter          = wp_get_current_commenter();
        $show_pending_links = ! empty( $commenter['comment_author'] );

        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
        }
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
        <div class="media mb-4">
                    <?php
                    $comment_author_name = get_comment_author( $comment );

                    if ( 0 != $args['avatar_size'] ) {
                        echo get_avatar( $comment, $args['avatar_size'], 'mystery', $comment_author_name, ['class' => 'img-fluid d-flex mr-4 rounded'] );
                    }
                    ?>
                <div class="media-body">
                    <h5><?=$comment_author_name;?></h5>
                    <span class="text-muted"><?=get_comment_date( 'j F Y', $comment );?></span>
                    <p class="mt-2"><?php echo get_comment_text(); ?><p>

                    <?php
                    if ( '1' == $comment->comment_approved || $show_pending_links ) {
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    }
                    ?>
                </div>
        </div>
        <?php
    }
}

add_action('init', 'post__types_init');
function post__types_init(){
    // Добавление типа записей "услуги"
    register_post_type('service', array(
        'labels'             => array(
            'name'               => __('Услуги'), // основное название для типа записи
            'singular_name'      => __('Услуга'), // название для одной записи этого типа
            'add_new'            => __('Добавить услугу'), // для добавления новой записи
            'add_new_item'       => __('Добавление услуги'), // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => __('Редактирование услуги'), // для редактирования типа записи
            'new_item'           => __('Новая услуга'), // текст новой записи
            'view_item'          => __('Смотреть услугу'), // для просмотра записи этого типа.
            'search_items'       => __('Искать услугу'), // для поиска по этим типам записи
            'not_found'          => __('Не найдено'), // если в результате поиска ничего не было найдено
            'not_found_in_trash' => __('Не найдено в корзине'), // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => __('Услуги'), // название меню

        ),
        'menu_position'       => 4,
        'menu_icon' => 'dashicons-universal-access-alt',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
    ) );

    // Добавление типа записей "тарифы"
    register_post_type('tarif', array(
        'labels'             => array(
            'name'               => __('Тарифы'), // основное название для типа записи
            'singular_name'      => __('Тариф'), // название для одной записи этого типа
            'add_new'            => __('Добавить тариф'), // для добавления новой записи
            'add_new_item'       => __('Добавление тарифа'), // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => __('Редактирование тарифа'), // для редактирования типа записи
            'new_item'           => __('Новый тариф'), // текст новой записи
            'view_item'          => __('Смотреть тариф'), // для просмотра записи этого типа.
            'search_items'       => __('Искать тариф'), // для поиска по этим типам записи
            'not_found'          => __('Не найдено'), // если в результате поиска ничего не было найдено
            'not_found_in_trash' => __('Не найдено в корзине'), // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => __('Тарифы'), // название меню

        ),
        'menu_position'       => 5,
        'menu_icon' => 'dashicons-money-alt',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array('title','editor','author','thumbnail','excerpt','comments','custom-fields')
    ) );

    // Добавление типа записей "отзывы"
    register_post_type('reviews', array(
        'labels'             => array(
            'name'               => __('Отзывы'), // основное название для типа записи
            'singular_name'      => __('Отзыв'), // название для одной записи этого типа
            'add_new'            => __('Добавить отзыв'), // для добавления новой записи
            'add_new_item'       => __('Добавление отзыва'), // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => __('Редактирование отзыва'), // для редактирования типа записи
            'new_item'           => __('Новый отзыв'), // текст новой записи
            'view_item'          => __('Смотреть отзыв'), // для просмотра записи этого типа.
            'search_items'       => __('Искать отзыв'), // для поиска по этим типам записи
            'not_found'          => __('Не найдено'), // если в результате поиска ничего не было найдено
            'not_found_in_trash' => __('Не найдено в корзине'), // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => __('Отзывы'), // название меню

        ),
        'menu_position'       => 6,
        'menu_icon' => 'dashicons-format-status',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array('title','editor','author','thumbnail','excerpt','comments','custom-fields')
    ) );
}