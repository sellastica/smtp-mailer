<?php
namespace Sellastica\SmtpMailer;


class SmtpMailer extends \Nette\Mail\SmtpMailer implements \Nette\Mail\IMailer
{
	const MODE_SEND = 'send', //send email in standard way
		MODE_DISPLAY = 'display'; //display email in the browser

	/** @var string */
	private $mode = self::MODE_SEND;


	/**
	 * @param array $options
	 * @throws \InvalidArgumentException
	 */
	public function __construct(array $options = [])
	{
		if (isset($options['mode'])
			&& !in_array($options['mode'], [self::MODE_DISPLAY, self::MODE_SEND])) {
			throw new \InvalidArgumentException('Invalid mailer mode (neither send nor display), check config.neon');
		}

		$this->mode = $options['mode'] ?? self::MODE_SEND;
		parent::__construct($options);
	}

	/**
	 * @param \Nette\Mail\Message $message
	 * @throws \Sellastica\SmtpMailer\Exception\MailException
	 */
	public function send(\Nette\Mail\Message $message)
	{
		//set additional parameters
		if (!$message->getFrom()) {
			throw new Exception\MailException('Sender (from) is not set.');
		}

		if (!$message->getReturnPath()) {
			$message->setReturnPath(key($message->getHeader('From')));
		}

		//do not send but display in browser
		if ($this->mode === self::MODE_DISPLAY) {
			echo $message->getHtmlBody();
			exit;
		}

		parent::send($message);
	}
}
