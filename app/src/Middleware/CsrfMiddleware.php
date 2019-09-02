<?php

namespace App\Middleware;

use Kaspi\Config;
use Kaspi\Exception\Core\CsrfGuardException;
use Kaspi\Middleware;
use Kaspi\View;
use Kaspi\Components\CsrfGuard;
use Kaspi\Exception\Core\AppException;

class CsrfMiddleware extends Middleware
{
    public function __invoke()
    {
        try {
            $CsrfGuard = new CsrfGuard($this->container->{Config::class});
            $CsrfGuard->verify($this->request);
            /*
             * в шаблонах можно использовать переменную для вставки готового hidden поля с токеном
             * <?php echo $xCsrf ?>
             * Имя ключа можно сконфигурировать в config файле и метод Kaspi\Config::getCsrfName
             */
            $this->container->{View::class}->addGlobalData(
                $CsrfGuard->getTokenName(),
                "<input type='hidden' value='{$CsrfGuard->getTokenValue()}' name='{$CsrfGuard->getTokenName()}'>"
            );
        } catch (CsrfGuardException $exception) {
            throw new AppException('Ошибка верификации CSRF токена полученного с формы. ', 500, $exception);
        }
    }
}
