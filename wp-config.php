<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')E)RqGbDqO+`@KURaPcM-MTi60T,~)|uyJv|*tWhlZb?)9SK_A;USMxH8s~X@yuc' );
define( 'SECURE_AUTH_KEY',  'ZAP@9s0HURw;}jR]Nrf7!U(k:GvE73H}D+E3|mhi4Up>sUtQKtC54O}dhMDy0OY|' );
define( 'LOGGED_IN_KEY',    '@ug%${CVL=/<Nce bNE@k=~?]rojF#<hUU6j!C|algKL_eQb~LQpQ?xoT,ZKU.Oa' );
define( 'NONCE_KEY',        ')?rF7nBuJ1!G1*3#&%*ms[tiXrSc&=U0pwKEYB`~M)SL2MD`eK;qP)R51#bU/9T-' );
define( 'AUTH_SALT',        '(xKqwyS0YO,Basq&_xC&ouC|Axc<U c6++&nHuzE9<r_:]N)JF@~E{~&w}i]4F??' );
define( 'SECURE_AUTH_SALT', 'Ty0]wThqPSo0CcR:l~>)1>s;|DMU78{%Yz0($GP?E%fbDx!^{sKN;I~RTt1Judw$' );
define( 'LOGGED_IN_SALT',   'T2)gD:uyNTy`uLSVg!GZH,YP@r{~y@;HFEoto4 !.e{M40%I&N(dpLt{9i|7rZ(]' );
define( 'NONCE_SALT',       '=-[_,*W8c2:?ox~uio;aVuU`2Lk2mcfT2$8`!G_,&h^b)cBE1?pU!nDh.3u^SI3{' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
//define( 'WP_DEBUG', false );

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
