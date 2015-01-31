<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 19.12.2014
 * Time: 0:26
 */

namespace reCaptcha;

class reCaptchaHooks {

	public function onUserCreateForm( \UsercreateTemplate &$template )
	{
		$template->set( 'header', $this->installHtml() );
		return true;
	}

	/**
	 * @param \User  $u
	 * @param string $message
	 *
	 * @return bool
	 */
	public function onAbortNewAccount( $u, &$message )
	{

		if( !$this->testResponse() ) {
			$message = wfMessage("recaptcha-failed")->text();
			return false;
		}

		return true;
	}

	/**
	 * @param \EditPage   $editPage
	 * @param \OutputPage $output
	 *
	 * @return bool
	 */
	public function onShowEditForm( $editPage, $output )
	{

		if( !$output->getUser()->isEmailConfirmed() ) {
			$editPage->editFormTextBeforeContent .= $this->installHtml();
		}

		return true;
	}

	/**
	 * @param $wikiPage
	 * @param \User $user
	 * @param $content
	 * @param $summary
	 * @param $isMinor
	 * @param $isWatch
	 * @param $section
	 * @param $flags
	 * @param \Status $status
	 *
	 * @return bool
	 */
	public function onPageContentSave( $wikiPage, $user, $content, $summary,
		$isMinor, $isWatch, $section, $flags, $status )
	{

		if( $user && !$user->isEmailConfirmed() ) {
			if( !$this->testResponse() ) {
				$status->setResult(false);
				$status->error("recaptcha-failed");
				return false;
			}
		}

		return true;
	}

	private function installHtml()
	{
		global $wgOut, $wgReCaptchaKey;

		if( !$wgReCaptchaKey ) {
			//In case owner forgot to setup keys we bypass all checks
			return '';
		}

		$wgOut->addHeadItem('recaptcha',"<script src='https://www.google.com/recaptcha/api.js' async defer></script>");

		$html = "<div style='padding: 10px 0 10px 0;' class='recaptcha'>" .
		        '<div class="g-recaptcha" data-sitekey="'.$wgReCaptchaKey.'"></div>' .
		        "</div>";

		return $html;
	}

	private function testResponse($response = '')
	{
		global $wgReCaptchaSecret, $wgRequest;

		if( !$wgReCaptchaSecret ) {
			//In case owner forgot to setup keys we bypass all checks
			return true;
		}

		if( !$response ) {
			$response = $wgRequest->getVal('g-recaptcha-response');
			if( !$response ) {
				return false;
			}
		}

		$result = file_get_contents(
			'https://www.google.com/recaptcha/api/siteverify'
			.'?secret='.$wgReCaptchaSecret
			.'&response='.$response
			.'&remoteip='.$_SERVER['REMOTE_ADDR']
		);

		$result = json_decode($result, true);

		if( !$result ) {
			return false;
		}

		if( !array_key_exists('success', $result) || $result['success'] != 'true' || !$result['success'] ) {
			return false;
		}

		return true;
	}

}
