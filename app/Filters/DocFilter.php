<?php
    namespace App\Filters;

    use Patienceman\Filtan\QueryFilter;

    class DocFilter extends QueryFilter {
        /**
         * Filter docs by tags/topics
         * @param string tag
         */
        public function tag($tag) {
            if($tag != "all") {
                $this->builder->whereIn('id', function($query) use ($tag){
                    $query->select('doc_id')
                        ->from('doc_topics')
                        ->whereJsonContains('topics', $tag);
                });
            }
        }

        /**
         * Filter docs by search query
         * @param string query
         */
        public function query($query) {
            $this->builder->where('title', 'LIKE', '%'.$query.'%')
                        ->orWhere('caption', 'LIKE', '%'.$query.'%')
                        ->orWhere('contents', 'LIKE', '%'.$query.'%');
        }
    }

