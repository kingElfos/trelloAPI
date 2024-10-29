<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CsrfTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el token CSRF del encabezado o de la solicitud
        $csrfToken = $request->header('X-CSRF-TOKEN') ?? $request->input('_token');
        echo "token 1 " . $request->input('_token');
        echo "token 2 " . $request->header('X-CSRF-TOKEN')

        // Verificar si el token es válido
        if ($csrfToken !== session()->token()) {
            return response()->json(['message' => 'CSRF token mismatch'], 403);
        }

        return $next($request);
    }
}
