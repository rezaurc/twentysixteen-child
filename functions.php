<?php
/**
 * Twenty Sixteen Child Theme function file
 * 
 * @package twentysixteen
 * @subpackage twentysixteen-child
 * @since Twenty Sixteen Child 1.0.1
 */
/**
 * @since Twenty Sixteen Child 1.0.1
 * all functions in this can be changed/remove based on requirements
 * 
 */
/* Base functions for child change as you need */

add_action('after_setup_theme', 'AfterSetupTheme');
add_action('wp_enqueue_scripts', 'TwentySixteenChildScripts');
add_action('twentysixteen_credits', 'TwentySixteenChildBackToTop');

add_filter('infinite_scroll_settings', 'twentysixteen_child_infinite_scroll_settings');
add_filter( 'user_contactmethods', 'yoast_add_google_profile', 10, 1);
add_filter( 'author_link', 'yoast_change_author_link', 10, 3 );
add_filter('the_content', 'twentysixteen_child_archive_content_filter', 99);

function twentysixteen_child_infinite_scroll_settings( $args ) {
    if(is_array($args))
        $args['footer_callback'] = 'twentysixteen_child_infinity_footer';
    return $args;
}
function twentysixteen_child_archive_content_filter($content){
    $length = 69;
    if(false !== strpos( $content, 'more-link' )) //<!--more--> tag available, so return as is
        return $content;
    if( is_home() ||  is_archive() || is_search()){
        $allowed_tags = '<a>,<b>,<strong>,<ul>,<li>,<i>,<h4>,<h5>,<h6>,<pre>,<code>,<em>,<u>,<br>,<p>';
        $text = strip_tags($content, $allowed_tags);
        $words = preg_split("/[\n\r\t ]+/", $text, $length + 1, PREG_SPLIT_NO_EMPTY);
  	if ( count($words) > $length ) {
		array_pop($words);
		$text = implode(' ', $words);
         } else {
		$text = implode(' ', $words);
		}
		
	return $text . " <a href='".get_permalink()."'>".  __('Continue reading', 'twentysixteenchild')." </a>";;      
    }else{
        return $content;
    }
}

function yoast_add_google_profile( $contactmethods ) {
	// Add Google Profiles
	$contactmethods['google_profile'] = 'http://google.com/+rezaurchowdhury';
	return $contactmethods;
}

function yoast_change_author_link( $link, $author_id, $author ) {
  if ( 'auth_usr' == $author )
    return 'http://google.com/+rezaurchowdhury';
  return $link;
}

function twentysixteen_child_infinity_footer(){
?>
<div id="infinite-footer">
    <div class="container">
        <div class="blog-info">
            <a href="/copyright/">&copy; <?php bloginfo('name'); ?></a>
        </div>
        <div class="blog-credits">
            <a href="/privacy-policy/">Privacy policy</a>
	    <a style="margin-left:10px;" href="/terms-use/">Terms of use</a>
	    <a style="margin-left:25px;" href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a>
	    <span style="margin-left:10px;"> Theme: TwentySixteen Child</span> 
	    <a style="margin-bottom:11px;" href="#" class="back-to-top"><span class="genericon genericon-collapse"></span><?php _e (' Back to Top','twentysixteenchild');?></a>
        </div>
    </div>
</div>
<?php
}

function AfterSetupTheme() {
    load_theme_textdomain('twentysixteenchild', get_stylesheet_uri() . '/languages');

    $color_scheme = twentysixteen_get_color_scheme(); // can be override by calling new function
    $default_background_color = trim($color_scheme[0], '#');
    $default_text_color = trim($color_scheme[3], '#');


    add_theme_support('custom-background', apply_filters('twentysixteen_custom_background_args', array(
        'default-color' => $default_background_color,
    )));
    $GLOBALS['content_width'] = 840; //change to override parent value
    add_theme_support('custom-header', apply_filters('twentysixteen_custom_header_args', array(
        'default-text-color' => $default_text_color,
        'width' => 1326,
        'height' => 280,
        'flex-height' => true,
        'wp-head-callback' => 'twentysixteen_header_style',
    )));
}

function TwentySixteenChildScripts() {
    wp_enqueue_style('twentysixteen-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('twentysixteen-child-style', get_stylesheet_uri());

    wp_enqueue_script('twentysixteen_child_script', get_stylesheet_directory_uri() . '/scripts/child-script.js', null, '1.0.1', true);
}

/**
 * back to top link at footer
 */
function TwentySixteenChildBackToTop() {
    echo "<a href='#' class='back-to-top'><span class='genericon genericon-collapse'></span><?php _e (' Back to Top','twentysixteenchild');?></a>";
}

require get_stylesheet_directory() . '/inc/customizer.php';
/* comment out if don't want */
add_filter('excerpt_more', 'twentysixteen_excerpt_more');
add_action('widgets_init', 'twentysixteen_child_widgets_init');
add_filter('body_class', 'twentysixteen_child_body_classes');
add_filter('twentysixteen_color_schemes', 'twentysixteen_child_color_schemes');

/**
 * 
 * @param type $colors
 * @return type
 * add new color schema
 */
function twentysixteen_child_color_schemes() {

    $colorschema = array(
        'blue' => array(
            'label' => __('Blue', 'twentysixteenchild'),
            'colors' => array(
                '#b7cdf4',
                '#fefefe',
                '#3372df',
                '#404040',
                '#3367d6',
                '#3372df', //added newly for title color
            ),
        ),
        'default' => array(
            'label' => __('Default', 'twentysixteen'),
            'colors' => array(
                '#1a1a1a',
                '#ffffff',
                '#007acc',
                '#1a1a1a',
                '#686868',
                '#1a1a1a', //added newly for title color
            ),
        ),
        'dark' => array(
            'label' => __('Dark', 'twentysixteen'),
            'colors' => array(
                '#262626',
                '#1a1a1a',
                '#9adffd',
                '#e5e5e5',
                '#c1c1c1',
                '#e5e5e5', //added newly for title color
            ),
        ),
        'gray' => array(
            'label' => __('Gray', 'twentysixteen'),
            'colors' => array(
                '#616a73',
                '#4d545c',
                '#c7c7c7',
                '#f2f2f2',
                '#f2f2f2',
                '#f2f2f2', //added newly for title color
            ),
        ),
        'red' => array(
            'label' => __('Red', 'twentysixteen'),
            'colors' => array(
                '#ffffff',
                '#ff675f',
                '#640c1f',
                '#402b30',
                '#402b30',
                '#402b30', //added newly for title color
            ),
        ),
        'yellow' => array(
            'label' => __('Yellow', 'twentysixteen'),
            'colors' => array(
                '#3b3721',
                '#ffef8e',
                '#774e24',
                '#3b3721',
                '#5b4d3e',
                '#3b3721', //added newly for title color
            ),
        ),
    );
    return $colorschema;
}

function twentysixteen_child_body_classes($classes) {
    //set new condition add pass the body call as you need
    $classes[] = 'twentysixteenchild';
    return $classes;
}

function twentysixteen_child_widgets_init() {
    register_sidebar(array(
        'name' => __('Child Theme Widget', 'twentysixteenchild'),
        'id' => 'child-sidebar',
        'description' => __('Child sidebar', 'twentysixteenchild'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

/**
 * all override able functions
 * chage as per your requirements
 */
function twentysixteen_fonts_url() {
    $fonts_url = '';
    $fonts = array();
    $subsets = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Merriweather font: on or off', 'twentysixteenchild')) {
        $fonts[] = 'Roboto+Condensed:400,700,900,400italic,700italic,900italic';
    }

    /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Montserrat font: on or off', 'twentysixteenchild')) {
        $fonts[] = 'Roboto+Condensed:400,700';
    }

    /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentysixteenchild')) {
        $fonts[] = 'Inconsolata:400';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
                ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

function twentysixteen_header_style() {
    if (display_header_text()) {
        return;
    }

    // If the header text has been hidden.
    ?>
    <style type="text/css" id="twentysixteen-header-css">
        .site-branding {
            margin: 0 auto 0 0;
        }

        .site-branding .site-title,
        .site-description {
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute;
        }
    </style>
    <?php
}

function twentysixteen_entry_meta() {
    if ('post' === get_post_type()) {
        $author_avatar_size = apply_filters('twentysixteen_author_avatar_size', 64);
        printf('<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', get_avatar(get_the_author_meta('user_email'), $author_avatar_size), _x('Author', 'Used before post author name.', 'twentysixteenchild'), esc_url(get_author_posts_url(get_the_author_meta('ID'))), get_the_author()
        );
    }

    if (in_array(get_post_type(), array('post', 'attachment'))) {
        twentysixteen_entry_date();
    }

    $format = get_post_format();
    if (current_theme_supports('post-formats', $format)) {
        printf('<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>', sprintf('<span class="screen-reader-text">%s </span>', _x('Format', 'Used before post format.', 'twentysixteenchild')), esc_url(get_post_format_link($format)), get_post_format_string($format)
        );
    }

    if ('post' === get_post_type()) {
        twentysixteen_entry_taxonomies();
    }

    if (!is_singular() && !post_password_required() && ( comments_open() || get_comments_number() )) {
        echo '<span class="comments-link">';
        comments_popup_link(sprintf(__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentysixteenchild'), get_the_title()));
        echo '</span>';
    }
}

function twentysixteen_entry_date() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string, esc_attr(get_the_date('c')), get_the_date(), esc_attr(get_the_modified_date('c')), get_the_modified_date()
    );

    printf('<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>', _x('Posted on', 'Used before publish date.', 'twentysixteenchild'), esc_url(get_permalink()), $time_string
    );
}

function twentysixteen_entry_taxonomies() {
    $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'twentysixteenchild'));
    if ($categories_list && twentysixteen_categorized_blog()) {
        printf('<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Categories', 'Used before category names.', 'twentysixteenchild'), $categories_list
        );
    }

    $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'twentysixteenchild'));
    if ($tags_list) {
        printf('<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Tags', 'Used before tag names.', 'twentysixteenchild'), $tags_list
        );
    }
}

function twentysixteen_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail() || is_home()) {
        return;
    }

    if (is_singular()) :
        ?>

        <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
        </div><!-- .post-thumbnail -->

    <?php else : ?>

        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
        <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
        </a>

    <?php
    endif; // End is_singular()    
}

function twentysixteen_excerpt($class = 'entry-summary') {
    /* Create your own twentysixteen_excerpt() */
    $class = esc_attr($class);

    if ((has_excerpt() || is_search()) && !is_home()) :
        ?>
        <div class="<?php echo $class; ?>">
        <?php the_excerpt(); ?>
        </div><!-- .<?php echo $class; ?> -->
            <?php
        endif;
    }

    function twentysixteen_excerpt_more() {

        $link = sprintf('<a href="%1$s" class="more-link">%2$s</a>', esc_url(get_permalink(get_the_ID())),
                /* translators: %s: Name of current post */ sprintf(__('Continue<span class="screen-reader-text"> "%s"</span>', 'twentysixteenchild'), get_the_title(get_the_ID()))
        );
        return ' &hellip; ' . $link;
    }

    function twentysixteen_setup() {
        /**
         * already overrided in child 
         * load_theme_textdomain( 'twentysixteenchild', get_template_directory() . '/languages' );
         */
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 0, true); //set the size as u like
        // This theme uses wp_nav_menu() in two locations, plus
        //added new menu position in child
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'twentysixteenchild'),
            'social' => __('Social Links Menu', 'twentysixteenxhild'),
            'footer' => __('Footer Menu', 'twentysixteenxhild'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * add remove as needed
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         * add remove as u needed
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));
        /*
         * you can override new for url by adding new function in child
         */
        add_editor_style(array('css/editor-style.css', twentysixteen_fonts_url()));
    }
    