<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreDocRequest;
    use App\Http\Resources\DocResource;
    use App\Models\Doc;
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function public() {
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
            $imageFile = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                $options = array('public_id' => 'patienceman-docs/' . $request->image)
            )->getSecurePath();

            $doc = authUser()->docs()->create($request->validated());
            $doc->docMedia()->create([ 'file_url' => $imageFile ]);

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
            return view('pages.auth.update-doc', compact('doc'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function update(StoreDocRequest $request, Doc $doc) {
            $imageFile = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                $options = array('public_id' => 'patienceman-docs/' . $request->image)
            )->getSecurePath();

            $doc->update($request->validated());
            $doc->docMedia()->update([ 'file_url' => $imageFile ]);

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
