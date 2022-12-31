<?php
    namespace App\Libraries;

    class FirebaseWrapper {

        private static $instance = null;
        private static $firebase;
        private static $bucket;
        private static $uuid;

        function __construct() {
            self::$uuid = service('uuid');
            self::$firebase = service('firebase');
            self::$bucket = self::$firebase->storage->getBucket();
        }

        static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new FirebaseWrapper();
            }

            return self::$instance;
        }

        function upload($_params, $destination = 'files') {
            if (empty($_params)) {
                return;
            }

            $_result = self::$bucket->uploadAsync(
                fopen($_params->getTempName(), 'r+'),
                [
                    'name' => $destination . '/' . time() . '_' . $_params->getName(),
                    'predefinedAcl' => 'publicRead',
                    'metadata' => [
                        'metadata' => [
                            'firebaseStorageDownloadTokens' => self::$uuid->uuid4(),
                        ]
                    ],
                ]
            );

            $_result = $_result->wait();
            return $_result;
        }

        function uploads($_params = []) {
            $_result = [];
            foreach($_params as $param) {
                array_push($_result, $this->upload($param));
            }

            return $_result;
        }

        function retrieve($_params) {
            if (empty($_params)) {
                return;
            }

            $object = self::$bucket->object($_params);
            return $object->info();
        }

        function retrieves($_params = []) {
            $_result = [];
            foreach($_params as $param) {                
                array_push($_result, $this->retrieve($param));
            }

            return $_result;
        }

        function remove($_params) {
            if (empty($_params)) {
                return;
            }

            $object = self::$bucket->object($_params);
            $object->delete();
            return $object;
        }

        function removes($_params = []) {
            $_result = [];
            foreach($_params as $param) {
                array_push($_result, $this->remove($param));
            }

            return $_result;
        }
    }
