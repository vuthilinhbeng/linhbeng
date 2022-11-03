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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/huhu/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
/** The name of the database for WordPress */
define( 'DB_NAME', 'banhang' );

/** Database username */
define( 'DB_USER', 'banhang' );

/** Database password */
define( 'DB_PASSWORD', '123456789' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3308' );

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
define( 'AUTH_KEY',         'hmLY}&io:D)4,pDqJAdz)~%c*#m#~7P,OPK39hO0t4ZdmWY9JC]]#<pW6SoSsKrb' );
define( 'SECURE_AUTH_KEY',  'imAJADOvmuJzRc_,3^y$Z2m@z%LXf1yOav|wd3l>&O rp52sPd:,jeaa&`VH @PE' );
define( 'LOGGED_IN_KEY',    '6_N1@^f!l` a_i+{=r|||+WA2ER@Z$Zoxm0C?hvV.@x{+.<R.zU|=&9e !ncx!wI' );
define( 'NONCE_KEY',        'gf.mr&4S&;#HiBbASawq_5.n1YYjo%?_ew5<Y3Itpi,Di3_d66lPA@@po70HVDst' );
define( 'AUTH_SALT',        'y0VLx+Q0a:7Nk 3jRHf;-gB/b(tAhBcbiSctfQ3,*kx.#m;bnledKtx.qoT6nkw]' );
define( 'SECURE_AUTH_SALT', '![rU=+Xyp/{=[k~O#f/+0$[ij]-oa?T.Rfp`rg9 i&kd&}ess-y%^} ?+f[kv=Cs' );
define( 'LOGGED_IN_SALT',   's:)EGv9t*#`Tb;/yen}B,x/W+%tReDkccBxS>Z/h`r5~d:sbX6)]|D)M6+21JiHm' );
define( 'NONCE_SALT',       's<HiArJOUv&HspRN!rj3%DZIq{ODdxAD3wr8t`aU0:N&Tvvp!b*ZEn#x.|^,ZT`F' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
