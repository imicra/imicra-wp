# Стартовая тема основанная на _s (A Starter Theme for WordPress)

См.
- [github](https://github.com/automattic/_s)
- [_s](https://underscores.me/)

Описание
---------------

Заточенно под определенный рабочий процесс. Используется для разработки тем. Постоянно дополняется для более удобной и быстрой работы с часто используемыми модулями на сайтах.

Компилляция идет с помощью отдельной 'темы' `gulp-dev`:
- [См. репозиторий](https://github.com/imicra/gulp-dev)

### Компилляция

* `style.css` для задания темы
* В папке `sass` вся работа со стилями
* В папке `js` главный файл - `main.js`
* В папку `src` скидываются все плагины jQuery/js и т.п. А также в папке `img` находится `svg-icons.svg` для всех иконок, которые используются отдельно, как картинки svg. В `sass` лежат bootstrap 4 и fontawesome.
* Все это добро компилируется в папку `assets`. Из src под названием `libs.min.css` и `libs.min.js`

### Файлы

* Вся настройка в functions.php. Там же подключаются файлы из папки `inc`. Изначально подключены не все, а подключаются в процессе разработки по мере необходимости.
* Для front-page (обычно это главная стр. сайта, сделанная в виде лендинга) заготовка в виде отдельного шаблона в папке `templates`. Чтобы его использовать, нужно создать новую страницу и выбрать для нее шаблон `Главная страница`.
* Папка `inc` содержит файлы с кастомными функциями и расширениями стандартного функционала.

### inc

* Папка с плагином `CMB2`. И файл `cmb2.php` с метабоксами. Описание плагина см. [CMB2](https://github.com/CMB2/CMB2/wiki/Field-Types/).
* Плагин `customizer-repeater` для Customizer.
* Файл `custom-styles.php` создает css в head, управляемые в Customizer.
* Файл `icon-functions.php` для вставки svg в код и создания меню.
* Файл `bootstrap-walker-nav-menu.php` для стандартного меню из bootstrap.
* Файл `custom-walker-nav-menu.php` для создания нового Walker_Nav_Menu.
* Файл `theme-functions.php` с кастомными функциями.
* Папка `cpt` для Custom Post Types.
* Папка `admin` для расширения функционала админки. Изначально создает раздел меню для настроек темы.
* Файл `woocommerce.php` с начальными настройками для подключения в тему Woocommerce.
