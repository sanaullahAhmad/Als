<html>
<head>
<title>The Email Design Conference 2014</title>
<meta charset=utf-8>
<style type="text/css">
    /* OBLIGATORY EMAIL STYLES SO I DON'T GO CRAZY */
    #outlook a{padding:0;}
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}                
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
    body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;}
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}
    img{-ms-interpolation-mode:bicubic;}
    body{margin:0; padding:0;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table{border-collapse:collapse !important;}
    body{height:100% !important; margin:0; padding:0; width:100% !important;background-color:#f9fafa;}

    /* BYE BYE BLUE LINKS + ORPHAN STYLE */
    .appleFooter a {color:#999999 !important; text-decoration: none !important;}
    .appleLink a {color:#ffffff !important; text-decoration: none !important;}
    .padding-top {padding-top: 95px !important;}

    /* WEB FONTS, CHYOU KNOWWW */
    @media screen {
        @font-face {
            font-family: 'proxima_nova_rgregular';
            src: url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.eot');
            src: url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.eot?#iefix') format('embedded-opentype'),
                 url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.woff') format('woff'),
                 url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.ttf') format('truetype'),
                 url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.svg#proxima_nova_rgregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'proxima_nova_rgbold';
            src: url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.eot');
            src: url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.eot?#iefix') format('embedded-opentype'),
                 url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.woff') format('woff'),
                 url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.ttf') format('truetype'),
                 url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.svg#proxima_nova_rgbold') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'adelle_rgregular';
            src: url('https://litmus.com/fonts/Emails/adelle_reg-webfont.eot');
            src: url('https://litmus.com/fonts/Emails/adelle_reg-webfont.eot?#iefix') format('embedded-opentype'),
                 url('https://litmus.com/fonts/Emails/adelle_reg-webfont.woff') format('woff'),
                 url('https://litmus.com/fonts/Emails/adelle_reg-webfont.ttf') format('truetype'),
                 url('https://litmus.com/fonts/Emails/adelle_reg-webfont.svg#adelle_rgregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    }

    /* DAT ANIMATION DOE */
    .fadeInDown {
        animation-name: fadeInDown;
        -webkit-animation-name: fadeInDown;
        animation-duration: 1.2s;
        -webkit-animation-duration: 1.2s;
    }
    @keyframes fadeInDown {
        0% {opacity: 0;transform: translateY(-30px);}
        40% {opacity: 0;transform: translateY(-30px);}
        100% {opacity: 1;transform: translateY(0);}
    }
    @-webkit-keyframes fadeInDown {
        0% {opacity: 0;-webkit-transform: translateY(-30px);}
        40% {opacity: 0;-webkit-transform: translateY(-30px);}
        100% {opacity: 1;-webkit-transform: translateY(0);}
    }
    .fadeInDown2 {
        animation-name: fadeInDown2;
        -webkit-animation-name: fadeInDown2;
        animation-duration: 1.6s;
        -webkit-animation-duration: 1.6s;
    }
    @keyframes fadeInDown2 {
        0% {opacity: 0;transform: translateY(-30px);}
        50% {opacity: 0;transform: translateY(-30px);}
        100% {opacity: 1;transform: translateY(0);}
    }
    @-webkit-keyframes fadeInDown2 {
        0% {opacity: 0;-webkit-transform: translateY(-30px);}
        50% {opacity: 0;-webkit-transform: translateY(-30px);}
        100% {opacity: 1;-webkit-transform: translateY(0);}
    }
    .fadeInDown3 {
        animation-name: fadeInDown3;
        -webkit-animation-name: fadeInDown3;
        animation-duration: 2s;
        -webkit-animation-duration: 2s;
    }
    @keyframes fadeInDown3 {
        0% {opacity: 0;transform: translateY(-30px);}
        60% {opacity: 0;transform: translateY(-30px);}
        100% {opacity: 1;transform: translateY(0);}
    }
    @-webkit-keyframes fadeInDown3 {
        0% {opacity: 0;-webkit-transform: translateY(-30px);}
        60% {opacity: 0;-webkit-transform: translateY(-30px);}
        100% {opacity: 1;-webkit-transform: translateY(0);}
    }
    .fadeInDown4 {
        animation-name: fadeInDown4;
        -webkit-animation-name: fadeInDown4;
        animation-duration: 2.4s;
        -webkit-animation-duration: 2.4s;
    }
    @keyframes fadeInDown4 {
        0% {opacity: 0;transform: translateY(-30px);}
        66% {opacity: 0;transform: translateY(-30px);}
        100% {opacity: 1;transform: translateY(0);}
    }
    @-webkit-keyframes fadeInDown4 {
        0% {opacity: 0;-webkit-transform: translateY(-30px);}
        66% {opacity: 0;-webkit-transform: translateY(-30px);}
        100% {opacity: 1;-webkit-transform: translateY(0);}
    }
    @-webkit-keyframes rotateIn {
        0% {
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
        100% {
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }
    }
    @keyframes rotateIn {
        0% {
            -webkit-transform-origin: center center;
            -ms-transform-origin: center center;
            transform-origin: center center;
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
        100% {
            -webkit-transform-origin: center center;
            -ms-transform-origin: center center;
            transform-origin: center center;
            -webkit-transform: rotate(0);
            -ms-transform: rotate(0);
            transform: rotate(0);
        }
    }
    .rotateIn {
        -webkit-animation: rotateIn 14s linear infinite;
        animation: rotateIn 14s linear infinite;
    }

    /* INTERACTION */
    .cta:hover {background: #ffffff url(http://pages.litmus.com/l/31032/2014-04-17/2hs7k/31032/17342/twitter_bg2.png) no-repeat !important;color: #444444 !important;}
    .video-hover:hover {opacity:0.8 !important;}
    
    /* MEDIA QUERY SCREEN 600px */
    @media screen and (max-width: 600px), screen and (max-device-width: 600px) {
        table[class="responsive-table"]{width:100%!important;}
        td[class="block-padding"]{padding: 10px 5% 10px 5% !important;text-align: left;}
        td[class="block-padding-center2"]{padding: 10px 5% 20px 5% !important;text-align: center;}
        td[class="mobile-width"]{padding: 0 9% !important;}
        td[class="section-padding"]{padding: 40px 15px !important;}
        td[class="no-padding"]{padding: 0px !important;}
        img[class="video-hover"]{width: 100% !important;height: auto !important;}
        td[class="padding-top"]{padding-top: 40px !important;}
        td[class="padding-cta-top"]{padding-top:25px !important;}
        td[class="day-padding"]{padding-top:8px !important;}
        img[class="rotateIn"]{width: 110px !important;height: auto !important;}
        br[class="mobile-hide"]{display: none !important;}
    }

    /* MEDIA QUERY SCREEN 480px */
    @media screen and (max-width: 480px), screen and (max-device-width: 480px) {
        td[class="details-header"]{font-size: 16px !important; line-height: 20px !important;}
        td[class="date1"]{padding-top:20px !important;}
        td[class="date2"]{padding-top:23px !important;font-size: 16px !important; line-height: 20px !important;}
        img[class="tedc-logo"]{width: 175px !important;height:auto !important;padding-top:15px !important;}
        img[class="rotateIn"]{width: 65px !important;height: auto !important;}
        a[class="cta"]{font-size: 16px !important;}
        td[class="padding-top"]{padding-top: 25px !important;}
    }

    /* MEDIA QUERY SCREEN 350px */
    @media screen and (max-width: 350px), screen and (max-device-width: 350px) {
        td[class="mobile-width"]{padding: 0 3% !important;}
    }

    /* FIREFOX MEDIA QUERY */
    @-moz-document url-prefix() {
        div[class="gmail-hide"]{display: block !important;max-height: none !important;overflow: visible !important;}
        div[class="line1"]{display: block;border-top: 1px solid #d3d3d3;width: 30%;float: left;margin-top: 15px;}
        div[class="format"]{width: 40%; display: block; float: left;}
        div[class="line2"]{display: block;border-top: 1px solid #d3d3d3;width: 17%;float: left;margin-top: 15px;}
        div[class="last-year"]{display: block; width: 66%; float: left;}
        div[class="video-wrap"]{height: 690px;position: relative;overflow: hidden;padding:0;margin:0;}
        div[class="overlay"]{height: 100%;position: relative;min-height: 100%;margin: 0 auto;padding: 0 20px;z-index:3;}
    }

    /* WEBKIT, CHROME, SAFARI MEDIA QUERY */
    @media screen and (-webkit-min-device-pixel-ratio: 0) {
        div[class="line1"]{display: block;border-top: 1px solid #d3d3d3;width: 25%;float: left;margin-top: 15px;}
        div[class="format"]{width: 50%; display: block; float: left;}
        div[class="line2"]{display: block;border-top: 1px solid #d3d3d3;width: 17%;float: left;margin-top: 15px;}
        div[class="last-year"]{display: block; width: 66%; float: left;}
        div[class="video-wrap"]{height: 100%;height: 750px;position: relative;overflow: hidden;padding:0;margin:0;}
        video[class="video"]{min-height: 100%; min-width: 100%;position: absolute;top: 0p;left: 0;z-index: 2;display:inline-block !important;}
        div[class="overlay"]{height: 100%;position: relative;min-height: 100%;margin: 0 auto;padding: 0 20px;z-index:3;}
        td[class="no-padding"]{padding: 0 !important;}
        td[class="title"]{display: block !important; padding-top: 35px;}
        td[class="webkit-hide"]{display: none !important;}
    }

    /* WEBKIT, CHROME, SAFARI MEDIA QUERY @ 600px */
    @media screen and (-webkit-min-device-pixel-ratio: 0) and (max-width: 600px) {
        div[class="video-wrap"]{height: 570px !important;}
        a[class="cta"]{background: #ffffff url(http://pages.litmus.com/l/31032/2014-04-17/2hs7k/31032/17342/twitter_bg2.png) no-repeat !important;color: #444444 !important;}
        div[class="line1"]{display:none;}
        div[class="line2"]{display: none;}
        div[class="last-year"]{width: 100%; font-size: 21px}
        div[class="format"]{width: 100%; font-size: 21px}
    }
    
    /* WEBKIT, CHROME, SAFARI MEDIA QUERY @ 480px*/
    @media screen and (-webkit-min-device-pixel-ratio: 0) and (max-width: 480px) {
        div[class="video-wrap"]{height: 440px !important;}
        video[class="video"]{top:-75px;left:-200px;}
        td[class="title"]{padding-top: 15px;}
        td[class="title-padding"]{padding-top:10px !important;}
    }

    /* iPAD MEDIA QUERY */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* iPAD 1 & 2, iPAD MINI MEDIA QUERY */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 1) {
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* RETINA iPAD MEDIA QUERY */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) {
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* iPHONE 5 MEDIA QUERY */
    @media screen and (min-device-width: 320px) and (max-device-width: 568px) and (-webkit-min-device-pixel-ratio: 1){
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* iPHONE 5S MEDIA QUERY */
    @media screen and (min-device-width: 320px) and (max-device-width: 568px) and (-webkit-min-device-pixel-ratio: 2){
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* iPHONE 2G/3G/3GS MEDIA QUERY */
    @media screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 1){
        video[class="video"]{display: none !important;z-index:-1;}
    }

    /* iPHONE 4/4S MEDIA QUERY */
    @media screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2){
        video[class="video"]{display: none !important;z-index:-1;}
    }                                                                                     
</style>
</head>
<body bgcolor="#f9fafa">


<!-- WE GON' HAVE WORKSHOPS, KILLER KEYNOTES, & BALLER BREAKOUTS. ALSO, I'M STEADY REPPIN' #TEAMOXFORDCOMMA. -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 10px 10px 10px 10px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="700" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaea">
                            <tr>
                         
                                <td align="center" style="padding: 10px" >
                                    <img class="imglogo" src="<?php echo base_url()?>assets/admin/images/logo/B.pptx_.png" alt="logo" width="33" height="32">
                                </td>
								
				<td style="font-family: 'adelle_rgregular', Helvetica, Arial, sans-serif;padding: 10px "> 
     					<span style="color: rgb(86, 92, 231); font-size: 26px; font-weight: bold">ALIA</span><br/>
					<span style="color: rgb(185, 0, 2);font-size: 16px;">Condo Management System</span>
				</td>
                                </td>
								
								
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="padding: 20px 10px 20px 10px; border: 1px solid #DEDEDE; font-size: 14px; line-height: 25px; font-family: 'proxima_nova_rgregular', Helvetica, Arial, sans-serif; background: #FFF; color: #999999" class="block-padding-center2">
									
								<?php echo $view_data;?>
								</td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#222222">
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="20">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              
                                                <td width="100%" valign="top" style="color: #FFFFFF" align="center">
                                                    
                                                   <span style="color: #FFF; font-size: 13px; ">Copyright ©2016 All Rights Reserved</span>
                                                </td>
                                                
                                               
                                            </tr>
                                           
                                             <tr>
                                                <td width="100%" height="5"></td>
                                            </tr>
                                        </tbody>
                                    </table>
								</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
        
            </table>
        </td>
    </tr>
</table>



</body>
</html>