<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreDocCommentRequest;
    use App\Http\Resources\DocCommentResource;
    use App\Http\Resources\DocCommentUserResource;
    use App\Models\Doc;
    use App\Models\DocComment;
    use Illuminate\Http\Request;

    class DocCommentController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Doc $doc) {
            return DocCommentResource::collection(
                $doc->docComments()
                    ->orderBy('created_at', 'desc')
                    ->get()
            );
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function unique(Doc $doc, Request $request) {
            return DocCommentUserResource::collection(
                $doc->docComments()
                    ->distinct()
                    ->select('user_id')
                    ->take($request->count ?? 50)
                    ->get()
            );
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
                'message' => "Comment Created/Posted successfully"
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
                'message' => "Comment removed successfully"
            ]);
        }
    }
