<?php

class master {

    private static $_json = 'application/json';

    private static function status($data) {
        if(!empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    private static function statusSaved($data) {
        if($data) {
            return label::$savedSuccess;
        } else {
            return label::$savedFailed;
        }
    }

    private static function statusDeleted($data) {
        if($data) {
            return label::$deletedSuccess;
        } else {
            return label::$deletedFailed;
        }
    }

    private static function statusUpdated($data) {
        if($data) {
            return label::$updatedSuccess;
        } else {
            return label::$updatedFailed;
        }
    }

    private static function statusCode($data) {
        if($data) {
            return 200;
        } else {
            return 500;
        }
    }

    private static function responseData($errStatus = '', $dataRes = '', $recordRows = '', $recordsFiltered = '') {
        return array('error' => $errStatus, 'recordsTotal' => $recordRows, 'recordsFiltered' => $recordsFiltered, 'data' => $dataRes);
    }

    public static function returnJson($data)
    {
        $CI =& get_instance();
        $response = self::responseData(self::status($data->num_rows()), $data->result_object(), $data->num_rows(), $data->num_rows());
        
        if(!empty($data)) {
            return self::setResponse($response, 200, self::$_json);
        } else {
            return self::setResponse($response, 500, self::$_json);
        }
    }

    public static function setResponse($response = '', $code = '', $type_data = '')
    {
        $CI =& get_instance();
        return $CI->output
                ->set_status_header($code)
                ->set_content_type($type_data, 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public static function responseGetData($table = '') 
    {
        $CI =& get_instance();
        $CI->load->model(array('master_model'));

        $data = $CI->master_model->getAll($table);
        return self::returnJson($data);
    }

    public static function saveData($data = array(), $table = '')
    {
        $CI =& get_instance();
        $CI->load->model(array('master_model'));

        $status_saved   = $CI->master_model->save($data, $table);
        $response       = self::responseData(!$status_saved, self::statusSaved($status_saved) );

        return self::setResponse($response, self::statusCode($status_saved), self::$_json);
    }

    public static function deleteData($data = array(), $table = '') 
    {
        $CI =& get_instance();
        $CI->load->model(array('master_model'));

        $status_deleted     = $CI->master_model->delete($data, $table);
        $response           = self::responseData(!$status_deleted, self::statusDeleted($status_deleted));

        return self::setResponse($response, self::statusCode($status_deleted), self::$_json);
    }

    public static function getDataById($data = array(), $table = '')
    {
        $CI =& get_instance();
        $CI->load->model(array('master_model'));

        $data       = $CI->master_model->getById($data, $table);
        $response   = self::responseData(self::status($data->num_rows()),$data->result(), '', '');

        return self::setResponse($response, self::statusCode($data), self::$_json);
    }

    public static function updateData($data = array(), $condition = array(), $table = '') 
    {
        $CI =& get_instance();
        $CI->load->model(array('master_model'));

        $status_update  = $CI->master_model->update($data, $condition, $table);
        $response       = self::responseData(self::status($status_update), self::statusUpdated($status_update), '', '');

        return self::setResponse($response, self::statusCode($status_update), self::$_json);
    }
}