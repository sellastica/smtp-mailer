<?php

namespace Sellastica\SmtpMailer;

class Message extends \Nette\Mail\Message
{

	/**
	 * @var \Nette\Application\UI\ITemplate|null
	 */
	private $template;

	/**
	 * @var array
	 */
	private $attachmentPaths = [];

	/**
	 * Adds attachment.
	 * @param string
	 * @param string
	 * @param string
	 * @return $this
	 */
	public function addAttachment($file, $content = null, $contentType = null): Message
	{
		parent::addAttachment($file, $content, $contentType);
		if (is_null($content)) {
			$this->attachmentPaths[] = $file;
		}

		return $this;
	}

	/**
	 * @param array $attachments
	 * @return $this
	 */
	public function addAttachments(array $attachments): Message
	{
		foreach ($attachments as $path) {
			$this->addAttachment($path);
		}

		return $this;
	}

	/**
	 * @return array
	 */
	public function getAttachmentPaths(): array
	{
		return $this->attachmentPaths;
	}

	/**
	 * @param array $headers
	 * @return $this
	 */
	public function setHeaders(array $headers): Message
	{
		foreach ($headers as $key => $value) {
			$this->setHeader($key, $value);
		}

		return $this;
	}

	/**
	 * @param \Nette\Application\UI\ITemplate|null $template
	 * @return $this
	 */
	public function setTemplate(?\Nette\Application\UI\ITemplate $template): Message
	{
		$this->template = $template;
		return $this;
	}

	/**
	 * @return \Nette\Application\UI\ITemplate|null
	 */
	public function getTemplate(): \Nette\Application\UI\ITemplate
	{
		return $this->template;
	}

	/**
	 * @return array
	 */
	public function getTo(): array
	{
		return $this->getHeader('To')
			? (array) $this->getHeader('To')
			: [];
	}

	/**
	 * @return $this
	 */
	public function clearTo(): Message
	{
		$this->setHeader('To', []);
		return $this;
	}

	/**
	 * @return array
	 */
	public function getCc(): array
	{
		return $this->getHeader('Cc')
			? (array) $this->getHeader('Cc')
			: [];
	}

	/**
	 * @return $this
	 */
	public function clearCc(): Message
	{
		$this->setHeader('Cc', []);
		return $this;
	}

	/**
	 * @return array
	 */
	public function getBcc(): array
	{
		return $this->getHeader('Bcc')
			? (array) $this->getHeader('Bcc')
			: [];
	}

	/**
	 * @return $this
	 */
	public function clearBcc(): Message
	{
		$this->setHeader('Bcc', []);
		return $this;
	}
}
