<?php

    class ImageUtils {
        public static function imageGenerateName() {
            return bin2hex(random_bytes(60)) . "jpg";
        }
    }