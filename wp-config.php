<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'libra_db' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@YuIzafNMh*qy| G)/[K%#j|^#YC-o27l[I@2#Kl[UV$Exln*0F(5p7-0j%B2Ulf' );
define( 'SECURE_AUTH_KEY',  'Y~mAll{}z-enXXCKh)PbPyN:PK<W>uQ2l.;j~MsxS=p/j,R3hoejRQ0Y,b2eh[53' );
define( 'LOGGED_IN_KEY',    'inQnmR1maQ[kgH%-UDhoVD%}i5XE!qWD$,<u<MR}>j_hXXOS.48{#=*xiC_7ahFM' );
define( 'NONCE_KEY',        'zrkM0:KR1p?NQyBm,/fw&q_KywEbo0r97T_F]da_^PB]dPI_Bu9ogOes&rr20Z#j' );
define( 'AUTH_SALT',        'ho!dQ PzlMr|a/}yG<FxT_qN<QJ16SdE/vH|QnLC~BDt9+`1|GRHCW}29te{`l=w' );
define( 'SECURE_AUTH_SALT', 'tK?cigF*=}<M@Fj}U2Op=O=I2hzBm8i@C@2.zu8+ikqT>PVa@zsqVLuy<cq41&9`' );
define( 'LOGGED_IN_SALT',   '>AQB [A6na;G_?sK9_%FHSBtr.oJl|PdHp&S<K9r_yS&Mcc*l*XjYmmh`L;Lz<7]' );
define( 'NONCE_SALT',       'q,zsv$|woZRV{3?b#iF,0t5s~5Fa LEkwUMJWSmiaNr+,P(G[@Y={=m3EozY[;B+' );

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
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
