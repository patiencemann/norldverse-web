<?php

    namespace App\XMLServices;

    use DOMNode;
    use DOMCdataSection;

    class NewsRssService extends XMLService {
        public function getXML(): string {
            $this->root('rss', [
                'version' => '2.0',
                'xmlns:atom' => 'http://www.w3.org/2005/Atom',
                'xmlns:content' => 'http://purl.org/rss/1.0/modules/content/',
                'xmlns:media' => 'http://search.yahoo.com/mrss/'
            ]);

            $this->element($this->root, 'channel', '', fn($node) => $this
                ->element($node, 'title', 'Patienceman Blogs')
                ->element($node, 'link', '', fn($node) => $node->appendChild(new DOMCdataSection(env('APP_URL'))))
                ->element($node, 'description', 'a web blog featuring JavaScript, PHP, vue js, Laravel, packages, and everything else for software development and also personal developments.')
                ->element($node, 'language', 'en')
                ->element($node, 'copyright', 'Copyright (C) 2023')
                ->element($node, 'atom:link', '', fn($node) => $this->attributes($node, [
                    'href' => 'https://api.phpfyi.local/rss/news',
                    'rel' => "self",
                    'type' => "application/rss+xml"
                ]))
            );

            array_map(
                fn (object $page) => $this->createEntry($this->root->firstChild, $page),
                $this->pages
            );

            $this->dom->appendChild($this->root);
            return $this->dom->saveXML();
        }

        /**
         * Its important to note the guid value here. This is used as the primary identifier
         * by Google for each entry in the feed. Once this value is set it should not be
         * changed unless you unpublished and re-submit your feed.
         */
        public function createEntry(DOMNode $node, object $page): void {
            $this->element($node, 'item', '', fn($node) => $this
                ->element($node, 'guid', $page->slug, fn($node) => $this->attributes($node, [ 'isPermaLink' => 'false']))
                ->element($node, 'title', $page->meta_title)
                ->element($node, 'link', $page->absolute_url)
                ->element($node, 'author', $page->author)
                ->element($node, 'category', $page->category)
                ->element($node, 'description', $page->meta_description)
                ->element($node, 'pubDate', date(DATE_RSS, strtotime($page->published_at)))
                ->element($node, 'content:encoded', '', fn($node) => $node->appendChild(new DOMCdataSection($page->html)))
                ->element($node, 'enclosure', '', fn($node) =>
                    $this->attributes($node, [
                        'url' => $page->image_url,
                    'type' => 'image/jpeg',
                    'length' => '0'
                ])
            )
        );
    }
    }
