<?php

namespace Sellastica\SmtpMailer;

class SmtpMailer extends \Nette\Mail\SmtpMailer implements \Nette\Mail\IMailer
{

	/**
	 * @param \Nette\Mail\Message $message
	 */
	public function send(\Nette\Mail\Message $message): void
	{
		if (!$message->getFrom()) {
			throw new \Nette\Mail\SendException('Sender (from) is not set.');
		}

		//set additional parameters
		if (!$message->getReturnPath()) {
			$message->setReturnPath(key($message->getHeader('From')));
		}

		parent::send($message);
	}
}
