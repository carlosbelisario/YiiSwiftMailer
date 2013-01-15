<?php 
namespace YiiSwiftMailer\YiiSwiftMailer;
/**	ICrugeMailer

	interfaz para el manejo de envio de correos

	si un componente del usuario requiere personalizar el envio de correos puede crear 
	un nuevo componente que implemente esta interfaz y extienda de CrugeMailer
	
	@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
    @author: carlos belisario <carlos.belisario.gonzalez@gmail.com>
	http://www.yiiframeworkenespanol.org/licencia
*/
interface YiiSwiftMailerInterface {

    /**
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
}
