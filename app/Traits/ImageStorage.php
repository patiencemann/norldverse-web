<?php

    namespace App\Traits;

    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;

    trait ImageStorage {
        public $prefix = 'norldverse_blogs_image_';

        /**
         * Upload given file to public/images
         *
         * @param UploadedFile $imageFile
         * @return UploadedFile $imageFile
         */
        public function storeImage($directory, $imageFile) {
            if(!$imageFile) return false;

            $md5Name = $this->prefix.md5_file($imageFile->getRealPath());
            $guessExtension = $imageFile->guessExtension();

            return $imageFile->storeAs($directory, $md5Name.'.'.$guessExtension, 'public');
        }

        /**
         * Upload given file to public/dir
         *
         * @param UploadedFile $imageFile
         * @return UploadedFile $imageFile
         */
        public function storeFile($dir, $imageFile) {
            if(!$imageFile) return false;

            $md5Name = $this->prefix.time().'_'.md5_file($imageFile->getRealPath());
            $guessExtension = $imageFile->guessExtension();

            return $imageFile->storeAs($dir, $md5Name.'.'.$guessExtension, 'public');
        }

        /**
         * Get full url of given file
         *
         * @param string imageFile
         * @return mixed
         */
        public function getImage($imageFile) {
            if(file_exists( public_path().$imageFile))
                return Storage::get($imageFile);
        }

        /**
         * delete image from storage
         *
         * @param string imageFile
         * @return mixed
         */
        public function deleteImage($imageFile) {
            if(file_exists( public_path().'/images/'.$imageFile))
                Storage::delete($imageFile);
        }
    }
