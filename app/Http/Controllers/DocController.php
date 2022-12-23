<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreDocRequest;
    use App\Http\Resources\DocResource;
    use App\Models\Doc;

    class DocController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            return DocResource::collection(
                Doc::where('status', true)->orderBy('created_at', 'desc')->get()
            );
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  StoreDocRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(StoreDocRequest $request) {
            $doc = authUser()->docs()->create($request->validated());

            return response()->json([
                'data' => DocResource::make($doc),
                'message' => "Doc created successfully"
            ], 200);
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function show(Doc $doc) {
            return DocResource::make($doc);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function edit(Doc $doc) {
            return view('pages.update-doc', compact('doc'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function update(StoreDocRequest $request, Doc $doc) {
            $doc = $doc->update($request->validated());

            return response()->json([
                'data' => DocResource::make($doc),
                'message' => 'Doc updated successfully'
            ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function destroy(Doc $doc) {
            $doc->delete();
            
            return response()->json([
                'message' => 'Doc deleted successfully'
            ]);
        }
    }
