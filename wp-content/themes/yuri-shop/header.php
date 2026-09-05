<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="yuri-header">

    <div class="yuri-header-container">

        <!-- LOGO -->
        <div class="yuri-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                Yuri<span> Shop</span>
            </a>
        </div>


        <!-- SEARCH -->
        <div class="yuri-search">

            <select>
                <option>All</option>
                <option>Electronics</option>
                <option>Fashion</option>
                <option>Home</option>
            </select>

            <input
                type="text"
                placeholder="I'm shopping for..."
            >

            <button type="button">
                Search
            </button>

        </div>


        <!-- HEADER ICONS -->
        <div class="yuri-header-actions">

            <!-- Compare -->
            <a href="#" class="yuri-action">
                <span class="yuri-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="4" y="3" width="16" height="18" rx="1"/>
                        <line x1="8" y1="17" x2="8" y2="10"/>
                        <line x1="12" y1="17" x2="12" y2="7"/>
                        <line x1="16" y1="17" x2="16" y2="12"/>
                    </svg>
                </span>
                <span class="yuri-count">0</span>
            </a>


            <!-- Wishlist -->
            <a href="#" class="yuri-action">
                <span class="yuri-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M20.8 8.7
                                 C20.8 13.8 12 20 12 20
                                 C12 20 3.2 13.8 3.2 8.7
                                 C3.2 5.7 5.3 3.8 8 3.8
                                 C9.8 3.8 11.2 4.8 12 6
                                 C12.8 4.8 14.2 3.8 16 3.8
                                 C18.7 3.8 20.8 5.7 20.8 8.7Z"/>
                    </svg>
                </span>
                <span class="yuri-count">0</span>
            </a>


            <!-- Cart -->
            <a href="<?php echo function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#'; ?>"
               class="yuri-action">

                <span class="yuri-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 5h2l2 12h11l2-9H6"/>
                        <circle cx="9" cy="20" r="1"/>
                        <circle cx="17" cy="20" r="1"/>
                    </svg>
                </span>

                <span class="yuri-count">
                    <?php
                    echo function_exists('WC') && WC()->cart
                        ? WC()->cart->get_cart_contents_count()
                        : 0;
                    ?>
                </span>

            </a>


            <!-- ACCOUNT -->
            <a href="#" class="yuri-account">

                <span class="yuri-user-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                    </svg>
                </span>

                <span class="yuri-account-text">
                    <strong>Log in</strong>
                    <strong>Register</strong>
                </span>

            </a>

        </div>

    </div>

</header>

<main>