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

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '4a287a1da397c956b16916d24ee56a12ac5f692c40ac9e9ede87fa492b5749d2' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'DCNiEzXF&%#g{I?Zt)T5M.,&oGu#_Fc6,UvR<?y[0-)4^ZT3})$-?T`ojuHG&MH8' );

define( 'SECURE_AUTH_KEY',  'mm|tK+? kIppjUznL_O#kKN;q]%ZrL{.Un?vEvl<)a`)tos9N3tqec>CHg-!2{7T' );

define( 'LOGGED_IN_KEY',    'yGFQuPF[2K^X|FI5}Ihi3$emm8-MqNELVX/CU)^d`6o, a!:dbAzL!q?%m^SJ/]l' );

define( 'NONCE_KEY',        '#%5<oqLEvh <0)sl04Q]o=dw4-q>riI^.oW5bgH1sA=3d9*VqEU0SGYh`R42[N;;' );

define( 'AUTH_SALT',        'oFWS>:{qI.`W4;&}Y,c0$^@?u8QQ>6i.n(oE`=J@so{L<r=wMsO%n~xN|0q{xtGe' );

define( 'SECURE_AUTH_SALT', 'aG%:]LbS?*rV2l(OjOoo./jxrXQrzhc>Ac)G18o;&fs*E7aq6~`)xoo=5/Sv~}sX' );

define( 'LOGGED_IN_SALT',   'Wc$e[sNb~O8L5I#+igRQA*ns/m i_E_:JisR-OA;V>? _R5==g!^f~rPM/)}h]2@' );

define( 'NONCE_SALT',       'ZcaO]NWctH&+n{tmdtTl3{:@`b*o% i^!XC}rQbpyLAGc~P+k6i`L.-hCt#& ~We' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
