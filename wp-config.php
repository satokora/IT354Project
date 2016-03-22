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

define( 'AUTOMATIC_UPDATER_DISABLED', true );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'it354project');

/** MySQL database username */
define('DB_USER', 'it354project');

/** MySQL database password */
define('DB_PASSWORD', 'chassan');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-FiHCKn;G-H63uh}.-;;I/6F+^FR5m-r/v.Tv/RujjU_muDkX_<ys7@]1 QXJ<Tj');
define('SECURE_AUTH_KEY',  'Y|0h{-*ma^o,;U}iqaE|,I5x CRoaL1p%j9-d@6T2@w|#pnOzM3%gGGfnEWN%7U|');
define('LOGGED_IN_KEY',    '5T?nTr[zo.t(=0wg?p5g+od|SgSBe{1$AXi(Ghw3cFXK4j*kjo(iGPtuW5N$tG7/');
define('NONCE_KEY',        '~1PI}Wq&=s6+d/RB[)Gt,rZ?2:m`b-uOaQN8&e[8V*VtYmImKeQfUP``N7Q%P.cC');
define('AUTH_SALT',        '`PY6s5}wUKv&v4wvQ/%I|+T}h-JkT  d^A/Y<iW,Gd9J8KIXGf>4J]N5!)axgj[)');
define('SECURE_AUTH_SALT', '~ysvQGweSP+U,@t)qpL)cCvFq~/JSVeIQt|(Q-MjJ0^`+#^gch:5C[j`r;YuQH4r');
define('LOGGED_IN_SALT',   'u(5,O9~F_Fb-erD_F|lyT03-43swel^ |F-=<+G:u<$3}<.v{zZHwX0fO:[dt[AX');
define('NONCE_SALT',       'u7E7<zV&7sPbT>M7f>uaul$RV%{ PLOl+[5Md1b`C*OJ[T[,C7V&Uen|X ZAd[W?');

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
