<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

//define('ZF_CLASS_CACHE', 'data/cache/classes.php.cache');
//if (file_exists(ZF_CLASS_CACHE)) {
//    require_once ZF_CLASS_CACHE;
//}

define('REQUEST_MICROTIME', microtime(true));

set_time_limit(0);
ini_set('display_errors', true);
error_reporting(E_ALL);

//define('XHPROF_ENABLED', true);
define('XHPROF_ENABLED', false);

register_shutdown_function(
    function () {

        if (XHPROF_ENABLED) {

            $xhprof_data = xhprof_disable();

            $XHPROF_ROOT = '/var/www';
            include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
            include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

            $xhprof_runs = new XHProfRuns_Default();

            $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
            echo($run_id);
        }

        $last_error = error_get_last();
        if (!empty($last_error)) {
            echo('<pre>');
            var_dump($last_error);
        }
    }
);

if (XHPROF_ENABLED) {
    xhprof_enable();
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
