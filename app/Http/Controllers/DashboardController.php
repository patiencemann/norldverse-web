<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class DashboardController extends Controller {
        /**
         * Return dashboard view controller
         */
        public function index() {
            return view('pages.Auth.dashboard');
        }

        /**
         * Return dashboard view controller
         */
        public function writeDoc() {
            return view('pages.Auth.write');
        }
    }
