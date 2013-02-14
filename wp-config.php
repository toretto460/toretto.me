<?php
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

define(DEV, true);

if (DEV == true) {
	$mysql_string = "mysql://toretto:toretto@localhost/toretto";
} else {
	$mysql_string = apache_getenv("CLEARDB_DATABASE_URL");
}

$db = parse_url($mysql_string);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($db["path"],"/"));

/** MySQL database username */
define('DB_USER', $db["user"]);

/** MySQL database password */
define('DB_PASSWORD', $db["pass"]);

/** MySQL hostname */
define('DB_HOST', $db["host"].':'.$db['port']);

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
define('AUTH_KEY',         'R]0a.(P[7+t~){{d0OSOG]qeD)TdIbHDDu>Rq]_+0.<@Yd4So75WsepRcm1}t4Nq');
define('SECURE_AUTH_KEY',  '][>Yf6<yC:*$}9lPL||UXX[Y$A.fX^#,[+IYr4[r:1D5tx+Qo6C+aS%i;}|8[R0d');
define('LOGGED_IN_KEY',    '6hbDasQw.5J]^gCf/| _ [%mKkAgvuO8$8-?O9ze!&8 }/@vG{limw_-Hn6+8Dv[');
define('NONCE_KEY',        'Ph8k^[sAvKhudBo7|P(MnaEVH#469n--IO?#/f6U5fSG.|1NmWC:JVZtL_p,,gLr');
define('AUTH_SALT',        '*:{G+s>C)GDBdy#56|my:K40-{7C08/BGslIdp)szEvY:pgmG?luv[iBy s3s<&W');
define('SECURE_AUTH_SALT', '),-n3B|kMhQq2M|i}6 ??T$,2vk1[M>,4f`3NEc 7s }uH@|YYMJFaLu752Z@A >');
define('LOGGED_IN_SALT',   'HePjA*Fy]V$1M?+G952A=f<X^$2MAWYR-B_0[dR!5HdqRT32gx4(*d9*Fg*MRYX-');
define('NONCE_SALT',       'k( vMV#v%m:^%=2oh|x5<N_-TlAoF.N]u5F>`]ERL$zR2#,o3HF<eCD+!(|8]9G2');

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
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
