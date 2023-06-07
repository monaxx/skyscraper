<?php
    function response($status, $statusMessage, $data){
        header('http/1.1 '.$status);
        // $response['status'] = $status;
        // $response['status_message'] = $statusMessage;
        $response['output'] = $data;
        $response_json = json_encode($response);
        echo $response_json;
    }
?>