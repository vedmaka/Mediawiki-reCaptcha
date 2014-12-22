<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 18.12.2014
 * Time: 23:18
 */

namespace reCaptcha;

class reCaptcha {

	public static function setupExtension()
	{

		$GLOBALS['wgMessagesDirs']['Recaptcha'] = __DIR__ . '/../i18n';
		$GLOBALS['wgMessagesDirs']['reCaptcha'] = __DIR__ . '/../i18n';

		$GLOBALS['wgExtensionCredits']['antispam'][] = array(
			'path' => __FILE__,
			'name' => 'reCaptcha',
			'author' => array( 'Vedmaka' ),
			'version' => '0.1',
			'url' => 'https://www.mediawiki.org/wiki/Extension:reCaptcha',
			'descriptionmsg' => 'recaptcha-desc',
			'license-name' => 'GPL-2.0+'
		);

		//Configuration variables
		$GLOBALS['wgReCaptchaKey'] = '';
		$GLOBALS['wgReCaptchaSecret'] = '';

		$hooksHandler = new reCaptchaHooks();

		//Protect account creation
		$GLOBALS['wgHooks']['UserCreateForm'][]         =
		$GLOBALS['wgHooks']['AbortNewAccount'][]        =
		//Protect content edition
		$GLOBALS['wgHooks']['PageContentSave'][]        = array( $hooksHandler );
		$GLOBALS['wgHooks']['EditPage::showEditForm:initial'][]   = array( $hooksHandler, 'onShowEditForm' );

	}

}
