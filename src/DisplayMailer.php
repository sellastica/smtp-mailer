<?php
namespace Sellastica\SmtpMailer;

class DisplayMailer implements \Nette\Mail\IMailer
{
	/**
	 * @param \Nette\Mail\Message $message
	 */
	public function send(\Nette\Mail\Message $message)
	{
		echo $message->getHtmlBody();
		exit;
	}
}
