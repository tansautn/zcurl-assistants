<?php
/*
         M""""""""`M            dP                     
         Mmmmmm   .M            88                     
         MMMMP  .MMM  dP    dP  88  .dP   .d8888b.     
         MMP  .MMMMM  88    88  88888"    88'  `88     
         M' .MMMMMMM  88.  .88  88  `8b.  88.  .88     
         M         M  `88888P'  dP   `YP  `88888P'     
         MMMMMMMMMMM    -*-  Created by Zuko  -*-      

         * * * * * * * * * * * * * * * * * * * * *     
         * -    - -     S.Y.M.L.I.E     - -    - *     
         * -  Copyright © 2016 (Z) Programing  - *     
         *    -  -  All Rights Reserved  -  -    *     
         * * * * * * * * * * * * * * * * * * * * *     
*/
/**
 * --*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*-- *
 * @PROJECT    : Z-Adv PHP Curl Assistants
 * @AUTHOR     : Zuko
 * @COPYRIGHT  : © 2016 Z-Programing a.k.a Zuko
 * @LINK       : http://www.zuko.pw/
 * @FILE       : Assistants.php
 * @CREATED    : 2:58 AM , 20/Jul/2016
 * @DETAIL     :
 * --*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*-- *
 **/


namespace Zuko\CurlAssistants;


use Zuko\PhpStrAdv\AdvanceStringProcesser;


/**
 * Class Assistants
 *
 * @package Zuko\CurlAssistants
 */
class Assistants
{
    /** @var string */
    const COOKIES_DIR = __DIR__.'/../tmp/cookies';

    /** @var array */
    const BROWSER_HEADERS = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:43.0) Gecko/20100101 Firefox/43.0',
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language' => 'en-US,en;q=0.5',
        'Accept-Encoding' => 'gzip, deflate',
    ];

    /** @var array */
    const BROWSER_CURL_OPTS = [
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 2,
    ];

    /** @var \Zuko\CurlAssistants\Curl */
    protected $_curlInstance;

    /** @var \Zuko\PhpStrAdv\AdvanceStringProcesser  */
    protected $_strProcesser;
    /**
     * Assistants constructor.
     *
     * @param \Zuko\CurlAssistants\Curl              $curl
     * @param \Zuko\PhpStrAdv\AdvanceStringProcesser $stringProcesser
     */
    public function __construct(Curl $curl,AdvanceStringProcesser $stringProcesser)
    {
        $this->_curlInstance = $curl;
        $this->_strProcesser = $stringProcesser;
        $this->setupBrowserHeaders();
        $this->_curlInstance->setCookiePath($this->createCookieFile());
    }

    public function getCurlInstance()
    {
        return $this->_curlInstance;
    }

    /**
     * Setup common header & opt like a browser for Curl instance
     */
    protected function setupBrowserHeaders()
    {
        foreach ( static::BROWSER_HEADERS as $headerKey => $headerValue )
        {
            if($headerKey === 'User-Agent')
            {
                $this->_curlInstance->setUserAgent($headerValue);
                continue;
            }
            $this->_curlInstance->setHeader($headerKey, $headerValue);
        }
        foreach ( static::BROWSER_CURL_OPTS as $k => $value )
        {
            $this->_curlInstance->setOpt($k, $value);
        }
    }

    /**
     * Create cookie file with given name , if null ones will be generated
     * @param null $filename
     * @return string
     */
    protected function createCookieFile($filename = null)
    {
        if(!$filename) $filename = $this->_strProcesser->generateGUID();
        $fileExt = '.zck';
        $path = static::COOKIES_DIR.$filename.$fileExt;
        touch($path);
        return $path;
    }
}