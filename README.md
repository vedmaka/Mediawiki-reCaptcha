## reCaptcha extension for MediaWiki

![reCaptcha extension for Mediawiki](https://upload.wikimedia.org/wikipedia/mediawiki/4/42/Extension_recaptcha_1.png)

reCaptcha extension that simply integrate google new reCaptcha into Mediawiki.

On Packagist:
[![Latest Stable Version](https://poser.pugx.org/mediawiki/recaptcha/version.png)](https://packagist.org/packages/mediawiki/recaptcha)
[![Latest Stable Version](https://poser.pugx.org/mediawiki/recaptcha/d/total.png)](https://packagist.org/packages/mediawiki/recaptcha)

## Requirements

* [PHP](http://www.php.net) 5.1 or later
* [MediaWiki](https://www.mediawiki.org) 1.22 or later
* Installation via [Composer](http://getcomposer.org/)

## Installation

The recommended way to install the reCaptcha extension is with [Composer](http://getcomposer.org) using
[MediaWiki 1.22 built-in support for Composer](https://www.mediawiki.org/wiki/Composer). MediaWiki
versions prior to 1.22 can use Composer via the
[Extension Installer](https://github.com/JeroenDeDauw/ExtensionInstaller/blob/master/README.md)
extension.

##### Step 1

If you have previously installed Composer skip to step 2.

To install Composer:

    wget http://getcomposer.org/composer.phar

##### Step 2
    
Now using Composer, install reCaptcha.

If you do not have a composer.json file yet, copy the composer-example.json file to composer.json. If you
are using the ExtensionInstaller, the file to copy will be named example.json, rather than composer-example.json. When this is done, run:
    
    php composer.phar require mediawiki/recaptcha "@dev"

##### Verify installation success

Go to Special:Version and see if "reCaptcha" is listed there. If it is, you successfully installed it!

## Configuration

If you do not have any reCaptcha keys, you should go to [reCaptcha site](https://www.google.com/recaptcha) and receive own keys for your domain name.
After this step, you should open LocalSettings.php file in your Mediawiki installation directory and add few lines to bottom of file:

    $wgReCaptchaKey = 'your-recaptcha-key';
    $wgReCaptchaSecret = 'your-recaptcha-secret';
    
Where *your-recaptcha-key* and *your-recaptcha-secret* should be replaced with your actual values.

## Usage

Navigate to account creation page (you should be logged-out from your account), you should see reCaptcha there.
Also, this extension will ask users to fill captcha on page edit, **if user did not confirmed email address** yet.

## Release notes

### 0.1 (under development)

* Initial release

## Links

* [reCaptcha on Packagist](https://packagist.org/packages/mediawiki/recaptcha)
* [reCaptcha on MediaWiki.org](https://www.mediawiki.org/wiki/Extension:reCaptcha)
* [Latest version of the readme file](https://github.com/vedmaka/Mediawiki-reCaptcha/blob/master/README.md)
