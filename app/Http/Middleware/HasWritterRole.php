<?php

    namespace App\Http\Middleware;

    use App\Models\Role;
    use Closure;
    use Illuminate\Http\Request;

    class HasWritterRole {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next) {
            if(!authUser()->hasRole(Role::WRITTER))
                return (!$request->expectsJson())
                        ? redirect()->route('home')
                        : response()->json([ "message" => "u dont have right access"], 403);

            return $next($request);
        }
    }
