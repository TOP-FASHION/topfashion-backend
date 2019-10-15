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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress' );

/** MySQL hostname */
define( 'DB_HOST', 'mariadb' );

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
define( 'AUTH_KEY',         '?&8*RKvh-rTpK4~rAh{s;Sr3zzCu#_E3SUvlIQfe=y=2_[<A[^a)4E |gmB!+)8W' );
define( 'SECURE_AUTH_KEY',  'k}Xj#]l;T7[n<lD?~LIRRq7l~t~OmIH)daU#AB_c&JI~FCH!1)z.: Hm!hxo^p22' );
define( 'LOGGED_IN_KEY',    't@8|.;4q7K6AX?hn<U7,/^8HJ<3 =i0~EUHHQb%:H)PH!u&R-T3@=76aHaDZk(]Z' );
define( 'NONCE_KEY',        'voaZ)|FKUNjeK8.@Gsk]MlU`)GMRK{_n}px+[+01]L,9A2)hc<B+eUA>l!qjm<:W' );
define( 'AUTH_SALT',        'Z+ QxwX;?RKN4%gAUQN?=(Ns`<<W7|4Aczm=Z[QA_i:(#(XMk74{/BQ.FQ0lD4:`' );
define( 'SECURE_AUTH_SALT', 'K6ei&Aa1j4KD+R%Rs%E<6*)+#pCQ3c7yB!hT[1dUJ2WmQ6rTlM`xD1It?WljT!sg' );
define( 'LOGGED_IN_SALT',   'IEEN4 ._s`_~0b0G{D8YIH:HNJJIwTB5S0)_X|D=/B|pGEjuB+_ DExe1,iOF-%0' );
define( 'NONCE_SALT',       ',Lp$l,NvZ)Wbh`Z%GT9E2*};4|@Z~xmk$GD>Lo|w[Qpd5+$u%{S7 a}qYuk#4uT#' );

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
define( 'WP_DEBUG', false );

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'dh.unica.localhost');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
