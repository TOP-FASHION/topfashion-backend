<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'wordpress' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'wordpress' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'mariadb' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'HR]|lf2Z-tm8Bg,:^%*`3:(siU`|1K8{KEkJ_&>>|<$-`{|(BQy,G-*{3i)(=8`@' );
define( 'SECURE_AUTH_KEY',  'M.= ]XyVhT5M=p7,c;,Wgp]Q&zbKz7QnukQG1r}B3ob9fj:`)A+<y8Oa* 2wGCw{' );
define( 'LOGGED_IN_KEY',    'fl8@Ex1Wi13Erwsd=T;y,Le%g.gTjzZlb7@:9974aw[<WR_^[tw kwDKm|1=6P->' );
define( 'NONCE_KEY',        ' IT,t#5|dqu8wcUdMkpOke@aNrXB+*)7bPkCnv[<(Uw)O3+?x;_JeHy0?K#B4s|y' );
define( 'AUTH_SALT',        'E{Zfk?*[3:!w&B5G=Ne.@|%30bu,FzHMNua<t!mKq9xi=wxs{Y%1V*MIV-S{[T=F' );
define( 'SECURE_AUTH_SALT', '7swQ0*boQo%9Kz!(7)YEUxfM&CA44}v8;Th*3ailLzL[Y1gt71$x^x`H^]V@upHz' );
define( 'LOGGED_IN_SALT',   'WPmq{M0/GKlF2.gp <:$ig^ad<hGJ:sJ<;.C>~^qD:t]dC)fHudZSnGHg$QvwaBY' );
define( 'NONCE_SALT',       'yf1asve1H*GSMywPZY44~ !h.opp?N~KCLdmF`MrTI,Mtd-r5VM].M?Y])NlK7Cj' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
