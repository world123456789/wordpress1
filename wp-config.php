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
define( 'DB_NAME', 'wp2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'OcXzSS;<A*zycYXW--|3e6SrLo2@N.Z/T7>Zfp(*Nt{5,;wl1yOxJeLf N3w%oox' );
define( 'SECURE_AUTH_KEY',  'rd-ySwuoZ*M?~]BvcU10E%,.W0;rAJYG8WUaz4);RzLh}=X!n@~w!WzS#1/TDef[' );
define( 'LOGGED_IN_KEY',    '+8A8nF%$]31T$>82>%$%+K$zwE&}A$7T>7j:G`)d;b3YuF[Vse;XHSh(U{`v=r:n' );
define( 'NONCE_KEY',        'U#i5_/3]2?tO&[C~:+5A~Eg2mX$J*8IS$sCP6=W3qdGMZDIw]t`6/%Cb*O EQ7[+' );
define( 'AUTH_SALT',        'gJ1=2o{}ijG#,|*=`Y],uC19P<KlFVL<LSGu9Soh|uy3pfr@ha$],W>vy4hs_~17' );
define( 'SECURE_AUTH_SALT', '`@qu3VfLky Cp`5/;?&XOC50 k-(w#FN-$lpeWl)Y:J9q3,TUbhWq@xvqB|LDfGS' );
define( 'LOGGED_IN_SALT',   ')h|f+<[xu(>f{l)0?yItiNd|9j`?V/ex.Nop&&j^_Ys)f##??XqwMgvg*9c@;V]t' );
define( 'NONCE_SALT',       'EBOBVj)H)G4=D=Ym-~pChr$Y/%=@vr8j|IquPnDuwB>aZ1AG>6,3inPp]M%0sy0Y' );

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
