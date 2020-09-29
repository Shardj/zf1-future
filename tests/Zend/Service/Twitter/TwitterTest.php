<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service_Twitter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: TwitterTest.php 22318 2010-05-29 18:24:27Z padraic $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_Twitter_TwitterTest::main');
}

/** Zend_Service_Twitter */
require_once 'Zend/Service/Twitter.php';
require_once 'Zend/Service/Twitter/Response.php';

/** Zend_Http_Client */
require_once 'Zend/Http/Client.php';

/** Zend_Http_Client_Adapter_Test */
require_once 'Zend/Http/Client/Adapter/Test.php';

require_once 'Zend/Oauth/Client.php';
require_once 'Zend/Http/Response.php';
require_once 'Zend/Oauth/Token/Access.php';
require_once 'Zend/Oauth/Token/Access.php';
require_once 'Zend/Oauth/Client.php';
require_once 'Zend/Oauth/Consumer.php';

/**
 * @category   Zend
 * @package    Zend_Service_Twitter
 * @subpackage UnitTests
 * @group      Zend_Service
 * @group      Zend_Service_Twitter
 */
class Zend_Service_Twitter_TwitterTest extends PHPUnit_Framework_TestCase
{

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Quick reusable Twitter Service stub setup. Its purpose is to fake
     * interactions with Twitter so the component can focus on what matters:
     * 1. Makes correct requests (URI, parameters and HTTP method)
     * 2. Parses all responses and returns a Zend_Service_Twitter_Response
     * 3. TODO: Correctly utilises all optional parameters
     *
     * If used correctly, tests will be fast, efficient, and focused on
     * Zend_Service_Twitter's behaviour only. No other dependencies need be
     * tested. The Twitter API Changelog should be regularly reviewed to
     * ensure the component is synchronised to the API.
     *
     * @param string $path Path appended to Twitter API endpoint
     * @param string $method Do we expect HTTP GET or POST?
     * @param string $responseFile File containing a valid XML response to the request
     * @param array $params Expected GET/POST parameters for the request
     * @return Zend_Http_Client
     */
    protected function stubTwitter($path, $method, $responseFile = null, array $params = null)
    {
        $client = $this->getMock('Zend_Oauth_Client', [], [], '', false);
        $client->expects($this->any())->method('resetParameters')
            ->will($this->returnValue($client));
        $client->expects($this->once())->method('setUri')
            ->with('https://api.twitter.com/1.1/' . $path);
        $response = $this->getMock('Zend_Http_Response', [], [], '', false);
        if (!is_null($params)) {
            $setter = 'setParameter' . ucfirst(strtolower($method));
            $client->expects($this->once())->method($setter)->with($params);
        }
        $client->expects($this->once())->method('request')->with()
            ->will($this->returnValue($response));
        $response->expects($this->any())->method('getBody')
            ->will($this->returnValue(
                isset($responseFile) ? file_get_contents(dirname(__FILE__) . '/_files/' . $responseFile) : ''
            ));
        return $client;
    }

    /**
     * OAuth tests
     */

    public function testProvidingAccessTokenInOptionsSetsHttpClientFromAccessToken()
    {
        $token = $this->getMock('Zend_Oauth_Token_Access', [], [], '', false);
        $client = $this->getMock('Zend_Oauth_Client', [], [], '', false);
        $token->expects($this->once())->method('getHttpClient')
            ->with(['token'=>$token, 'siteUrl'=>'https://api.twitter.com/oauth'])
            ->will($this->returnValue($client));

        $twitter = new Zend_Service_Twitter(['accessToken'=>$token, 'opt1'=>'val1']);
        $this->assertTrue($client === $twitter->getHttpClient());
    }

    public function testNotAuthorisedWithoutToken()
    {
        $twitter = new Zend_Service_Twitter;
        $this->assertFalse($twitter->isAuthorised());
    }

    public function testChecksAuthenticatedStateBasedOnAvailabilityOfAccessTokenBasedClient()
    {
        $token = $this->getMock('Zend_Oauth_Token_Access', [], [], '', false);
        $client = $this->getMock('Zend_Oauth_Client', [], [], '', false);
        $token->expects($this->once())->method('getHttpClient')
            ->with(['token'=>$token, 'siteUrl'=>'https://api.twitter.com/oauth'])
            ->will($this->returnValue($client));

        $twitter = new Zend_Service_Twitter(['accessToken'=>$token]);
        $this->assertTrue($twitter->isAuthorised());
    }

    public function testRelaysMethodsToInternalOAuthInstance()
    {
        $oauth = $this->getMock('Zend_Oauth_Consumer', [], [], '', false);
        $oauth->expects($this->once())->method('getRequestToken')->will($this->returnValue('foo'));
        $oauth->expects($this->once())->method('getRedirectUrl')->will($this->returnValue('foo'));
        $oauth->expects($this->once())->method('redirect')->will($this->returnValue('foo'));
        $oauth->expects($this->once())->method('getAccessToken')->will($this->returnValue('foo'));
        $oauth->expects($this->once())->method('getToken')->will($this->returnValue('foo'));

        $twitter = new Zend_Service_Twitter(['opt1'=>'val1'], $oauth);
        $this->assertEquals('foo', $twitter->getRequestToken());
        $this->assertEquals('foo', $twitter->getRedirectUrl());
        $this->assertEquals('foo', $twitter->redirect());
        $this->assertEquals('foo', $twitter->getAccessToken([], $this->getMock('Zend_Oauth_Token_Request')));
        $this->assertEquals('foo', $twitter->getToken());
    }

    public function testResetsHttpClientOnReceiptOfAccessTokenToOauthClient()
    {
        $this->markTestIncomplete('Problem with resolving classes for mocking');
        $oauth = $this->getMock('Zend_Oauth_Consumer', [], [], '', false);
        $client = $this->getMock('Zend_Oauth_Client', [], [], '', false);
        $token = $this->getMock('Zend_Oauth_Token_Access', [], [], '', false);
        $token->expects($this->once())->method('getHttpClient')->will($this->returnValue($client));
        $oauth->expects($this->once())->method('getAccessToken')->will($this->returnValue($token));
        $client->expects($this->once())->method('setHeaders')->with('Accept-Charset', 'ISO-8859-1,utf-8');

        $twitter = new Zend_Service_Twitter([], $oauth);
        $twitter->getAccessToken([], $this->getMock('Zend_Oauth_Token_Request'));
        $this->assertTrue($client === $twitter->getHttpClient());
    }

    public function testAuthorisationFailureWithUsernameAndNoAccessToken()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter(['username'=>'me']);
        $twitter->statusesPublicTimeline();
    }

    /**
     * @group ZF-8218
     */
    public function testUserNameNotRequired()
    {
        $twitter = new Zend_Service_Twitter();
        $twitter->setHttpClient($this->stubTwitter(
            'users/show.json', Zend_Http_Client::GET, 'users.show.mwop.json',
            ['screen_name' => 'mwop']
        ));
        $response = $twitter->users->show('mwop');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
        $exists = $response->id !== null;
        $this->assertTrue($exists);
    }

    /**
     * @group ZF-7781
     */
    public function testRetrievingStatusesWithValidScreenNameThrowsNoInvalidScreenNameException()
    {
        $twitter = new Zend_Service_Twitter();
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/user_timeline.json', Zend_Http_Client::GET, 'statuses.user_timeline.mwop.json'
        ));
        $twitter->statuses->userTimeline(['screen_name' => 'mwop']);
    }

    /**
     * @group ZF-7781
     */
    public function testRetrievingStatusesWithInvalidScreenNameCharacterThrowsInvalidScreenNameException()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter();
        $twitter->statuses->userTimeline(['screen_name' => 'abc.def']);
    }

    /**
     * @group ZF-7781
     */
    public function testRetrievingStatusesWithInvalidScreenNameLengthThrowsInvalidScreenNameException()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter();
        $twitter->statuses->userTimeline(['screen_name' => 'abcdef_abc123_abc123x']);
    }

    /**
     * @group ZF-7781
     */
    public function testStatusUserTimelineConstructsExpectedGetUriAndOmitsInvalidParams()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/user_timeline.json', Zend_Http_Client::GET, 'statuses.user_timeline.mwop.json', [
                'count' => '123',
                'user_id' => 783214,
                'since_id' => '10000',
                'max_id' => '20000',
                'screen_name' => 'twitter'
            ]
        ));
        $twitter->statuses->userTimeline([
            'id' => '783214',
            'since' => '+2 days', /* invalid param since Apr 2009 */
            'page' => '1',
            'count' => '123',
            'user_id' => '783214',
            'since_id' => '10000',
            'max_id' => '20000',
            'screen_name' => 'twitter'
        ]);
    }

    public function testOverloadingGetShouldReturnObjectInstanceWithValidMethodType()
    {
        $twitter = new Zend_Service_Twitter;
        $return = $twitter->statuses;
        $this->assertSame($twitter, $return);
    }

    public function testOverloadingGetShouldthrowExceptionWithInvalidMethodType()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter;
        $return = $twitter->foo;
    }

    public function testOverloadingGetShouldthrowExceptionWithInvalidFunction()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter;
        $return = $twitter->foo();
    }

    public function testMethodProxyingDoesNotThrowExceptionsWithValidMethods()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/sample.json', Zend_Http_Client::GET, 'statuses.sample.json'
        ));
        $twitter->statuses->sample();
    }

    public function testMethodProxyingThrowExceptionsWithInvalidMethods()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter;
        $twitter->statuses->foo();
    }

    public function testVerifiedCredentials()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'account/verify_credentials.json', Zend_Http_Client::GET, 'account.verify_credentials.json'
        ));
        $response = $twitter->account->verifyCredentials();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testSampleTimelineStatusReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/sample.json', Zend_Http_Client::GET, 'statuses.sample.json'
        ));
        $response = $twitter->statuses->sample();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testRateLimitStatusReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'application/rate_limit_status.json', Zend_Http_Client::GET, 'application.rate_limit_status.json'
        ));
        $response = $twitter->application->rateLimitStatus();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testRateLimitStatusHasHitsLeft()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'application/rate_limit_status.json', Zend_Http_Client::GET, 'application.rate_limit_status.json'
        ));
        $response = $twitter->application->rateLimitStatus();
        $status = $response->toValue();
        $this->assertEquals(180, $status->resources->statuses->{'/statuses/user_timeline'}->remaining);
    }

    /**
     * TODO: Check actual purpose. New friend returns XML response, existing
     * friend returns a 403 code.
     */
    public function testFriendshipCreate()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'friendships/create.json', Zend_Http_Client::POST, 'friendships.create.twitter.json',
            ['screen_name' => 'twitter']
        ));
        $response = $twitter->friendships->create('twitter');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testHomeTimelineWithCountReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/home_timeline.json', Zend_Http_Client::GET, 'statuses.home_timeline.page.json',
            ['count' => 3]
        ));
        $response = $twitter->statuses->homeTimeline(['count' => 3]);
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    /**
     * TODO: Add verification for ALL optional parameters
     */
    public function testUserTimelineReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/user_timeline.json', Zend_Http_Client::GET, 'statuses.user_timeline.mwop.json',
            ['screen_name' => 'mwop']
        ));
        $response = $twitter->statuses->userTimeline(['screen_name' => 'mwop']);
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    /**
     * TODO: Add verification for ALL optional parameters
     */
    public function testPostStatusUpdateReturnsResponse()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/update.json', Zend_Http_Client::POST, 'statuses.update.json',
            ['status'=>'Test Message 1']
        ));
        $response = $twitter->statuses->update('Test Message 1');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testPostStatusUpdateToLongShouldThrowException()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter;
        $twitter->statuses->update('Test Message - ' . str_repeat(' Hello ', 140));
    }

    public function testPostStatusUpdateEmptyShouldThrowException()
    {
        $this->setExpectedException('Zend_Service_Twitter_Exception');
        $twitter = new Zend_Service_Twitter;
        $twitter->statuses->update('');
    }

    public function testShowStatusReturnsResponse()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/show/307529814640840705.json', Zend_Http_Client::GET, 'statuses.show.json'
        ));
        $response = $twitter->statuses->show('307529814640840705');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testCreateFavoriteStatusReturnsResponse()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'favorites/create.json', Zend_Http_Client::POST, 'favorites.create.json',
            ['id' => 15042159587]
        ));
        $response = $twitter->favorites->create(15042159587);
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testFavoritesListReturnsResponse()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'favorites/list.json', Zend_Http_Client::GET, 'favorites.list.json'
        ));
        $response = $twitter->favorites->list();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testDestroyFavoriteReturnsResponse()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'favorites/destroy.json', Zend_Http_Client::POST, 'favorites.destroy.json',
            ['id' => 15042159587]
        ));
        $response = $twitter->favorites->destroy(15042159587);
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testStatusDestroyReturnsResult()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/destroy/15042159587.json', Zend_Http_Client::POST, 'statuses.destroy.json'
        ));
        $response = $twitter->statuses->destroy(15042159587);
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testStatusHomeTimelineWithNoOptionsReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/home_timeline.json', Zend_Http_Client::GET, 'statuses.home_timeline.page.json'
        ));
        $response = $twitter->statuses->homeTimeline();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testUserShowByIdReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'users/show.json', Zend_Http_Client::GET, 'users.show.mwop.json',
            ['screen_name' => 'mwop']
        ));
        $response = $twitter->users->show('mwop');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    /**
     * TODO: Add verification for ALL optional parameters
     * @todo rename to "mentions_timeline"
     */
    public function testStatusMentionsReturnsResults()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'statuses/mentions_timeline.json', Zend_Http_Client::GET, 'statuses.mentions_timeline.json'
        ));
        $response = $twitter->statuses->mentionsTimeline();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    /**
     * TODO: Add verification for ALL optional parameters
     */
    public function testFriendshipDestroy()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'friendships/destroy.json', Zend_Http_Client::POST, 'friendships.destroy.twitter.json',
            ['screen_name' => 'twitter']
        ));
        $response = $twitter->friendships->destroy('twitter');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testBlockingCreate()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'blocks/create.json', Zend_Http_Client::POST, 'blocks.create.twitter.json',
            ['screen_name' => 'twitter']
        ));
        $response = $twitter->blocks->create('twitter');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testBlockingList()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'blocks/list.json', Zend_Http_Client::GET, 'blocks.list.json',
            ['cursor' => -1]
        ));
        $response = $twitter->blocks->list();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testBlockingIds()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'blocks/ids.json', Zend_Http_Client::GET, 'blocks.ids.json',
            ['cursor' => -1]
        ));
        $response = $twitter->blocks->ids();
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
        $this->assertContains('23836616', $response->ids);
    }

    public function testBlockingDestroy()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'blocks/destroy.json', Zend_Http_Client::POST, 'blocks.destroy.twitter.json',
            ['screen_name' => 'twitter']
        ));
        $response = $twitter->blocks->destroy('twitter');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    /**
     * @group ZF-6284
     */
    public function testTwitterObjectsSoNotShareSameHttpClientToPreventConflictingAuthentication()
    {
        $twitter1 = new Zend_Service_Twitter(['username'=>'zftestuser1']);
        $twitter2 = new Zend_Service_Twitter(['username'=>'zftestuser2']);
        $this->assertFalse($twitter1->getHttpClient() === $twitter2->getHttpClient());
    }

    public function testSearchTweets()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'search/tweets.json', Zend_Http_Client::GET, 'search.tweets.json',
            ['q' => '#zf2']
        ));
        $response = $twitter->search->tweets('#zf2');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }

    public function testUsersSearch()
    {
        $twitter = new Zend_Service_Twitter;
        $twitter->setHttpClient($this->stubTwitter(
            'users/search.json', Zend_Http_Client::GET, 'users.search.json',
            ['q' => 'Zend']
        ));
        $response = $twitter->users->search('Zend');
        $this->assertTrue($response instanceof Zend_Service_Twitter_Response);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Service_TwitterTest::main') {
    Zend_Service_TwitterTest::main();
}
