<?php

namespace App\Exceptions;

use App\Traits\ApiResponse\JsonResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class GlobalException extends ExceptionHandler
{
    use JsonResponseTrait;

    /**
     *
     */
    public function render($request, Throwable $exception)
    {
        return $this->handleException($request, $exception);
    }

    /**
     *
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     *
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        return $this->errorResponse('No autenticado', 401);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        if ($this->isFrontend($request)) {
            return $request->ajax() ? response()->json($errors, 422) : redirect()
                ->back()
                ->withInput($request->input())
                ->withErrors($errors);
        }

        return $this->errorResponse($errors, $e->status);
    }

    /**
     * Handles exceptions and generates appropriate responses.
     *
     * - Converts validation exceptions into a response.
     * - Handles model not found exceptions by returning a user-friendly message with a 404 status code.
     * - Handles authentication exceptions, unauthenticated users, and responds accordingly.
     * - Manages authorization exceptions with a response indicating lack of permissions.
     * - Handles not-found HTTP exceptions with a 404 error message.
     * - Handles method-not-allowed HTTP exceptions, responding with a 405 status code.
     * - Handles general HTTP exceptions by returning the exception message and status code.
     * - Manages query exceptions, providing specific responses for foreign key constraint violations.
     * - Handles CSRF token mismatch exceptions, redirecting for non-API requests or returning error responses for API calls.
     * - Defaults to passing the exception to the parent renderer in debug mode.
     * - Returns a generic error response in production for unexpected failures.
     *
     * @param Request $request The current request instance.
     * @param Throwable $exception The exception being handled.
     *
     * @throws Throwable
     */
    public function handleException($request, Throwable $exception): mixed
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$model} con el id especificado", 404);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse('No posee permisos para ejecutar esta acción');
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontró la URL especificada', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El método especificado en la petición no es válido', 405);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $code = $exception->errorInfo[1];
            if ($code === 1451) {
                return $this->errorResponse('No se puede eliminar de forma permamente el recurso porque está relacionado con algún otro.', 409);
            }
        }

        if ($exception instanceof TokenMismatchException) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->errorResponse('CSRF token mismatch.', 419);
            }

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors(['error' => 'La sesión ha expirado. Por favor, intente nuevamente.']);
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->errorResponse(__('unexpected failure. try again later'), 500);
    }

    private function isFrontend($request): bool
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}
