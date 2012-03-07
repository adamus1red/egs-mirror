<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base URL
 * This should be the base url to your sire WITH the trailing slash
 * eg: http://yoursite.com/
 */
$config['base_url']	= 'http://services.yoursite.com/';

/**
 * Site Name
 * Name for your site, this is use in the page titles
 */
$config['site_name']	= "IRCMOJO Services";

/** 
 * Atheme Host
 * This should the set to the ip address or hostname that is running
 * your Atheme serivces
 */
$config['atheme_host'] = "127.0.0.1";

/**
 * Atheme Path
 * This should be seto the xmlrpc path in your atheme.conf you should
 * be able to just leave this as is.
 */
$config['atheme_path'] = "/xmlrpc";

/**
 * Atheme Port
 * The port your atheme httpd is running on
 */
$config['atheme_port'] = 8080;

/**
 * Atheme Service
 * Set these to the names of the atheme services you run on your network
 * FALSE if they do NOT exist on your network
 */
$config['atheme_chanserv'] = "CHANSERV";
$config['atheme_nickserv'] = "NICKSERV";
$config['atheme_memoserv'] = "MEMOSERV";
$config['atheme_hostserv'] = "HOSTSERV";
$config['atheme_operserv'] = "OPERSERV";

/**
 * XOP System
 * If you wish to enable the XOP system within EGs
 * Note: This will replace the flags page if enabled.
 */
$config['atheme_xop']	= FALSE;

/**
 * SOPER Module?
 * Set to TRUE or FALSE depending on if you run this Atheme
 * module or not.
 */
$config['atheme_soper']	= TRUE;

/**
 * Web Register?
 * Allow users to register via the web?
 */
$config['web_register'] = TRUE;

/**
 * Index Page
 * This variable should be left as is UNLESS you want to remove it using .htaccess
 * and mod_rewrite (or equivalent) in that case comment out the line below and keep reading.
 */
$config['index_page'] = 'index.php';

/**
 * If you wish to use Apache's mod_rewrite to remove the the index.php from your URI's
 * then uncomment the line below.
 */
//$config['index_page'] = '';

/**
 * Encryption Key
 * This NEEDS to be set to a nice long random string this key will be used to secure
 * session and cookies
 */
$config['encryption_key'] = '';

/**
 * Session Config Options
 * I would hope these are fairly self explanitory
 */
$config['sess_cookie_name']		= 'egs_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['cookie_prefix']	= "egs_";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;

/**
 * Compress Output
 * You can choose to compress all output at GZIP however
 * please make sure your system its working before doing this.
 */
$config['compress_output'] = FALSE;

//
//  ___        _  _     _     ___    _ _ _     ___     _              _  _             
// |   \ ___  | \| |___| |_  | __|__| (_) |_  | _ )___| |_____ __ __ | || |___ _ _ ___ 
// | |) / _ \ | .` / _ \  _| | _|/ _` | |  _| | _ | -_) / _ \ V  V / | __ / -_) '_/ -_)
// |___/\___/ |_|\_\___/\__| |___\__,_|_|\__| |___|___|_\___/\_/\_/  |_||_\___|_| \___|
//
// You shoulnd't need to anything below this line, only attempt to do so if you know wtf you're doing!
//

$config['subclass_prefix'] = 'EG_';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd';
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'egs_sessions';
$config['global_xss_filtering'] = TRUE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';