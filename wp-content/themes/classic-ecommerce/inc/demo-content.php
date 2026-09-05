<div class="theme-offer">
   <?php
        // Check if the demo import has been completed
        $classic_ecommerce_demo_import_completed = get_option('classic_ecommerce_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($classic_ecommerce_demo_import_completed) {
            echo '<br>';
            echo '<div class="success">Demo Import Successful</div>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
            echo '<span>' . esc_html__( 'You can now visit your site or customize it further.', 'classic-ecommerce' ) . '</span>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<div class="view-site-btn">';
            echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
            echo '<a href="' . esc_url( admin_url('customize.php') ) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">Customize Demo Content</a>';
            echo '</div>';
        }
     // POST and update the customizer and other related data of Classic Ecommerce
    if ( isset( $_POST['submit'] ) ) {

        // WooCommerce installation and activation
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            $classic_ecommerce_plugin_slug = 'woocommerce';
            $classic_ecommerce_plugin_file = 'woocommerce/woocommerce.php';
            $classic_ecommerce_installed_plugins = get_plugins();
            if (!isset($classic_ecommerce_installed_plugins[$classic_ecommerce_plugin_file])) {
                include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                include_once(ABSPATH . 'wp-admin/includes/file.php');
                include_once(ABSPATH . 'wp-admin/includes/misc.php');
                include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
                $classic_ecommerce_upgrader = new Plugin_Upgrader();
                $classic_ecommerce_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
            }
            activate_plugin($classic_ecommerce_plugin_file);
        }   
        
        // Check if Classic Blog Grid plugin is installed
        if (!is_plugin_active('classic-blog-grid/classic-blog-grid.php')) {
            // Plugin slug and file path for Classic Blog Grid
            $classic_ecommerce_plugin_slug = 'classic-blog-grid';
            $classic_ecommerce_plugin_file = 'classic-blog-grid/classic-blog-grid.php';
        
            // Check if Classic Blog Grid is installed and activated
            if ( ! is_plugin_active( $classic_ecommerce_plugin_file ) ) {
        
                // Check if Classic Blog Grid is installed
                $classic_ecommerce_installed_plugins = get_plugins();
                if ( ! isset( $classic_ecommerce_installed_plugins[ $classic_ecommerce_plugin_file ] ) ) {
        
                    // Include necessary files to install plugins
                    include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
                    include_once( ABSPATH . 'wp-admin/includes/file.php' );
                    include_once( ABSPATH . 'wp-admin/includes/misc.php' );
                    include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        
                    // Download and install Classic Blog Grid
                    $classic_ecommerce_upgrader = new Plugin_Upgrader();
                    $classic_ecommerce_upgrader->install( 'https://downloads.wordpress.org/plugin/classic-blog-grid.latest-stable.zip' );
                }
        
                // Activate the Classic Blog Grid plugin after installation (if needed)
                activate_plugin( $classic_ecommerce_plugin_file );
            }
        }

        // ------- Create Main Menu --------
        $classic_ecommerce_menuname = 'Primary Menu';
        $classic_ecommerce_bpmenulocation = 'primary';
        $classic_ecommerce_menu_exists = wp_get_nav_menu_object($classic_ecommerce_menuname);

        if (!$classic_ecommerce_menu_exists) {
            // Create a new menu
            $classic_ecommerce_menu_id = wp_create_nav_menu($classic_ecommerce_menuname);

            // Create Home Page
            $classic_ecommerce_home_title = 'Home';
            $classic_ecommerce_home = array(
                'post_type'    => 'page',
                'post_title'   => $classic_ecommerce_home_title,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_name'    => 'home'
            );
            $classic_ecommerce_home_id = wp_insert_post($classic_ecommerce_home);

            // Assign Home Page Template
            add_post_meta($classic_ecommerce_home_id, '_wp_page_template', 'template-home-page.php');

            // Add WooCommerce Shortcodes to Home Page Content
            $classic_ecommerce_featured_products = '[products limit="4" columns="4"]'; // Fixed shortcode

            // Update Home Page Content with WooCommerce shortcodes
            wp_update_post(array(
                'ID'           => $classic_ecommerce_home_id,
                'post_content' => $classic_ecommerce_featured_products // Direct shortcode
            ));

            // Update options to set Home Page as the front page
            update_option('page_on_front', $classic_ecommerce_home_id);
            update_option('show_on_front', 'page');

            // Add Home Page to Menu
            wp_update_nav_menu_item($classic_ecommerce_menu_id, 0, array(
                'menu-item-title'   => __('Home', 'classic-ecommerce'),
                'menu-item-classes' => 'home',
                'menu-item-url'     => home_url('/'),
                'menu-item-status'  => 'publish',
                'menu-item-object-id' => $classic_ecommerce_home_id,
                'menu-item-object'  => 'page',
                'menu-item-type'    => 'post_type'
            ));

            // Create a new Pages Page
            $classic_ecommerce_pages_title = 'Pages';
            $classic_ecommerce_pages_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $classic_ecommerce_pages = array(
                'post_type'    => 'page',
                'post_title'   => $classic_ecommerce_pages_title,
                'post_content' => $classic_ecommerce_pages_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_name'    => 'pages'
            );
            $classic_ecommerce_pages_id = wp_insert_post($classic_ecommerce_pages);

            // Add Pages Page to Menu
            wp_update_nav_menu_item($classic_ecommerce_menu_id, 0, array(
                'menu-item-title'   => __('Pages', 'classic-ecommerce'),
                'menu-item-classes' => 'pages',
                'menu-item-url'     => home_url('/pages/'),
                'menu-item-status'  => 'publish',
                'menu-item-object-id' => $classic_ecommerce_pages_id,
                'menu-item-object'  => 'page',
                'menu-item-type'    => 'post_type'
            ));

            // Create About Us Page with Dummy Content
            $classic_ecommerce_about_title = 'About Us';
            $classic_ecommerce_about_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'; // Dummy content shortened for brevity
            $classic_ecommerce_about = array(
                'post_type'    => 'page',
                'post_title'   => $classic_ecommerce_about_title,
                'post_content' => $classic_ecommerce_about_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_name'    => 'about-us'
            );
            $classic_ecommerce_about_id = wp_insert_post($classic_ecommerce_about);

            // Add About Us Page to Menu
            wp_update_nav_menu_item($classic_ecommerce_menu_id, 0, array(
                'menu-item-title'   => __('About Us', 'classic-ecommerce'),
                'menu-item-classes' => 'about-us',
                'menu-item-url'     => home_url('/about-us/'),
                'menu-item-status'  => 'publish',
                'menu-item-object-id' => $classic_ecommerce_about_id,
                'menu-item-object'  => 'page',
                'menu-item-type'    => 'post_type'
            ));

            // Assign the menu to the primary location if not already set
            if (!has_nav_menu($classic_ecommerce_bpmenulocation)) {
                $classic_ecommerce_locations = get_theme_mod('nav_menu_locations');
                if (empty($classic_ecommerce_locations)) {
                    $classic_ecommerce_locations = array();
                }
                $classic_ecommerce_locations[$classic_ecommerce_bpmenulocation] = $classic_ecommerce_menu_id;
                set_theme_mod('nav_menu_locations', $classic_ecommerce_locations);
            }
        }

        // Header Section
        set_theme_mod('classic_ecommerce_offer_text', 'Lorem ipsum is a dummy text industry 20% off' );
        
       // Social Media Section
       set_theme_mod( 'classic_ecommerce_fb_link', '#' );
       set_theme_mod( 'classic_ecommerce_twitt_link', '#' );
       set_theme_mod( 'classic_ecommerce_linked_link', '#' );
       set_theme_mod( 'classic_ecommerce_insta_link', '#' );
       set_theme_mod( 'classic_ecommerce_youtube_link', '#' );
       set_theme_mod( 'classic_ecommerce_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

       // Slider Section
       set_theme_mod( 'classic_ecommerce_button_text', 'SHOP NOW' );
       set_theme_mod( 'classic_ecommerce_button_link_slider', '#' );
       
        // Create the 'Ecommerce' category and retrieve its ID
        $classic_ecommerce_slider_category_id = wp_create_category('Ecommerce');

        // Set the slider category in theme mods
        set_theme_mod('classic_ecommerce_slidersection', 'Ecommerce');

        $classic_ecommerce_titles = array(
            'VESTIBULUM TORTOR ERAT, NEC TINCIDUNT',   
            'SESTIBULUM TORTOR ERAT, NEC TINCIDUNT',  
            'ALIQUAM POSUERE LIBERO NON COMMODO'      
        );
        
        $classic_ecommerce_content = 'Morbi praesent nascetur maecenas ligula habitasse tellus duis quisque efficitur sollicitudin senectus.';
        
        // Create three posts and assign them to the 'Ecommerce' category
        for ($classic_ecommerce_i = 0; $classic_ecommerce_i < 3; $classic_ecommerce_i++) {
            set_theme_mod('classic_ecommerce_title' . ($classic_ecommerce_i + 1), $classic_ecommerce_titles[$classic_ecommerce_i]);
        
            $classic_ecommerce_my_post = array(
                'post_title'    => wp_strip_all_tags($classic_ecommerce_titles[$classic_ecommerce_i]),
                'post_content'  => $classic_ecommerce_content,
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array($classic_ecommerce_slider_category_id),
            );
        
            $classic_ecommerce_post_id = wp_insert_post($classic_ecommerce_my_post);
        
            if (!is_wp_error($classic_ecommerce_post_id)) {
                $slider_image = 'slider' . ($classic_ecommerce_i + 1) . '.png';
                $classic_ecommerce_image_url = get_template_directory_uri() . '/images/' . $slider_image;
                
                // Download and set the image as a featured image
                $classic_ecommerce_image_id = media_sideload_image($classic_ecommerce_image_url, $classic_ecommerce_post_id, null, 'id');
                
                if (!is_wp_error($classic_ecommerce_image_id)) {
                    set_post_thumbnail($classic_ecommerce_post_id, $classic_ecommerce_image_id);
                } else {
                    error_log('Failed to set post thumbnail for post ID: ' . $classic_ecommerce_post_id);
                }
            } else {
                error_log('Failed to create post: ' . print_r($classic_ecommerce_post_id, true));
            }
        }
        

        // Recent Product Section
        set_theme_mod( 'classic_ecommerce_recent_product_title', 'RECENT PRODUCT' );

        // Check if the demo importer button was clicked
        if (isset($_POST['import_demo_content'])) {
            classic_ecommerce_import_products(); // Run the import function
        }

        // Create featured products
        for ($classic_ecommerce_i = 1; $classic_ecommerce_i <= 4; $classic_ecommerce_i++) {
            // Prepare product data
            $classic_ecommerce_product_id = wp_insert_post(array(
                'post_title'  => 'Product ' . $classic_ecommerce_i,
                'post_status' => 'publish',
                'post_type'   => 'product',
            ));

            // Set featured meta, regular price, and sale price
            update_post_meta($classic_ecommerce_product_id, '_featured', 'yes');
            update_post_meta($classic_ecommerce_product_id, '_regular_price', '25.00');
            update_post_meta($classic_ecommerce_product_id, '_sale_price', '20.00');
            update_post_meta($classic_ecommerce_product_id, '_price', '20.00'); // Current price is the sale price

            // Set the image path
            $classic_ecommerce_image_path = get_template_directory() . '/images/products/product' . $classic_ecommerce_i . '.png';

            // Check if the image exists and upload it
            if (file_exists($classic_ecommerce_image_path)) {
                $classic_ecommerce_upload_dir = wp_upload_dir();
                $classic_ecommerce_image_name = 'product' . $classic_ecommerce_i . '.png';
                $classic_ecommerce_file_path = $classic_ecommerce_upload_dir['path'] . '/' . $classic_ecommerce_image_name;

                if (copy($classic_ecommerce_image_path, $classic_ecommerce_file_path)) {
                    // Get file type and prepare for attachment
                    $classic_ecommerce_filetype = wp_check_filetype($classic_ecommerce_image_name, null);
                    $classic_ecommerce_attachment = array(
                        'post_mime_type' => $classic_ecommerce_filetype['type'],
                        'post_title'     => sanitize_file_name($classic_ecommerce_image_name),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    // Insert the image as an attachment
                    $classic_ecommerce_attach_id = wp_insert_attachment($classic_ecommerce_attachment, $classic_ecommerce_file_path, $classic_ecommerce_product_id);
                    $classic_ecommerce_attach_data = wp_generate_attachment_metadata($classic_ecommerce_attach_id, $classic_ecommerce_file_path);
                    wp_update_attachment_metadata($classic_ecommerce_attach_id, $classic_ecommerce_attach_data);

                    // Set the image as the product's featured image
                    set_post_thumbnail($classic_ecommerce_product_id, $classic_ecommerce_attach_id);
                }
            }

            // Assign product to a category (e.g., 'Featured' category)
            wp_set_object_terms($classic_ecommerce_product_id, 'featured', 'product_cat');

            // Ensure all relationships are updated and product data is refreshed
            clean_post_cache($classic_ecommerce_product_id); // Ensure post cache is cleared

        }   

        // Show success message and the "View Site" button
        update_option('classic_ecommerce_demo_import_completed', true);
        echo '<br>';
        echo '<div class="success">Demo Import Successful</div>';
        echo '<br>';
        echo '<hr>';
        echo '<br>';
        echo '<span>' . esc_html__( 'You can now visit your site or customize it further.', 'classic-ecommerce' ) . '</span>';
        echo '<br>';
    }
     ?>
    <ul>
        <li>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
            <!-- Show demo importer form only if it's not submitted -->
            <?php if (!get_option('classic_ecommerce_demo_import_completed')) : ?>
                <span><?php echo esc_html( 'Click on the below content to get demo content installed.', 'classic-ecommerce' ); ?></span>
                <br><br>
                <hr><br>
                <b class="note"><?php echo esc_html('Note :', 'classic-ecommerce' ); ?></b><br><br>
                <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'classic-ecommerce' ); ?></b></small><br><br>
                <form id="demo-importer-form" action="" method="POST" onsubmit="return runDemoImport();">
                    <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','classic-ecommerce'); ?>" class="button button-primary button-large">
                </form>
                <script type="text/javascript">
                    function runDemoImport() {
                        if (confirm('Do you really want to do this?')) {
                            document.getElementById('demo-import-loader').style.display = 'block';
                            return true;
                        }
                        return false;
                    }
                </script>
             <?php endif; ?>
         <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '<a href="' . esc_url( admin_url('customize.php') ) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">Customize Demo Content</a>';
        echo '</div>';
        }
        ?>
        </li>
    </ul>
 </div>