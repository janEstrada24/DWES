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
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

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
define( 'AUTH_KEY',         'g3zZO9+/|VL[1$r>uZ7Mr5lMQ%l]UoEtS@f8w9DWM0$6_x9HbC5ww*5/A^wn_[Bl' );
define( 'SECURE_AUTH_KEY',  '$YN=S30S[t]l6q4T|G3_>Ku)oWhILx/vB=#BBlQOZB0a=*aFc3X;w@QC-iCcGWdo' );
define( 'LOGGED_IN_KEY',    '] .AHk#/2K;JcECq19`mQDHi!0up4?=]9GE%f[cq*@2y/|D{tM ^b1(nMgi%<?37' );
define( 'NONCE_KEY',        '(ERA89SMnb$u|7_p x{K0@DY#$q/mLLyHyorzU^XFhk:VOPk-[6m</2j_$rJgaaO' );
define( 'AUTH_SALT',        ')$2O/R4MD>EMyql9m!<JJ]g7:`r@ix=18.zDR6[5|)McNPm1{l=eqaAYXM{GgL7%' );
define( 'SECURE_AUTH_SALT', '7B]i~3}_:$3z|hh:-Ksw&cqwodLC_(FEvd@BdK@IzE%9I^fFEGEpt N(O/m6>hW3' );
define( 'LOGGED_IN_SALT',   '*n@j0pBAb@Xgp^m|in+uYJN4ClJ`BL_`u*!I!f!P20Ii32@*4!!f*tZqQ7L<Rr4y' );
define( 'NONCE_SALT',       'Qzn)ry5vZ1m6.p<{I~uR5K-bOug#hn.r|=bu9} 6pww<sy-_Pv`F^l{*E*9zq|Ex' );

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
