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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'api' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '1234567890' );

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
define( 'AUTH_KEY',         'Ic^^XzaHS7Cr{}JBiR:/XqaS+lS)v6)l7gbG6c/hsub!{oh`&.BDjG`#G#pkf5J$' );
define( 'SECURE_AUTH_KEY',  'TUp$^+z$>IA.ch`AYiHQwkFUx}&|AJpX;~c:M(/uIi^[+t1i#Hi`uOH3C7*o-_PV' );
define( 'LOGGED_IN_KEY',    '5p/D8Q_;#E~&YAXtSOEXyRLgc1T%0@4?-Q`A.U[kcnKN3(uD@7y&TO>sLPxgy46m' );
define( 'NONCE_KEY',        'b2{39aB`Y@Io9<T(=$.QqyVZp.PvU,r5A|ks^T9W/:H6bE}PFvSqPnfS <*Q%>wM' );
define( 'AUTH_SALT',        'w^x=]/~lJ{9Y2J:5>WL(<RVtvV<Jq=pIcr91MIRLM4Q&3rf-PR.Uq8B{{sv1T#r)' );
define( 'SECURE_AUTH_SALT', 'oN4Xb26eN`Dy/=ZSk-@^&,/!_# +}:L]n$@a[h 6-&Sbt%E^Lace7u?DNnY^1/Pa' );
define( 'LOGGED_IN_SALT',   'VQnUdH+tH<!ihZf#r(8A2OAB{t w+^N)W+m)jxWTyDpm1NjaMJbrGaIdX0iz7um&' );
define( 'NONCE_SALT',       '}+7=gKy*g[~G u{KHsD8!%mh.o3@UR&=KD?)f?TXP9?VDmNtn}$jPz?N-Ot]f@jo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
