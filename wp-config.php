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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kursus-online' );

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
define( 'AUTH_KEY',         'jH#Nee/U9Gnh;V9E@rh!v7^#KV*MFT9Pp0VnQ$2@M&U|pgkOi>KI7H&0$a17.xU9' );
define( 'SECURE_AUTH_KEY',  'Vdu_k1Fd?sD1a=#ga 3*_#9bi4?u3xjvX(m_AlY7 0KC Sj_CZt>JqH%53mHdF|F' );
define( 'LOGGED_IN_KEY',    'eZbq~{}/PKW*{B@0d:i;,>TK%R}}6aFv9dqGiTa84]87;2 @93A8#84]!pR`.%K>' );
define( 'NONCE_KEY',        ':JFFQO}?JO;s6JSjKHE,,GN;0{4WtB2OW7(<vCSZQ]C4VFxeqtCNL QM!Fvgzywh' );
define( 'AUTH_SALT',        'hRVnUrh.g@pEV_tt}1KAjFB=oDiL?ovA~qf1pO[m1skXXk)/UnFL~+[%Ah a:dG{' );
define( 'SECURE_AUTH_SALT', 'sh6KD%5l7 0fQ,P|=20$g8O)`8M=WT;(5_u)_yB>h<HVkc(EG|IEfh4c/GoS5qNE' );
define( 'LOGGED_IN_SALT',   '*.>wt:JKEvz84&i*$^xn@-gj84C](O+W$X>PB3H!uXkUs55L8dIND%,dBOuVw]^N' );
define( 'NONCE_SALT',       ':DH/am@GnggB9ZdawxJ@vavjnIJI!Sh8obN33.K3[=xX5/o!4TVa,5E+_z9gH%1T' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
