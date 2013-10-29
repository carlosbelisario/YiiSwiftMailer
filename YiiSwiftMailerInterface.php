<?php 
//namespace YiiSwiftMailer;

/**
 *
 *
 */
interface YiiSwiftMailerInterface 
{
    /**
     *
     * @param String $text
     */
	public function t($text);

    /**
     * @method sendMail send the mail 
     * @param  string $body 
     * @param  array  $to 
     * @param  mixed $from  
     * @param  string $subject
     * @return boolean
     */
    public function sendEmail($body, array $to, array $from = null, $subject = '', $contentType = 'text/html', $attachment = null);

    /**
     *
     * 
     */
    public function getConfig();
}
