<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php");

use Mailgun\Mailgun;

class Mail
{

    public function send()
    {
        $mg = Mailgun::create('3763de7242e916b27489343a1afa0852-9b463597-1582836f');
        $mg->messages()->send('sandboxb6fdb4d5db954483a26b5b4e6ae22b11.mailgun.org', [
            'from' => 'bob@example.com',
            'to' => 'philip@kedrasoft.com',
            'subject' => 'The PHP SDK is awesome!',
            'text' => 'It is so simple to send a message.'
        ]);
    }

}