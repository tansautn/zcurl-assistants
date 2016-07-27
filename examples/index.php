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
 * @FILE       : index.php
 * @CREATED    : 11:18 AM , 27/Jul/2016
 * @DETAIL     :
 * --*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*-- *
 **/

// Example for creating a Assitants
use Zuko\CurlAssistants\Assistants;
use Zuko\CurlAssistants\Curl;
use Zuko\PhpStrAdv\AdvanceStringProcesser;

include ("../3rdlibs/autoload.php");
$curl = new Curl();
$str = new AdvanceStringProcesser();
$assist = new Assistants($curl, $str);