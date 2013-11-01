YiiSwiftMailer
==============

Is a wrapper for implement the library <a href="https://github.com/swiftmailer/swiftmailer">swiftmailer</a> to YiiFramework.

This library is based in the <a href="https://github.com/yiiframeworkenespanol/crugemailer">crugemailer</a> extesión.

The motive for the creation of this extensión is the problems, when include  the class when is used the versión of CrugeSwiftMailer and is used the extensión cruge (the user manager).


<b>Install</b>

clone this repository in the folder extensions in a application YiiFramework 


git clone https://github.com/carlosbelisario/YiiSwiftMailer.git

active the submodule swiftmailer

git submodule init 
git submodule update

add in the config/main.php file of the application this lines

<pre>
'import'=>array(
    'application.models.*',
    'application.components.*',
    'application.extensions.YiiSwiftMailer.src.*',
),

'components'=>array(
    //others component config
    'mailer'=>array(
        'class' => 'application.extensions.YiiSwiftMailer.YiiSwiftMailer',
        'mailfrom' => 'tucorreo@dominio.com',
        'transport' => 'gmail', // gmail para usar el stmp de gmail (recomendado), no especificarlo trabajara la librería con la función mail de php
        /**
         *
         * obligatorios si el transporte es un smtp
         */
        'user' => 'carlos.belisario.gonzalez@gmail.com',
        'password' => 'pasword stmp user', // this case  is the password of gmail
        'port' => 25,
        'subjectprefix' => 'Prefijo que deseas agregar, es opcional - ',
    ),
),
</pre>
 <b> usage</b>

<pre>
 Yii::app()->mailer->sendEmail(
    'body of the message',
    array('carlos.belisario.gonzalez@gmail.com'), // to
    array('contac@midominio.com'), //from optional
    'Asunto del Correo Electrónico' //subject optional
); 
</pre>

the sendMail method of YiiSwiftMailer class has the following structure

public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null)

the params are 
$body: the body of the message
$to: a array with the addressee
$from: optional if not defined is taked from the config
$subject: optional the subject of the message.
$contentType: optional, default text/html
$attachment: paht to the file




