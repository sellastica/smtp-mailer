<?php
namespace Sellastica\SmtpMailer;

class NullMailer implements \Nette\Mail\IMailer
{
	/**
	 * @param \Nette\Mail\Message $message
	 */
	public function send(\Nette\Mail\Message $message): void
	{
	}
}
