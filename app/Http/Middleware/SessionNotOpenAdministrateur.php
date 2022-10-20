<?php
    namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Http\Request;

    class SessionNotOpenAdministrateur{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next){
            if(!Session()->has('email') || session('type') == 'Administrateur'){
                return view('Errors.not_found');
            }
            return $next($request);
        }
    }
?>
