<?php


// Create the Transport
$transport = (new Swift_SmtpTransport('localhost', 25))
->setUsername('root')
->setPassword('')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
->setFrom(['bulich.i@finfort.ru' => 'John Doe'])
->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
->setBody('Here is the message itself', 'text/html')
;

// Send the message
$result = $mailer->send($message);

