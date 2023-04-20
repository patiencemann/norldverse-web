<?php

    namespace App\Observers;

    use App\Models\Doc;
    use Illuminate\Support\Str;

    class DocObserver {
        /**
         * Handle the Doc "created" event.
         *
         * @param  \App\Models\Doc  $doc
         * @return void
         */
        public function created(Doc $doc) {
            $doc->slug = generateSlug($doc->id, $doc->title);
            $doc->save();
        }
    }
