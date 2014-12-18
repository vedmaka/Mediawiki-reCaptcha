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

		$GLOBALS['wgExtensionCredits']['other'][] = array(
			'path' => __FILE__,
			'name' => 'reCaptcha',
			'author' => array( 'Vedmaka' ),
			'version' => '0.1',
			'url' => 'https://www.mediawiki.org/wiki/Extension:reCaptcha'
		);

		$GLOBALS['wgReCaptchaKey'] = '6LcRrP4SAAAAACtctRzBwqtlR412aZT3y-o0zWLv';
		$GLOBALS['wgReCaptchaSecret'] = '6LcRrP4SAAAAAI3HaHKJn7S7oB7ZVh9MGUM8cPkh';

		$hooksHandler = new reCaptchaHooks();

		//Protect account creation
		$GLOBALS['wgHooks']['UserCreateForm'][]         =
		$GLOBALS['wgHooks']['AbortNewAccount'][]        =
		//Protect content edition
		$GLOBALS['wgHooks']['PageContentSave'][]        = array( $hooksHandler );
		$GLOBALS['wgHooks']['EditPage::showEditForm:initial'][]   = array( $hooksHandler, 'onShowEditForm' );

	}

}