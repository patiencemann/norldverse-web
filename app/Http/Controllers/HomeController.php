<?php

    namespace App\Http\Controllers;

    use App\Models\Doc;
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
        public function singleDoc(Doc $doc) {
            return view('pages.single-doc', compact('doc'));
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
