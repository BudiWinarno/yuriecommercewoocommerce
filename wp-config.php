<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'toko' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'CaPoQa/K9/Re_`$V^W/(?|`oVVWF&5)NW)bTtW_?8?v4D!D_o`aeeKfX[X/FL3F!' );
define( 'SECURE_AUTH_KEY',  'FE=+sGuo@OPQ4:{axk2^z{T+YS&@Uo/!X,O+tSR{f=R$13O@3,q/xEfGmfY>lhpH' );
define( 'LOGGED_IN_KEY',    'O}zx@cX6fj^dKp3w&~ok>!q.VI?8D6^yw)nyuq?283lH+f66!IHLfN^{_CEks,9<' );
define( 'NONCE_KEY',        'SF;H^M@ .Oj+wHBQrUriorPg}daR6D5GV7/!x1[p?[*GmYM=lq:]S!U^4 rP<8gF' );
define( 'AUTH_SALT',        'c4kURCF*=dfBEl6;Pwm)!mVDy:}a$NwYj/}4<$yz?_N*(Hxk2*K:O3v!>WdU:yJG' );
define( 'SECURE_AUTH_SALT', 'xszE@cPtqRH{?<gRuVD.,HXKZWPn,mN?[d#A~EZSzn(xE)B6Olgk<r3|hr77lyR<' );
define( 'LOGGED_IN_SALT',   '9TPGftaxg#XKF$t9@fg5+A}nxm34({m-m16o@!n<^~g:YlAlY$4ql3]/GC<KH|Mz' );
define( 'NONCE_SALT',       '1tO`M}?|5+MUbKTWvh.E<}G[(/@l##%WLw,Zji&l#?GE}ldu_a@]!<@w EWV@==/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
