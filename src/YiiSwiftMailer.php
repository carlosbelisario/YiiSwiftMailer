<?php 
//namespace YiiSwiftMailer\src;

//use application\extensions\YiiSwiftMailer\YiiSwiftMailerBase;
//use application\extensions\YiiSwiftMailer\YiiSwiftMailerException;
//use application\extensions\YiiSwiftMailer\YiiSwiftMailerInterface;

/**
*
* class YiiSwiftMailer
* @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
* @version 1.1 
*/
class YiiSwiftMailer extends YiiSwiftMailerBase implements YiiSwiftMailerInterface
{
    /**
     * 
     * @var SwiftMailerContainer $container
     */
    private $container;

    /**
     *
     * @var string
     */
    public $transport;

    /**
     * 
     * @var email
     */
    public $user;

    /**
     * 
     * @var string
     */
    public $password;

    /**
     *
     * @var integer 
     */
    public $port;

    /**
     * 
     * @override
     */
    public function init()
    {		
        parent::init();
        $this->container = new YiiSwiftMailerContainer($this->getConfig());								 				
    }

    /**
     * getConfig 
     * @return Array
     * @throws YiiSwiftMailerException if the mail format is wrong
     */
    public function getConfig() 
    {
        if (isset($this->user)) {
            if (!filter_var($this->user, FILTER_VALIDATE_EMAIL)) {
                throw new YiiSwiftMailerException($this->t('Error: mail format wrong'));
            } else {
                $this->user = filter_var($this->user, FILTER_VALIDATE_EMAIL);
            }
        }
        if (!isset($this->transport)) {
            $config = null;
        } else {            
            $config = array(
                'transport' => $this->transport,
                'mail' =>  isset($this->user) ? $this->user : null,
                'password' => isset($this->password) ? $this->password : null,
                'port' => isset($this->port) ? $this->port : null,
            );
        }
        return $config;
    }

    /**
     * @method sendMail send the mail 
     * @param  string $body 
     * @param  array  $to 
     * @param  mixed $from  
     * @param  string $subject
     * @param string $contentType
     * @param string $attachment
     * @return boolean     
     */
    public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null)
    {        
        if (empty($from)) {
            $from = array($this->mailfrom);
        }
        if (is_null($attachment)) {
            $message = $this->container->getMessenger($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body, $contentType);
        } else {
            $attachmentFile = $this->container->getAttachmenter($attachment);
            $message = $this->container->getMessenger($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body, $contentType)
                ->attach($attachmentFile);
        }        
        echo "sia";
        $result = $this->container->getMailer()->send($message);        
        echo "<br /> no";
        spl_autoload_register(array('YiiBase', 'autoload')); // register Yii autoload
        if ($result) {
            return $result;
        } else {            
            throw new YiiSwiftMailerException($this->t('Error: mail configuration is wrong'));
        }
    }

    public function t($text)
    {
        return Yii::t($text);
    }
    
   
}
