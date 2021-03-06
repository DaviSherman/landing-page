<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'lp');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '>_z)Wx2Nv$08sE!f,@`81W2wR|MO}O*;-z>hcaI& NS/[7z/``n<l2<KxIy[@tGM');
define('SECURE_AUTH_KEY',  '5KJOVdYS5)~y#vca@7ND-o#T~M&++&2tzxq6U Y2]AQt}rGaqR^`|3TqWWEzB&Gt');
define('LOGGED_IN_KEY',    'nm`k2B!yW:?Ds9l=@er}O2!3+pOS$]-:(zh|,`0{?G-|@I[vt|~~[+}ry|{SJTs5');
define('NONCE_KEY',        'Hd6/|+Z/Hk2?| 9+OZ*6G-_T<5})&^QN^Ut&x#+},R{(E~dJXcaHcmFHh#j)+It/');
define('AUTH_SALT',        '|,/eqsE8%?;rA@.n||I3!MIPt oD[*TnDT>jw|lt3{yNo$oZB{={1@?3q$Iz{-}-');
define('SECURE_AUTH_SALT', 'LbIY_:|h9S,1%wPPr18dX-w[-<E 1#$u0yvkt^GX$2:qR.PY%%=cT|*`6Ft& +1r');
define('LOGGED_IN_SALT',   'IU<WSCsL!E`b&5ZD+3{b9~LIjidvvQV/3;Dn3PU]5aW;R@K&fb/ ~ _gi81a{F*{');
define('NONCE_SALT',       'fkoAP;(T@fj `G;6j@sc0oqsI7e3J3%A--?y?f{7{`+2[K9Snsr!7t*abc>-33< ');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD', 'direct');

