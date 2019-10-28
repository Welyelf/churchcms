<?php defined('BASEPATH') OR exit('No direct script access allowed');

function parser($template, $data)
{
    preg_match_all('#\{(.*?)\}#', $template, $matches);

    foreach ($matches[1] as $match) {
        $tmp = explode(":", $match);
        $index = $tmp[0];
        $field = $tmp[1];
        $template = str_replace("{" . $match . "}", $data[$index]->$field, $template);
    }

    return $template;
}

function send_mail($to, $from = "welyelf@kedrasoft.com", $subject, $message)
{
    $CI = &get_instance();

    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

    set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/share/pear" . PATH_SEPARATOR . get_include_path());


    //set_include_path("/home/kedradev/pear/share/pear");
    require_once "Mail.php";

    $host = "ssl://smtp.gmail.com";
    $username = "welyelf@kedrasoft.com";
    $password = "weynia_07";
    $port = "465";
    $email_from = $CI->config->item('admin_email');
    $email_subject = $subject;
    $email_body = $message;
    $email_address = $from;

    $headers = array('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
    $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
    $mail = $smtp->send($to, $headers, $email_body);

    $conn->close();

    if (PEAR::isError($mail)) {
        echo("<p>" . $mail->getMessage() . "</p>");
    } else {
        return true;
    }

}