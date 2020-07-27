<?php
namespace App\Helpers;
class ApiHelpers
{
    public static function createResponse($status, $message, $data=''){
        $result = [];
        
        if($status){
            $result['status'] = true;
            $result['message'] = $message;
            if (empty($data)) {
                $result['data'] = array();
            } else {
                $result['data'] = $data;
            }
        }else{
            $result['status'] = false;
            $result['message'] = $message;
            $result['data'] = 'Something Error';
            
        }

        return $result;
    }

    public static function formatDate($date = '', $format='Y-m-d'){
        
        if($date == ''){
            $date = date($format);
        }else{
            $date = date($format, strtotime($date));
        }

        return $date;
    }

    public static function formatCurrency($currecy, $type='IN'){
        $data = '';
        
        if($type == 'IN'){
            $data = number_format($currecy, 2, ',', '.');
        }else{
            $data = number_format($currecy, 2);
        }

        return $data;
    }

    public static function FLAG_INSERT($param){
        if($param){
            $message = __('general.successSave');
        }else {
            $message = __('general.failSave');
        }

        return $message;
    }

    public static function FLAG_UPDATE($param)
    {
        if ($param) {
            $message = __('general.successUpdate');
        } else {
            $message = __('general.failUpdate');
        }

        return $message;
    }

    public static function FLAG_RESULT($param){
        if (!$param->isEmpty()) {
            $message = __('general.noEmpty');
        } else {
            $message = __('general.emptyMessage');
        }

        return $message;
    }

    public static function FLAG_DELETE($param)
    {
        if ($param) {
            $message = __('general.successDelete');
        } else {
            $message = __('general.emptyMessage');
        }

        return $message;
    }
}
