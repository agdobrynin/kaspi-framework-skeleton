<?php

namespace App\Middleware;

use Kaspi\App;
use Kaspi\Exception\AppException;
use Kaspi\Exception\CsrfGuardException;
use Kaspi\Middleware;
use Kaspi\View;
use Kaspi\Components\CsrfGuard;

class CsrfMiddleware extends Middleware
{
    public function __invoke()
    {
        try {
            $CsrfGuard = new CsrfGuard(App::getConfig());
            $CsrfGuard->verify($this->request);
        } catch (CsrfGuardException $exception) {
            throw new AppException($exception->getMessage());
        }
        /*
         * в шаблонах можно использовать переменную для вставки готового hidden поля с токеном
         * <?php echo $xCsrf ?>
         * Имя ключа можно сконфигурировать в config файле и метод Kaspi\Config::getCsrfName
         */
        $this->container->get(View::class)->addGlobalData(
                $CsrfGuard->getTokenName(),
                "<input type='hidden' value='{$CsrfGuard->getTokenValue()}' name='{$CsrfGuard->getTokenName()}'>"
            );
    }
}
