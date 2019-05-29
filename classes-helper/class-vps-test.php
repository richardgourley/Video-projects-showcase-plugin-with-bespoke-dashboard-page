<?php

class VPS_Helper{
    
    public function __construct(){
        //constructor logic
    }

    public function check_field_filled( $var, $name, $type ){
        if($var === '' && $type == 'radio'){
            return "<br />$name must be selected.";
        }else if($var === '' && $type == 'text'){
            return "<br />$name field must not be blank.";
        }else{
            return '';
        }
    }

    public function is_a_number( $var, $name){
        if(!is_numeric( $var )){
            return "<br />$name entered is not a number.";
        }else{
            return '';
        }
    }
    
    public function check_date_validity( $date ){
    
        if($date === ''){
            return "<br />Date field must not be blank";
        }

        $date_arr = explode( '-', $date);

        if(!strlen($date_arr[0]) == 4 || preg_match('/[a-z@,!]/i', $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        if(!wp_checkdate($date_arr[1], $date_arr[2], $date_arr[0], $date)){
            return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
        }
    
        return '';
    }

    public function check_only_letters( $country ){
        //country field is blank already checked, ok if blank
        if(preg_match('/^[a-z\s]+$/i', $country) || $country === ''){
            return '';
        }else{
            return "<br />Country field can only contain letters.";
        }
    }

    public function first_letter_upper( $str ){
        $str[0] = strtoupper($str[0]);
        return $str;
    }

    public function get_vimeo_id( $vimeo_url ){
        $video_id = $vimeo_url;
        $vid_arr = explode('/', $video_id);
        return $vid_arr[(count($vid_arr)-1)];
    }

    public static function test_class_function(){
        echo "Hello world";
    }

    public function convert_date_to_month_year( $date ){
        $new_date = date("F Y", strtotime( $date ));
        return $new_date;
    }
}