<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

 //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\wamp\www\boilerplate\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
$local_config = dirname( __FILE__ ) . '/wp-config-local.php';

// Load local config if it exists. Otherwise, assumption is production
if( file_exists( $local_config ) ) {
  include( $local_config );
}
else {

  // ** MySQL settings - You can get this info from your web host ** //
  /** The name of the database for WordPress */
  define('DB_NAME', 'PRODUCTION_DB_NAME');

  /** MySQL database username */
  define('DB_USER', 'PRODUCTION_USER_NAME');

  /** MySQL database password */
  define('DB_PASSWORD', 'PRODUCTION_PASSWORD');

  /** MySQL hostname */
  define('DB_HOST', 'localhost');

  /** Database Charset to use in creating database tables. */
  define('DB_CHARSET', 'utf8');

  /** The Database Collate type. Don't change this if in doubt. */
  define('DB_COLLATE', '');

}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l@=9`*Q#AA.jK-oy0_=m`(}Ffp(F7:vK!5C:=z/~yi^)yAB*BN~^>5RSh05`h)fU');
define('SECURE_AUTH_KEY',  'NB)xaHj^i-EU?!3cfmQ6qB0M:E47h>qv|40+.*@oi+_>Z=L`Ai,,1Q=4G&8q_{,$');
define('LOGGED_IN_KEY',    ']x]/c&s~7`$ca,2?`!Y%mN/=LJe%>]3C#6DcG@tioIo1-x67NVM?u*QJbA^[gC@J');
define('NONCE_KEY',        '12^J?7HvjhlSrH^4rq-|hBMy.bN:?^k]EimSj}--%l[oAX7RRbHAR<mqP18IX2Cx');
define('AUTH_SALT',        'csv~|=+3yS-ZxQF)fV#:.nU3*]inPVc2!N{pdq;ksd`R=W+T-p_`LS.QJ1!p5r(A');
define('SECURE_AUTH_SALT', 'z]S8_-!ni:h(F*2^G1;S!n31N3+-6=4x=zHJQW{|U~maxYe|({#O(Nt?X uqmc3>');
define('LOGGED_IN_SALT',   '*S,2^.P ;_lN(<AoJmQ^,u*dI`2#0Y1&$Uqc#O.FlL(DT0|i-Z-/^C%`=2+_Q,K{');
define('NONCE_SALT',       '-Wu1XGu;qlDe+sOQZ6m~#93uuE(+5oL:WA-Emdo2 ]7!! ;1tf~QkXd$)nl[~^qa');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined( 'ABSPATH' ) ) {
  define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
