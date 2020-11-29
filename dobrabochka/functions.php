<?php    
    add_shortcode( 'teleform', 'teleform_func' );
    function teleform_func() {
        $name = __('First name.', 'woocommerce');
        $html = '
        <div class="contact-form">
        <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
        <form class="teleform" method="POST" action="https://dobrabochka.herokuapp.com/api/message" target="hiddenFrame">
            <div class="success-form">'. __("Question has been sent", "parent-theme-slug") .'</div>
            <div class="error-form required">'. __("Please complete requied fields", "parent-theme-slug") .'</div>
            <div class="error-form">'. __("Something went wrong", "parent-theme-slug") .'</div>
            <div class="input-wrap">
                <input name="name" type="text" placeholder="'.$name.'">
            </div>
            <div class="input-wrap">
                <input required name="phone" type="text" placeholder="'. __('Phone', 'woocommerce') .'">
            </div>
            <div class="input-wrap">
                <textarea name="question" placeholder="'. __('Message', 'woocommerce') .'"></textarea>
            </div>
            <div class="input-wrap textarea-wrap">
                <button type="submit" class="action-button">
                '. __('Submit', 'woocommerce') .'
                </button>
            </div>
        </form>
        </div>
        ';
        return $html;
    }

    function child_theme_slug_setup() {
        load_child_theme_textdomain( 'parent-theme-slug', get_stylesheet_directory() . '/languages' );
    }
    add_action( 'after_setup_theme', 'child_theme_slug_setup' );

    add_action( 'init', 'remove_my_action');
    function remove_my_action() {
        remove_action( 'storefront_header', 'storefront_header_container', 0 );
        remove_action( 'storefront_header', 'storefront_header_container_close', 41 );

        remove_action( 'storefront_header', 'storefront_site_branding', 20 );
        remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
        remove_action( 'storefront_header', 'storefront_skip_links', 5 );
        remove_action( 'storefront_header', 'storefront_product_search', 40 );     
        remove_action( 'storefront_header', 'storefront_header_cart', 60 );

        remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );

        remove_action( 'storefront_page', 'storefront_page_header', 10 );
        remove_action( 'storefront_loop_post', 'storefront_post_content', 30 );
    }

    add_action('wp_enqueue_scripts', 'my_theme_styles' );
    function my_theme_styles() {
        wp_enqueue_style('parent-theme-css', get_template_directory_uri() .'/style.css' );
        // wp_enqueue_script('fontawesome',  get_stylesheet_directory_uri() . '/assets/js/solid.js');
        // wp_enqueue_script('fontawesome-brands',  get_stylesheet_directory_uri() . '/assets/js/brands.js');
        wp_enqueue_script('custom',  get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0', true);
    }
    // add_action( 'storefront_before_site', 'add_callback', 1);
    if ( ! function_exists( 'add_callback' ) ) {
        function add_callback() {
            ?>
<div id="vdz_cb_widget">
<a class="vdz_cb_widget vdz_cb_widget_btn" href="#vdz_cb" title="">
<span class="vdz_cb_widget_icon" aria-hidden="true">
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
<path d="M352 320c-32 32-32 64-64 64s-64-32-96-64-64-64-64-96 32-32 64-64-64-128-96-128-96 96-96 96c0 64 65.75 193.75 128 256s192 128 256 128c0 0 96-64 96-96s-96-128-128-96z"></path>
</svg>
</span>
</a></div>
            <?php 
        }
    }
    add_action( 'storefront_before_header', 'add_pre_header', 10 );
    add_action( 'storefront_before_header', 'storefront_secondary_navigation', 20 );
    if ( ! function_exists( 'storefront_secondary_navigation' ) ) {       
        function storefront_secondary_navigation() {
            if ( has_nav_menu( 'secondary' ) ) {
                ?>
                <nav class="pre-header-secondary-navigation" role="navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'storefront' ); ?>">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'secondary',
                                'fallback_cb'    => '',
                                'container' => '',
                                'menu_id' => 'pre-header-secondary-menu'
                            )
                        );
                    ?>
                </nav><!-- #site-navigation -->
                <?php
            }
        }
    }
    add_action( 'storefront_before_header', 'storefront_product_search', 25 );
    if ( ! function_exists( 'storefront_product_search' ) ) {        
        function storefront_product_search() {
            if ( storefront_is_woocommerce_activated() ) {
                ?>
                <div class="site-search">
                    <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
                </div>
                <?php
            }
        }
    }
    add_action( 'storefront_before_header', 'add_pre_header_close', 30 );
    if ( ! function_exists( 'add_pre_header' ) ) {
        function add_pre_header() {          
             ?> <div class="pre-header">
                <div class="data">
                    <div class="pre-header-content-block">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+380684134135032">+38 (068) 413 50 32</a>&nbsp;
                        <i class="fas fa-phone-alt"></i>                            
                        <a href="tel:+380996476706">+38 (099) 647 67 06</a>                    
                        <a class="fab fa-instagram" href="https://www.instagram.com/dobra.bochka/"></a>
                    </div>
                    <div class="pre-header-content-block">                    
            <?php
        }
    }
    if ( ! function_exists( 'add_pre_header_close' ) ) {
        function add_pre_header_close() {          
             ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }       
    add_action( 'storefront_header', 'storefront_site_branding', 43 );
    add_action( 'storefront_header', 'storefront_header_cart', 61 );    
    
    add_action( 'storefront_before_content', 'storefront_header_space', 2 );
    if ( ! function_exists( 'storefront_header_space' ) ) {
        function storefront_header_space() {           
            ?>
                <div class="header-space sticky-space-off"></div>
            <?php            
        }
    }
    if ( ! function_exists( 'storefront_header_cart' ) ) {
        function storefront_header_cart() {
            if ( storefront_is_woocommerce_activated() ) {
                if ( is_cart() ) {
                    $class = 'current-menu-item';
                } else {
                    $class = '';
                }
                ?>
            <ul id="site-header-cart-main" class="site-header-cart menu">
                <li class="<?php echo esc_attr( $class ); ?>">
                    <?php storefront_cart_link(); ?>
                </li>
                <li>
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </li>
            </ul>
                <?php
            }
        }
    }    
    if ( ! function_exists( 'storefront_cart_link' ) ) {
        /*cart*/     
        function storefront_cart_link() {
          
            ?>                
                <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
                    <i class="fas fa-shopping-cart"></i>
                    <?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?> 
                    <span class="count"><?php echo wp_kses_post( WC()->cart->get_cart_contents_count() ); ?></span>
                </a>
            <?php
        }
    }

    if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
        /**
         * Cart Fragments
         * Ensure cart contents update when products are added to the cart via AJAX
         *
         * @param  array $fragments Fragments to refresh via AJAX.
         * @return array            Fragments to refresh via AJAX
         */
        function storefront_cart_link_fragment( $fragments ) {
            global $woocommerce;
    
            ob_start();
            storefront_cart_link();
            $fragments['a.cart-contents'] = ob_get_clean();
    
            ob_start();
            storefront_handheld_footer_bar_cart_link();
            $fragments['a.footer-cart-contents'] = ob_get_clean();
    
            return $fragments;
        }
    }

    add_action( 'storefront_before_content', 'storefront_page_header_open', 3 );
    add_action( 'storefront_before_content', 'woocommerce_breadcrumb', 4 );
    add_action( 'storefront_before_content', 'storefront_page_header_close', 5 );

    add_action( 'storefront_before_content', 'storefront_page_header_cart', 6 );
    add_action( 'storefront_before_content', 'storefront_page_header_checkout', 7 );
    add_action( 'storefront_before_content', 'storefront_page_header_checkout_order_received', 8 );
    if ( ! function_exists( 'storefront_page_header_checkout_order_received' ) ) {
        function storefront_page_header_checkout_order_received() {
            if(is_order_received_page()) {
            ?>            
                <div class="checkout-page-title"><nav class="checkout-breadcrumbs">
                    <a href="<?php echo get_site_url(null, 'cart'); ?>" class="current step-cart current">
                    <span class="checkout-name"><?php echo _e( 'My cart', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">1</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="<?php echo get_site_url(null, 'checkout'); ?>" class="current step-checkout hide-for-small">
                    <span class="checkout-name"><?php echo _e( 'Order details', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">2</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="#" class="current no-click step-complete hide-for-small current">
                    <span class="checkout-name"><?php echo _e( 'Order received', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">3</span><span class="checkout-line"></span></span>
                    </a></nav>
                </div>
            <?php
            }
        }
    }
    if ( ! function_exists( 'storefront_page_header_checkout' ) ) {
        function storefront_page_header_checkout() {
            if(is_checkout() && !is_order_received_page()) {
            ?>            
                <div class="checkout-page-title"><nav class="checkout-breadcrumbs">
                    <a href="<?php echo get_site_url(null, 'cart'); ?>" class="current step-cart current">
                    <span class="checkout-name"><?php echo _e( 'My cart', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">1</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="<?php echo get_site_url(null, 'checkout'); ?>" class="current step-checkout hide-for-small">
                    <span class="checkout-name"><?php echo _e( 'Order details', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">2</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="#" class="no-click step-complete hide-for-small">
                    <span class="checkout-name"><?php echo _e( 'Order received', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">3</span><span class="checkout-line"></span></span>
                    </a></nav>
                </div>
            <?php
            }
        }
    }
    if ( ! function_exists( 'storefront_page_header_cart' ) ) {
        function storefront_page_header_cart() {
            if(is_cart()) {            
            ?>            
                <div class="checkout-page-title"><nav class="checkout-breadcrumbs">
                    <a href="<?php echo get_site_url(null, 'cart'); ?>" class="current step-cart current">
                    <span class="checkout-name"><?php echo _e( 'My cart', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">1</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="<?php echo get_site_url(null, 'checkout'); ?>" class="step-checkout hide-for-small">
                    <span class="checkout-name"><?php echo _e( 'Order details', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">2</span><span class="checkout-line"></span></span>
                    </a>
                    <a href="#" class="no-click step-complete hide-for-small">
                    <span class="checkout-name"><?php echo _e( 'Order received', 'storefront' ); ?></span>
                    <span class="checkout-step"><span class="checkout-counter">3</span><span class="checkout-line"></span></span>
                    </a></nav>
                </div>
            <?php
            }
        }
    }

    function is_blog () {
        return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
    }

    if ( ! function_exists( 'storefront_page_header_open' ) ) {      
        function storefront_page_header_open() {
            if ( is_front_page() && is_page_template( 'template-fullwidth.php' ) ) {
                return;
            }

            if(is_blog() && !is_single()) {
                    ?>
                <div class="entry-header blog">
                <h1 class="entry-title"><?php echo _e( 'Blog', 'parent-theme-slug' ); ?></h1>
                <?php
                return;
            }
    
            ?>
            <div class="entry-header <?php if( is_single () ) { echo 'blog'; } if(is_checkout()) { echo 'checkout'; } ?>">
                <?php                
                the_title( '<h1 class="entry-title">', '</h1>' );                
                ?>
            <?php
        }
    }

    if ( ! function_exists( 'storefront_page_header_close' ) ) {      
        function storefront_page_header_close() {
            if ( is_front_page() && is_page_template( 'template-fullwidth.php' ) ) {
                return;
            }
    
            ?>          
            </div><!-- .entry-header -->
            <?php
        }
    }

    if ( ! function_exists( 'storefront_post_meta' ) ) {      
        function storefront_post_meta() {
            if ( 'post' !== get_post_type() || !has_post_thumbnail(get_the_ID()) || is_category()) {
                return;
            }       
            echo esc_html(the_category(', '));
            ?>
            <div class="fancy-date">
                <a title="12:43" href="<?php echo get_site_url() ?>" rel="nofollow">
                    <span class="entry-month"><?php echo esc_html(get_the_date('M')); ?></span>
                    <span class="entry-date updated"> <?php echo esc_html(get_the_date('d')); ?></span>
                    <span class="entry-year"><?php echo esc_html(get_the_date('Y')); ?></span>
                </a>
            </div>
            <?php                  
        }
    }

    if ( ! function_exists( 'storefront_post_header' ) ) {        
        function storefront_post_header() {
            ?>
            <div class="entry-header-blog">
            <?php
    
    
            if ( !is_single() ) {	
                the_title( sprintf( '<h3 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
            } else {
                do_action( 'storefront_post_header_before' );
                storefront_post_thumbnail( 'full' );
                do_action( 'storefront_post_header_after' );
            }
                           
            ?>
            </div><!-- .entry-header -->
            <?php
        }
    }

    if ( ! function_exists( 'storefront_post_content' ) ) {      
        function storefront_post_content() {
            ?>
            <div class="entry-content">
            <?php
    
            /**
             * Functions hooked in to storefront_post_content_before action.
             *
             * @hooked storefront_post_thumbnail - 10
             */
            // do_action( 'storefront_post_content_before' );
    
            the_content(
                sprintf(
                    /* translators: %s: post title */
                    __( 'Continue reading %s', 'storefront' ),
                    '<span class="screen-reader-text">' . get_the_title() . '</span>'
                )
            );
    
            do_action( 'storefront_post_content_after' );
    
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
                    'after'  => '</div>',
                )
            );
            ?>
            </div><!-- .entry-content -->
            <?php
        }
    }

    if ( ! function_exists( 'storefront_credit' ) ) {       
        function storefront_credit() {           
            ?>
            <div class="site-info">
                <?php echo _e( 'Copyrights', 'storefront' ); ?>
            </div>
            <div class="bottom-menu">
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'secondary',
                            'fallback_cb'    => '',
                        )
                    );
                ?>
            </div>
            <?php
        }
    }

    /* CONTENT */
    add_action( 'storefront_loop_post', 'storefront_post_content_loop', 30 );
    if ( ! function_exists( 'storefront_post_content_loop' ) ) {       
        function storefront_post_content_loop() {
            ?>
            <div class="entry-content loop">
            <?php          
            // do_action( 'storefront_post_content_before' );
    
            the_content(
                sprintf(
                    /* translators: %s: post title */
                    __( 'Continue reading %s', 'storefront' ),
                    '<span class="screen-reader-text">' . get_the_title() . '</span>'
                ),
                true
            );
    
            do_action( 'storefront_post_content_after' );
    
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
                    'after'  => '</div>',
                )
            );
            ?>
            </div><!-- .entry-content -->
            <?php
        }
    }


    if ( ! function_exists( 'storefront_page_content' ) ) {

        function storefront_page_content() {
            ?>
            <div class="entry-content">
                <?php the_content(); ?>
                <?php
                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
                            'after'  => '</div>',
                        )
                    );
                ?>
            </div><!-- .entry-content -->
            <?php
        }
    }    