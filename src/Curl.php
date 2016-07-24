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
 * @FILE       : Curl.php
 * @CREATED    : 5:58 PM , 20/Jul/2016
 * @DETAIL     :
 * --*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*-- *
 **/


namespace Zuko\CurlAssistants;


/**
 * Class Curl
 *
 * @package Zuko\CurlAssistants
 */
class Curl extends \Curl\Curl
{

    public function __construct($base_url = null) {
        parent::__construct($base_url);
        $this->beforeSendFunction = function ()
        {
            if($this->getOpt(CURLOPT_CUSTOMREQUEST))
            {
                $this->setOpt(CURLOPT_CUSTOMREQUEST, false);
            }
        };
        $this->setOpt(CURLINFO_HEADER_OUT, true);
        $this->setOpt(CURLOPT_HEADER, true);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
        $this->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
    }

    public function setCookiePath($path)
    {
        $this->setCookieJar($path);
        $this->setCookieFile($path);
    }
    public function post($url, $data = array(),$xhttp = false,$json=false)
    {
        if (is_array($data) && empty($data)) {
            $this->setHeader('Content-Length',0);
        }
        if($xhttp)
        {
            $this->setHeader('X-Requested-With','XMLHttpRequest');
        }
        if($json)
        {
            $this->setHeader('Content-Type','application/json; charset=UTF-8');
        }
        else
        {
            $this->setHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
        }
        $this->baseUrl = $url;
        $this->url = $url;
        $this->setOpt(CURLOPT_URL, $this->url);
//        $this->setOpt(CURLOPT_CUSTOMREQUEST, 'POST');
        $this->setOpt(CURLOPT_POST, true);
        if($json)
        {

            $this->setOpt(CURLOPT_POSTFIELDS,json_encode($data));
        }else{
            $this->setOpt(CURLOPT_POSTFIELDS, $this->buildPostData($data));
        }
//        $this->unsetHeader('Expect');
        $rs = $this->exec();
        $this->setOpt(CURLOPT_POST,false);
        $this->setOpt(CURLOPT_POSTFIELDS,false);
        $this->unsetHeader('Content-Length');
        $this->unsetHeader('Content-Type');
        if($xhttp){
            $this->unsetHeader('X-Requested-With');
        }
        return $rs;
    }
    public function setDefaultUserAgent()
    {
        $user_agent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
        $this->setUserAgent($user_agent);
    }
    public function download($url, $mixed_filename)
    {
        set_time_limit(0);
/*        if (is_callable($mixed_filename)) {
            $this->downloadCompleteFunction = $mixed_filename;
            $fh = tmpfile();
        } else {
            $filename = $mixed_filename;
            $fh = fopen($filename, 'w+');
        }
$this->setTimeout(0);
        $this->setOpt(CURLOPT_FILE, $fh);
        $this->get($url);
        $this->downloadComplete($fh);*/

//        return ! $this->error;
//set_time_limit(0);
        $fp = fopen ($mixed_filename, 'w+');
//Here is the file we are downloading, replace spaces with %20
        $ch = curl_init(str_replace(" ","%20",$url));
//        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
// write curl response to file
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// get curl response
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}