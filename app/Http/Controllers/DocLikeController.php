<?php

    namespace App\Http\Controllers;

    use App\Models\Doc;

    class DocLikeController extends Controller {
        /**
         * Store a newly created resource in storage.
         *
         * @param  StoreDocRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(Doc $doc) {
            if(!$doc->likes()->where('user_id', authUser()->id)->exists())
                $doc->likes()->create(['user_id' => authUser()->id]);

            return response()->json(["message" => "Blog liked"]);
        }
    }
