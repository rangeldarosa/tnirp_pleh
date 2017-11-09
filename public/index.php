<?php
/**
 *
 * @author Equipe...
 * @link https://github.com/panique/mini/
 * @license http://opensource.org/licenses/MIT MIT License
 */


define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

//-- CONSTANTE DE VALORES, PARA MUDAR EM UM UNICO LUGAR
define('VALOR_PREFIX_MOEDA', 'R$');
define('VALOR_CASAS_DECIMAIS', 2);
define('VALOR_PREFIX_MILHAR', '.');
define('VALOR_PREFIX_CENTAVOS', ',');
define('VALOR_DESCRICAO_VARIACAO', 'Valores sujeitos a variações, Consulte-nos!');
//--

if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

require APP . 'config/config.php';
require APP . 'config/configMenu.php';

require APP . 'libs/helper.php';

require APP . 'core/application.php';
require APP . 'core/controller.php';

$app = new Application();
