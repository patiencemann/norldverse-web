<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreDocCommentRequest;
    use App\Http\Resources\DocCommentResource;
    use App\Models\Doc;
    use App\Models\DocComment;

    class DocCommentController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Doc $doc) {
            return DocCommentResource::collection($doc->docComments);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Doc $doc
         * @param  StoreDocCommentRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(Doc $doc, StoreDocCommentRequest $request) {
            $comment = $doc->docComments()->create(array_merge(
                ['user_id' => authUser()->id],
                $request->validated()
            ));

            return response()->json([
                'data' => DocCommentResource::make($comment),
                'message' => "Comment created successfully"
            ]);
        }

        /**
         * Display the specified resource.
         *
         * @param  DocComment $doc
         * @return \Illuminate\Http\Response
         */
        public function show(DocComment $comment) {
            return DocCommentResource::make($comment);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  DocComment  $doc
         * @return \Illuminate\Http\Response
         */
        public function destroy(DocComment $comment) {
            $comment->delete();
            
            return response()->json([
                'message' => "Doc Comment deleted successfully"
            ]);
        }
    }
