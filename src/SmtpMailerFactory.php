<?php
namespace Sellastica\SmtpMailer;

/**
 * SMTP Mailer factory for client use
 * Do not you for internal purposes!
 */
class SmtpMailerFactory
{
	/** @var \Sellastica\Project\Model\SettingsAccessor */
	private $settingsAccessor;
	/** @var array */
	private $options;

	/**
	 *
	 * @param array $options
	 * @param \Sellastica\Project\Model\SettingsAccessor $settingsAccessor
	 */
	public function __construct(
		array $options, 
		\Sellastica\Project\Model\SettingsAccessor $settingsAccessor
	)
	{
		$this->options = $options;
		$this->settingsAccessor = $settingsAccessor;
	}

	/**
	 * @return SmtpMailer
	 */
	public function create(): SmtpMailer
	{
		$settings = $this->settingsAccessor->get();
		$ownSmtp = (bool)$settings->getSetting('smtp.use_own_smtp');
		$options = [
			'host' => $ownSmtp ? $settings->getSetting('smtp.host') : ($this->options['host'] ?? null),
			'port' => $ownSmtp ? $settings->getSetting('smtp.port') : ($this->options['port'] ?? null),
			'username' => $ownSmtp ? $settings->getSetting('smtp.username') : ($this->options['username'] ?? null),
			'password' => $ownSmtp ? $settings->getSetting('smtp.password') : ($this->options['password'] ?? null),
			'secure' => $ownSmtp ? $settings->getSetting('smtp.secure') : ($this->options['secure'] ?? null),
			'mode' => $this->options['mode'] ?? SmtpMailer::MODE_SEND,
		];
		return new SmtpMailer($options);
	}
}
