<?php

// Передпределяем выдачу в случае возникновения exception Kaspi\Exception\Core\Router\NotFound
use Kaspi\Exception\AppErrorHandler;
use Kaspi\{Config, Request, Response, View};

$container->set(AppErrorHandler::NOT_FOUND, static function (\Throwable $exception) use ($container) {
    /** @var View $View */
    $View = $container->{View::class};
    $response = $container->{Response::class};
    $trace = $View->getConfig()->displayErrorDetails() ? $exception->getTraceAsString() : '';
    $response->setBody($View->render('errors/404', compact(['trace'])));
});


$container->set(AppErrorHandler::CORE_ERROR, static function (\Throwable $exception) use ($container) {
    /** @var View $View */
    $View = $container->{View::class};
    $response = $container->{Response::class};
    $code = $exception->getCode();
    $message = $exception->getMessage();
    $prevMessage = $exception->getPrevious() ? $exception->getPrevious()->getMessage() : null;
    $trace =$View->getConfig()->displayErrorDetails() ? $exception->getTraceAsString() : '';
    $response->setBody($View->render('errors/500', compact(['code', 'message', 'prevMessage', 'trace'])));
});
