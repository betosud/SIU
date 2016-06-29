<?php

namespace SIU\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {


        if ($e instanceof \Bican\Roles\Exceptions\PermissionDeniedException) {
//            return response('No cuentas Con Acceso a este modulo.', 401);
            \Session::flash('message', 'No tienes Permiso a este modulo');
            return redirect()->route('/home');
        }
        if ($e instanceof \Bican\Roles\Exceptions\LevelDeniedException) {
//            return response('No cuentas Con Acceso a este modulo.', 401);
            \Session::flash('message', 'No tienes Permiso a este modulo');
            return redirect()->route('/home');
        }
        if ($e instanceof \Bican\Roles\Exceptions\RoleDeniedException) {

//            return response('No cuentas Con Acceso a este modulo.', 401);
            \Session::flash('message', 'No tienes Permiso a este modulo');
            return redirect()->route('/home');
        }
        if ($e instanceof \Bican\Roles\Exceptions\AccessDeniedException) {
//            return response('No cuentas Con Acceso a este modulo.', 401);
            \Session::flash('message', 'No tienes Permiso a este modulo');
            return redirect()->route('/home');
        }
        return parent::render($request, $e);




    }
}
