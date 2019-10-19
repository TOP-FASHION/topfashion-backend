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
define( 'AUTH_KEY',         '6kfV[&e?epkNTR62r0z$B?{2H,7>TPsvP EqYDE[ oDjT.Uh?0pl|r+1y..eh7s]' );
define( 'SECURE_AUTH_KEY',  'TT/_?DRWw/+~2oJAcUumCp2Pe7L~_~Q*Q0R41n;TX%lIOs}k_o&pJ7 g_L(d1rqz' );
define( 'LOGGED_IN_KEY',    '2u(/pE{~U@*c+8ytEGr4!gi7~0LOz`KW/nfD!+MRydUm[aI{Y;:*m:g[gvYI|&.5' );
define( 'NONCE_KEY',        'Y<PVShUWRk1w2y#Gmvw?-&QTY9ULg-EI(Vs!qLj?aS2]s ^}9~!s+5bC?9O[{[Kd' );
define( 'AUTH_SALT',        '#~>U=wqduk/TWh,Rs<MFO]4uuGmY9?db`3.e]b1J5$p#qRx~G ZW(&G(eNvkEw-W' );
define( 'SECURE_AUTH_SALT', '{jOH0*Qor~?q{d_iy4?-bB 4JdG.[BCxXpwqD&[xfl[(Aw`B&AF,+o:h,uKQqx_L' );
define( 'LOGGED_IN_SALT',   'lB?WHr9ea[$4Nte4qua)SJDv`;/|Y_a8j+^W,n 2&`-v-!E*L`Z<d7?HD=(g&-V6' );
define( 'NONCE_SALT',       '@iJ+_2=L2wh9rl~w 4XS,*U$ 1tW0Y0CLbe)5Y39XLbY|m}]%iFaG-|m16~P_Y@h' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
