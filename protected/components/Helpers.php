<?php
    class Helpers {
        public static function toAlias($content) {
            $content = mb_strtolower($content, 'utf-8');
            $from = array('à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
				'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
				'ì','í','ị','ỉ','ĩ',
				'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ',
				'ờ','ớ','ợ','ở','ỡ',
				'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
				'ỳ','ý','ỵ','ỷ','ỹ',
				'đ');
            $to = array('a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
				'e','e','e','e','e','e','e','e','e','e','e',
				'i','i','i','i','i',
				'o','o','o','o','o','o','o','o','o','o','o','o',
				'o','o','o','o','o',
				'u','u','u','u','u','u','u','u','u','u','u',
				'y','y','y','y','y',
				'd');
            $content = str_ireplace($from, $to, $content);
            $content = preg_replace('%[^a-z0-9\s-]%isx','', $content);
            $content = preg_replace('%\s+%isx','-', $content);
            $content = preg_replace('%-+%isx','-', $content);
            return $content;
        }
        
        public static function isFullLink($link){
            return preg_match('%^http%isx',$link);
        }
    }
    