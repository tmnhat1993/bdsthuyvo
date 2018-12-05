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
define('DB_NAME', 'bds_thuyvo');

/** MySQL database username */
define('DB_USER', 'thuyvo');

/** MySQL database password */
define('DB_PASSWORD', '6POnbmXJhnuhD3Ai');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD','direct');
define("FTP_HOST", "localhost");
define("FTP_USER", "thuyvo");
define("FTP_PASS", ".");

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'QW:tqc+&y^X^%AmEe6WE^i}q<ka, !f$E.XJ4%DVfeQH[{ &[9w/crfglkI8:E&M');
define('SECURE_AUTH_KEY',  'G^B&yEPz1WX)0SW6=IzrHKDey@FDGqVwz@=$%@J@cT]KabZ^e30EW$4TL%wvjcUt');
define('LOGGED_IN_KEY',    '!;66J]@ Hr0t*MdWPi%<MxNpUq|(fO|7lyJ=+)AtpNS25|D`<@W7<u)6{7J_l~O,');
define('NONCE_KEY',        'z`Z+fE<#%Al%OVZx&a0YW[XF,6kkRXc(sq^}H?}!ldP*Sp}|I1@|PkJ>12C~^q 5');
define('AUTH_SALT',        'iQ;@{;5{*m8V!&PeTcK)xXlC3,9O[}Dcz_E1_0:xoCcF;hk5U&n%pyu]YhLR8hs#');
define('SECURE_AUTH_SALT', 'KnpoqY~^buk|6JHhNAoD)W10T*57hF$`0ji@2k`vx@5M2K52N]A[Kzh*Jux2Wn&P');
define('LOGGED_IN_SALT',   'Fc$bc^UD$Z$h$$KwCf|Kw=cAO.yZ]Z77&}x;0*~ooIxHR8.VMVm:+j}voB`9|t!q');
define('NONCE_SALT',       'Ixj,!J*0.IV-F;c$o6`w4t}/w)SaGw<N=sp: E3F/Em<LbZcH>G:rj~1H<$!2t[x');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
