<?php

namespace Sellastica\SmtpMailer;

class DisplayMailer implements \Nette\Mail\IMailer
{

	/**
	 * @param \Nette\Mail\Message $message
	 */
	public function send(\Nette\Mail\Message $message): void
	{
		echo $message->getHtmlBody();
		exit;
	}
}
