<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;

    class HomeController extends Controller {
        /**
         * Show the application main page.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function index() {
            return view('pages.index');
        }

        /**
         * Show the application main page.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function singleDoc() {
            return view('pages.single-doc');
        }

        /**
         * Show the application main page.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function login() {
            if(Auth::check())
                return redirect()->route('home');

            return view('pages.Auth.Oauth');
        }
    }
