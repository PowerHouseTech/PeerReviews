<?php
# Database Configuration
define( 'DB_NAME', 'wp_writespikesite' );
define( 'DB_USER', 'writespikesite' );
define( 'DB_PASSWORD', 'bGyNhpAUZ7XiysEaHu6s' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '+yT|;jS|Qm`=KJ|Qp|Zg@[ PpW+x<d+2{Pu3A0isXex}]gv,Q6/UAr9!,W?BZE2%');
define('SECURE_AUTH_KEY',  '%sjgor! eVwsx{upI`Qb>n3(-isrk=ANFCL]5g7~|}|cZR*+vK!_1{[pS+Ii^jOD');
define('LOGGED_IN_KEY',    'R]k9;:rn.l~:N,.-q}n7OeO[+MV(>jW?-VC6vF%eCm$Qs&/#rptS%0]+.2rn@-Hy');
define('NONCE_KEY',        'rw*s[G[h@?+*!~0H|$<C1kk#me&wI2{3g6T~ G<7pWd~4>cufV?DH-i^/Bc~:]]~');
define('AUTH_SALT',        '[ |m. s+kIuQ^*1-X*`/*zjN.v,7y$[txkL>8#h&u>H~84paDquhVYqK4=M1|w-|');
define('SECURE_AUTH_SALT', 't_#g:^P?w<7$coh^EOMo[lU:8p5MV&)8yi%rRsOe(szgm+z]&C(fo;,LJLSq.Pjh');
define('LOGGED_IN_SALT',   '+N|srgM ?53^p<zEY=Cdk>ow3PKt0]gls}eBB?I)q*78k+g&% C>/Jl?-l4yUQa$');
define('NONCE_SALT',       '0=^O4|1jWlHI+j.JiT&iM#mg%IP=;S^Uf2o[XYp97ls_<X||aK0-fhsHuE@z>|@g');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'writespikesite' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '76ecb74bfa6a650178184b7e6bf8a05449281829' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '100167' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '104.196.173.58' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'writespikesite.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-100167', );

$wpe_special_ips=array ( 0 => '104.196.173.58', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
