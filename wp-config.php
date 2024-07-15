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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mxbo' );

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
define( 'AUTH_KEY',         ',6^TdAANS=*6}F-@8XZ`h!cFpjo$$_A42V_mL$TBfZC:^3w0d{H.{T<StcGqA3iv' );
define( 'SECURE_AUTH_KEY',  'iPQJTgG%4O8)f*%@Nn9h)Au)qA^_$h%j2(CFK3zSuFH|8_y%cQlN[.?:Zb1zT:,K' );
define( 'LOGGED_IN_KEY',    'n[6dFtA:U$H&Mb6=iS32wS`K6;SQ+/Ya,h-qpHGn`Nd2F4R}OgA6r6]fev!vQe6t' );
define( 'NONCE_KEY',        'CF#s]8Y?B nJH%2-2|;9`cwNZ%_bPf._C+(y87A!~Q31ZRl*)<EmsKSUme|6)Z0v' );
define( 'AUTH_SALT',        '/fnWLZS=.nyg%ZEJ,5$5x|.T;aFJ_}D?;;SzUN 2(qF,j] oD,9m<3%W@h]QI )9' );
define( 'SECURE_AUTH_SALT', 'yJ{R<w!?k@R2oa:S9)o*gp7woTv4.dRP4Go,^|@v0q0@($Z>71>v{1rz+5mKr?^)' );
define( 'LOGGED_IN_SALT',   '-63]M[d,d(1yEe%J:q9^|F^`Nvo2-;U4P9~&:seA!Q[SK0jVvoi)$KQ6Qt4^Sk>I' );
define( 'NONCE_SALT',       'R}Y|D{XLk,S`]h*XZ(hcHpd}GX05iX=byl]>*0c~lE3!uR<E@M@[goh:Yb@OL4&M' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mxb_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
