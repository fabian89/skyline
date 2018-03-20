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
define('DB_NAME', 'etalon02_skyline');

/** Имя пользователя MySQL */
define('DB_USER', 'etalon02_skyline');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '86wlb9sm');

/** Имя сервера MySQL */
define('DB_HOST', 'etalon02.mysql.tools');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '>[Vq049 2pVLA-(NB@FXWC]mtnSwA^2vYc}Cb`:o~ZN,#.uVV(WzQkD3PGDsv@-s');
define('SECURE_AUTH_KEY',  '_v%4 j#6b/0H(v9{Uy/_Q]2+g-85LEb`!7F%M<1Phhb~GRc[7@MO~?<UqcdO <Mw');
define('LOGGED_IN_KEY',    'BfX8L|ZPRO0n}bTCYCD?R,,u$>(RFk~ohWq-[S<$Cx(Z~tM@96.}/qd286p?Can1');
define('NONCE_KEY',        '};Y?pxcv8Ov|w4lV |r.LI](1e4?J~7{OJr+eX.^}:jZ7J{{l%v`k)q-A6WV8E-Q');
define('AUTH_SALT',        '&dKJ],W 2^-=5(qiItL[_P<C.eY]Abg]LNV_>#$fOXHE6B!xja)t/tEV4.Ri2&Kw');
define('SECURE_AUTH_SALT', '0;Vozqog!~buU&Ey:nxCFIM:m| !6s= h-~IvCY>R`<-`s>.Z>,+{e(c?Xe(uBn^');
define('LOGGED_IN_SALT',   '8q1Qv3 (WvFPem/(=~j8rng{ZhtngOnEiwXTDWq[0PJ@:)sKnN.< kxP|0{&%|D)');
define('NONCE_SALT',       'sewXN6NbPb!g~WEOnwqfV(1aP%YqlyiTq7.~}})m}.r8jBabX(!cgdX][$b. ~!,');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
