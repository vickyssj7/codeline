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
define('DB_NAME', 'films');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'gRH&-,!$/RZuhj)~!vPP^4Z/g!mD!|qh)XoV892r2s${r9Y5ggIMEmsrhA N3Pf^');
define('SECURE_AUTH_KEY',  'RH..d,}Kbp-_$lPyKQ2>|GEYRb%Rhy}VB(f`rsv?W -qHaQ]J;TcNy9*P]_>}5aN');
define('LOGGED_IN_KEY',    'C0v9l75dosL|k*at,dAd{ZGT3j^r~/v9?cD W<qed77F#rIXIK3p9)`ZL#Wy@D;D');
define('NONCE_KEY',        'a/o*YRc.N1:ILCFD]MV78zAL#`|Z.9ldp:f5wB83S(IoojHW|BR1ny?OTWmDL,,$');
define('AUTH_SALT',        'MYwXRUKmgrcCOZD]T[-Oil&>7SI *-[(oZ3(%?}MAm`ZqZWn:YFE/~@ JA&EOK=/');
define('SECURE_AUTH_SALT', ';#V;T]P6(R_ICA^5Mq_KI#Pg(z^sH#2al@wUjS9=BkJpH62Nv]H$OP3?nU3t[IY&');
define('LOGGED_IN_SALT',   'F@q1,Hb3dp!H&]cpGxS6M7g>R{*fhw)mq=K6l.QLCn_ICnBSa,e^z*v/R`&~!C!{');
define('NONCE_SALT',       '-6TTG,gVlW;%T25ie.(1U.rYj5[WZ>1|MGJ2nSLcSUeC[|[VYiDKf2:qEX5#0eE|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
