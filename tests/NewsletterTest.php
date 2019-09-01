<?php namespace Fytinnovations\UserConnect\Tests;

use Fytinnovations\UserConnect\Classes\NewsletterManager;
use Fytinnovations\UserConnect\Models\Settings;
use Fytinnovations\UserConnect\Models\Subscriber;
use PluginTestCase;

class NewsletterTest extends PluginTestCase
{
    public function testSendMailWhenNotEnabled()
    {
       $subscriber=new Subscriber();
       $subscriber->email="info@fytinnovations.com";
       $subscriber->verification_key="41be1f8c0e2cd1b477a408534cb650d7";
       $subscriber->valid_till="2019-08-27 03:22:52";
       $subscriber->save();
       Settings::resetDefault();
       $result= NewsletterManager::sendEmailIfEnabled($subscriber);
       $this->assertEquals(false,$result);
       return $subscriber;
    }
}