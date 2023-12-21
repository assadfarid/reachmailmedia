<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'reachmailmediadb' );

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
define( 'AUTH_KEY',         '#F@6D-,^=zu7MV?,QN]h-RWNj(z4K5g eyZD]ap,Csc,8p;K1vEP~xyu5yaE+US5' );
define( 'SECURE_AUTH_KEY',  '`]XO5HI98Y8|=l?uWK49eT+JU0:Ut/Dd@I+ AXwPk]=9o >Nq_wxx$|dWJ}4RP.r' );
define( 'LOGGED_IN_KEY',    'ExjU5*{,]y^2RGH5)}(/hkf1k|HX/MU;FI5St%C|FBfc[eSv!T6-i%!-%9zvfrt0' );
define( 'NONCE_KEY',        'UcwH/-P`Wv(+|M+^%0dqe^dN9,.qhJnh uXPqBv1%S5qQb1V5VcolPsN>gYHyy2{' );
define( 'AUTH_SALT',        '_H]61I>8D*tK6h{[O[k8m x7j8J%@qJ?t=*NvMtY,zQdgs%e=/X_QH7SK^,_!*MV' );
define( 'SECURE_AUTH_SALT', 'P}hZcO cZ@./K~6eUEDt(V]n6`DYz]?UI/e&22WiAr;5}1m?;e3w{0 fMmHpIMxu' );
define( 'LOGGED_IN_SALT',   '11,=6&9b(C1K&W>8KGd6Bt~GBkDNW@h_8W@,pUz2USnk&nCjJon{Ec?)p=mXDa-<' );
define( 'NONCE_SALT',       '!UV1wM9)RtxyuwZ<oxL/Ft_l:{3D/M4,aj~s#{q2e;eX )*{UdbdC=[v$ev~$aa ' );

/**#@-*/

/**
 * WordPress database table prefix.
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
