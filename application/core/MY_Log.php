<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Log extends CI_Log
{

    function __construct($config = array())
    {
        parent::__construct($config);
    }

    function write_log($level = 'error', $msg, $data = FALSE, $php_error = FALSE)
    {

        $result = parent::write_log($level, $msg, $php_error);

        if (isset($_SERVER['SERVER_NAME'])) {
            include(APPPATH . 'config/database.php');
            $db = $db[$active_group];
            $conn = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);

            $settings = array();

            $sql = "SELECT * FROM settings";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()) {
                $settings[$row['name']] = $row['value'];
            }

            $to = 'philip@kedrasoft.com, welyelf@kedrasoft.com';
            $subject = "[{$settings['site_name']}] An error has occurred";
            $headers = "From: {$settings['site_name']} CMS <noreply@kedrasoft.com> \r\n";
            $headers .= 'Content-type: text/plain; charset=utf-8\r\n';

            if ($result == TRUE && strtoupper($level) == 'ERROR') {
                $stack_trace = print_r(debug_backtrace(), true);

                $message = "An error occurred: \n\n";
                $message .= $level . ' - ' . date($this->_date_fmt) . ' --> ' . $msg . "\n";
                $message .= $stack_trace;

                if ($data != FALSE) {
                    $message .= "\n\nData:\n\n{$data}";
                }

                if (ENVIRONMENT != 'development') {
                    mail($to, $subject, $message, $headers);
                }
            }

            if ($result == TRUE && (strtoupper($level) == 'ERROR' || strtoupper($level) == 'DEBUG')) {
                if ($conn->connect_error) {
                    if (ENVIRONMENT != 'development')
                        mail($to, $subject, "Connection failed: {$conn->connect_error}", $headers);

                } else {

                    $level = mysqli_real_escape_string($conn, $level);
                    $msg2 = mysqli_real_escape_string($conn, $msg);
                    $php_error = mysqli_real_escape_string($conn, $php_error);
                    $time = time();
                    $stack_trace = '';

                    $server_data = json_encode($_SERVER);

                    if (strtoupper($level) == 'ERROR') {
                        $stack_trace = json_encode(debug_backtrace());
                    }

                    if (!isset($_SERVER['HTTP_REFERER'])) {
                        $_SERVER['HTTP_REFERER'] = "";
                    }

                    $sql = "INSERT INTO logs (level, message, php_error, data, request_uri, user_agent, referer, stack_trace, ip_address, datetime) 
                            VALUES ('{$level}', '{$msg2}', '{$php_error}', '{$data}', '{$_SERVER['REQUEST_URI']}', '{$_SERVER['HTTP_USER_AGENT']}', '{$_SERVER['HTTP_REFERER']}', '{$stack_trace}', '{$_SERVER['REMOTE_ADDR']}', '{$time}')";

                    if ($conn->query($sql) !== TRUE) {
                        mail($to, $subject, "Error: {$sql} <br> {$conn->error}", $headers);
                    }

                }

                $conn->close();
            }
        }


        return $result;
    }
}