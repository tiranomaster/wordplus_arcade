<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordplus');

/** MySQL database username */
define('DB_USER', 'wordplus');

/** MySQL database password */
define('DB_PASSWORD', 'tkk3221');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[P>G2(5kU/UtjXkB6L2 v-A>Ik+.hQWbqH2{WyKrE9V<}F=AVcBA)3aw51t/%)K~');
define('SECURE_AUTH_KEY',  'X/3U;8x(f]|ee-gnW1{=gSY[N=(HAe$]R}x~ZP9c~-k,QPtWh}=TadqzFZ6$(FWL');
define('LOGGED_IN_KEY',    'O@Q<&l>~AG]|tYc*v+-ZjfICUMgQ:QQm-L`Gs_5r1prPT--F[krgAfoCCOUBh25x');
define('NONCE_KEY',        '0+o)D+>TIPwl+s_ri4/R2>g5!*8Je~)+UX-puVe:Q:$3b2Wa)a qmV6#^dgbvCM-');
define('AUTH_SALT',        '`zwh{C1kU4[F{W{{$f1p#o~ Ki/1+Ph5pl)3*9`{x&EX54|qjgF;Kiv>)TTwdq62');
define('SECURE_AUTH_SALT', 'td8r0m!jS_T~5(5P2$>g{hixLD&`^i%fxHwQtT2wcA5q4<;C+0W44sEtp&2$SP15');
define('LOGGED_IN_SALT',   '71=B.|Eq/+~rTX_tO@]`3JaWpV},w2GMp |<a&X)yL=|vySUF$[FYY(zS)dCN;/^');
define('NONCE_SALT',       '1&DA^0-<g|O9YMZR#f1ZB}4eWW8+jN$tA/15>!C-s#>-&xwYHT%98c_g1g[$xPuP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define ('WPLANG', 'ko_KR');

define( 'SAVEQUERIES', true );


