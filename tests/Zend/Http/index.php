<?php

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
$autoloader = Zend_Loader_Autoloader::getInstance();

error_reporting(E_ALL);
set_time_limit(0);

$config['wurflapi']['wurfl_lib_dir'] = dirname(__FILE__) . '/_files/Wurfl/1.1/';
$config['wurflapi']['wurfl_config_file'] = dirname(__FILE__) . '/_files/Wurfl/resources/wurfl-config.php';
$config['terawurfl']['terawurfl_lib_dir'] = dirname(__FILE__) . '/_files/TeraWurfl_2.1.3/tera-WURFL/';
$config['deviceatlas']['deviceatlas_lib_dir'] = dirname(__FILE__) . '/_files/DA_php_1.4.1/';
$config['deviceatlas']['deviceatlas_data'] = dirname(__FILE__) . '/_files/DA_php_1.4.1/sample/json/20101014.json';
/*
$config['mobile']['features']['path']      = 'Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php';
$config['mobile']['features']['classname'] = 'Zend_Http_UserAgent_Features_Adapter_TeraWurfl';
$config['mobile']['features']['path']      = 'Zend/Http/UserAgent/Features/Adapter/DeviceAtlas.php';
$config['mobile']['features']['classname'] = 'Zend_Http_UserAgent_Features_Adapter_DeviceAtlas';
*/
$config['server'] = $_SERVER;

if (!empty($_GET['userAgent'])) {
    $config['server']['http_user_agent'] = $_GET['userAgent'];
} else {
    $_GET['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
}

if (!empty($_GET['sequence'])) {
    $config['identification_sequence'] = $_GET['sequence'];
}
$oUserAgent = new Zend_Http_UserAgent($config);

//$oUserAgent = Zend_Http_UserAgent::getInstance ();


function printBrowserDetails($browser)
{
    $device = $browser->getDevice();
    //Zend_Debug::dump($device->getAllFeatures());
    if (isset($device)) {
        print "<fieldset><legend><b>General informations</b></legend>";
        print "<ul>";
        print "<li>Browser Type: " . $browser->getBrowserType() . "</li>";
        print "<li>Browser Name: " . $device->getFeature('browser_name') . "</li>";
        print "<li>Browser Version: " . $device->getFeature('browser_version') . "</li>";
        print "<li>Browser Compatibility: " . $device->getFeature('browser_compatibility') . "</li>";
        print "<li>Browser Engine: " . $device->getFeature('browser_engine') . "</li>";
        print "<li>Device OS Name: " . $device->getFeature('device_os_name') . "</li>";
        print "<li>Device OS token: " . $device->getFeature('device_os_token') . "</li>";
        print "<li>Server OS: " . $device->getFeature('server_os') . "</li>";
        print "<li>Server Platform: " . $device->getFeature('server_platfom') . "</li>";
        print "<li>Server Platform Version: " . $device->getFeature('server_platfom_version') . "</li>";
        print "</ul>";
        print '</fieldset>';
        
        $wurfl = $device->getFeature("brand_name");
        if (!$wurfl) {
            print "<fieldset><legend><b>no WURFL identification</b></legend>";
            print '</fieldset>';
        } else {
            print "<fieldset><legend><b>WURFL capabilities</b></legend>";
            print "<ul>";
            print "<li>Mobile browser: " . $device->getFeature("mobile_browser") . "</li>";
            print "<li>Mobile browser version: " . $device->getFeature("mobile_browser_version") . "</li>";
            print "<li>Device Brand Name: " . $device->getFeature("brand_name") . "</li>";
            print "<li>Device Model Name: " . $device->getFeature('model_name') . "</li>";
            print "<li>Device OS: " . $device->getFeature('device_os') . "</li>";
            print "<li>Xhtml Preferred Markup:" . $device->getFeature('preferred_markup') . "</li>";
            print "<li>Resolution Width:" . $device->getFeature('resolution_width') . "</li>";
            print "<li>Resolution Height:" . $device->getFeature('resolution_height') . "</li>";
            print "<li>MP3:" . $device->getFeature('mp3') . "</li>";
            print "</ul>";
            print '</fieldset>';
        }
        
        print "<fieldset><legend><b>Full</b></legend>";
        Zend_Debug::dump($device->getAllFeatures());
        print '</fieldset>';
    }

}

$options = [
    '', 
    'mobile, text, desktop', 
    'bot, mobile, validator, checker, console, offline, email, text', 
    'text, bot, validator, checker, console, offline, email'
];
?>

<div id="content">

<p><b>Query by providing the user agent:</b></p>
<p>look at <a target="_blank"
	href="http://www.useragentstring.com/pages/useragentstring.php"
	target="_blank">http://www.useragentstring.com/pages/useragentstring.php</a>
or <a href="http://www.user-agents.org/" target="_blank">http://www.user-agents.org/</a></p>
<p>For mobile, look at <a target="_blank"
	href="http://en.wikipedia.org/wiki/List_of_user_agents_for_mobile_phones">http://en.wikipedia.org/wiki/List_of_user_agents_for_mobile_phones</a></p>
<fieldset>
<form method="get">
<div>Sequence : <select name="sequence" style="width: 500">
	<?php
foreach ($options as $option) {
    $selected = ($option == $_GET['sequence'] ? ' selected ' : '');
    echo '<option value="' . $option . '"' . $selected . '>' . ($option ? $option : '(standard)') . '</option>';
}
?>
</select> (DON'T FORGET TO CLEAN SESSION COOKIE)<br />
User Agent : <input type="text" name="userAgent" style="width: 700"
	value="<?=htmlentities($_GET['userAgent'])?>" /> <br />
<input type="submit" /></div>
</form>
</fieldset>

<?php
if ($oUserAgent) {
    printBrowserDetails($oUserAgent);
}
?>

</div>
