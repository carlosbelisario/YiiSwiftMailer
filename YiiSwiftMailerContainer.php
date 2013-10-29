<?php
//namespace YiiSwiftMailer;

//import the lib swiftmailer
require_once 'swiftmailer/lib/swift_required.php';

/**
*
* class SwiftMailerContainer container for the lib swiftmailer
* @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
* @version 1.0
*/
class YiiSwiftMailerContainer 
{
    /**
     * 
     * @var array $config
     */
    private $config;

    /**
     *
     * construct of the class
     * @param mixed $config array with the config of the class / null for the use of mail() function of php
     */
    public function __construct(array $config = null) 
    {
        spl_autoload_unregister(array('YiiBase', 'autoload')); // Disable Yii autoloader for use the SwiftMailer				
        $this->config = $config;
    }

    /**
     *	 
     * setter of the config transpor
     * @param array $config   
     * @param boolean $override 
     */
    public function setConfig(array $config = null, $override = true)
    {
        if ($override) {
            $this->config = $config;
        }  else {
            $this->config = !empty($this->config) ? array_merge($this->config = $config) : $config;
        }
        return $this;
    }

    /**
     * @method getTransport return the transport of the mail 
     * By default this class return the function mail() of php transport
     * @param  array $config array with the configurations for the transport of the mail
     * @return Swift_SendmailTransport
     */
    protected function getTransport($config)
	{
        if ('gmail' == $config['transport']) {
            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
                ->setUsername($config['mail'])
                ->setPassword($config['password']);
        } elseif (null === $config) {
            $transport = Swift_MailTransport::newInstance();
        } else {
        	//for test
            $transport = Swift_SendmailTransport::newInstance($config['smtp'], $config['port'], 'ssl')
                ->setUsername($config['mail'])
                ->setPassword($config['password']);
        }
        return $transport;
    }

    /**
     * @method getMailer return the mailer object for send the email
     * @param  array $config array with the configurations for the transport of the mail
     * @return Swift_Mailer
     */
    public function getMailer()
    {
        try {
            return Swift_Mailer::newInstance($this->getTransport($this->config));
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * 
     * @param  string $suject 
     * @return Swift_Message
     */
    public function getMessenger($suject = '')
    {		
        return Swift_Message::newInstance($suject);
    }

    /**
     *
     * @param  string $path 
     * @return Swift_Attachment
     */
    public function getAttachmenter($path)
    {
        return Swift_Attachment::fromPath($path);
    }
}
