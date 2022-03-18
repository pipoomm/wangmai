<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mail/vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$identifycode = $_POST['book_id'];
$time = $_POST['ts'];
$user = $_POST['user'];
if(isset($_POST['cobooking']))
{
	$cobooking = $_POST['cobooking'];
	var_dump($cobooking);
	foreach($cobooking as $cobooking_person){
		$mail->addCC(''.$cobooking_person.'@cmu.ac.th');
	}
}

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'project.wangmai@gmail.com'; //SMTP username
    $mail->Password = 'yPHY2C6bUDpq7D'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('project.wangmai@gmail.com', 'WangMai');
    $mail->addAddress(''.$user.'@cmu.ac.th'); //Add a recipient
    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->CharSet = 'UTF-8';
    //$mail->Subject = 'WangMai Booking Confirmation #'.$identifycode.'';
	$mail->Subject = 'WangMai Booking Confirmation #'.$identifycode.'';

    $font = "font-family:'Cabin',Arial,'Helvetica Neue', Helvetica, sans-serif;";
    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
				<head>
				<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
				<meta content="width=device-width" name="viewport"/>
				<!--[if !mso]><!-->
				<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
				<!--<![endif]-->
				<title></title>
				<!--[if !mso]><!-->
				<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/>
				<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
				<!--<![endif]-->
				<style type="text/css">
						body {
							margin: 0;
							padding: 0;
						}
				
						table,
						td,
						tr {
							vertical-align: top;
							border-collapse: collapse;
						}
				
						* {
							line-height: inherit;
						}
				
						a[x-apple-data-detectors=true] {
							color: inherit !important;
							text-decoration: none !important;
						}
					</style>
				<style id="media-query" type="text/css">
						@media (max-width: 670px) {
				
							.block-grid,
							.col {
								min-width: 320px !important;
								max-width: 100% !important;
								display: block !important;
							}
				
							.block-grid {
								width: 100% !important;
							}
				
							.col {
								width: 100% !important;
							}
				
							.col_cont {
								margin: 0 auto;
							}
				
							img.fullwidth,
							img.fullwidthOnMobile {
								max-width: 100% !important;
							}
				
							.no-stack .col {
								min-width: 0 !important;
								display: table-cell !important;
							}
				
							.no-stack.two-up .col {
								width: 50% !important;
							}
				
							.no-stack .col.num2 {
								width: 16.6% !important;
							}
				
							.no-stack .col.num3 {
								width: 25% !important;
							}
				
							.no-stack .col.num4 {
								width: 33% !important;
							}
				
							.no-stack .col.num5 {
								width: 41.6% !important;
							}
				
							.no-stack .col.num6 {
								width: 50% !important;
							}
				
							.no-stack .col.num7 {
								width: 58.3% !important;
							}
				
							.no-stack .col.num8 {
								width: 66.6% !important;
							}
				
							.no-stack .col.num9 {
								width: 75% !important;
							}
				
							.no-stack .col.num10 {
								width: 83.3% !important;
							}
				
							.video-block {
								max-width: none !important;
							}
				
							.mobile_hide {
								min-height: 0px;
								max-height: 0px;
								max-width: 0px;
								display: none;
								overflow: hidden;
								font-size: 0px;
							}
				
							.desktop_hide {
								display: block !important;
								max-height: none !important;
							}
						}
					</style>
				</head>
				<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #000000;">
				<!--[if IE]><div class="ie-browser"><![endif]-->
				<table bgcolor="#000000" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#000000"><![endif]-->
				<div style="background-color:#f3e6f8;">
				<div class="block-grid" style="min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3e6f8;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<div align="center" class="img-container center fixedwidth" style="padding-right: 0px;padding-left: 0px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]-->
				<div style="font-size:1px;line-height:15px"> </div><img align="center" alt="WangMai" border="0" class="center fixedwidth" src="https://wangmai.eng.cmu.ac.th/dist/img/AdminLTELogo2A.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 130px; display: block;" title="WangMai" width="130"/>
				<div style="font-size:1px;line-height:5px"> </div>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:#f3e6f8;">
				<div class="block-grid" style="min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #f1d0ff;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f1d0ff;background-image:url(https://wangmai.eng.cmu.ac.th/mail/images/bg-white-rombo.png);background-position:top left;background-repeat:no-repeat">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3e6f8;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#f1d0ff"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:#f1d0ff;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:45px; padding-bottom:0px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:45px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div align="center" class="img-container center fixedwidth" style="padding-right: 20px;padding-left: 20px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 20px;padding-left: 20px;" align="center"><![endif]-->
				<div style="font-size:1px;line-height:20px"> </div><img align="center" border="0" class="center fixedwidth" src="https://wangmai.eng.cmu.ac.th/dist/img/3910341.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 325px; display: block;" width="325"/>
				<div style="font-size:1px;line-height:20px"> </div>
				<!--[if mso]></td></tr></table><![endif]-->
				</div>
				<table cellpadding="0" cellspacing="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
				<tr style="vertical-align: top;" valign="top">
				<td align="center" style="word-break: break-word; vertical-align: top; padding-bottom: 0px; padding-left: 0px; padding-right: 0px; padding-top: 35px; text-align: center; width: 100%;" valign="top" width="100%">
				<h1 style="color:#8412c0;direction:ltr;' . $font . 'font-size:28px;font-weight:normal;letter-spacing:normal;line-height:120%;text-align:center;margin-top:0;margin-bottom:0;"><strong>Booked Successfully</strong></h1>
				</td>
				</tr>
				</table>
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 45px; padding-left: 45px; padding-top: 10px; padding-bottom: 0px; font-family: Arial, sans-serif"><![endif]-->
				<div style="color:#393d47;' . $font . 'line-height:1.5;padding-top:10px;padding-right:45px;padding-bottom:0px;padding-left:45px;">
				<div class="txtTinyMce-wrapper" style="font-size: 12px; line-height: 1.5; color: #393d47; ' . $font . ' mso-line-height-alt: 18px;">
				<p style="margin: 0; font-size: 12px; text-align: center; line-height: 1.5; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;">Transaction Date: ' . date("d/m/Y H:i:s", strtotime($time)) . '</p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #E1B4FC; width: 80%;" valign="top" width="80%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 45px; padding-left: 45px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
				<div style="color:#393d47;' . $font . 'line-height:1.5;padding-top:10px;padding-right:45px;padding-bottom:10px;padding-left:45px;">
				<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; ' . $font . ' text-align: center; color: #393d47; mso-line-height-alt: 18px;">
				<p style="margin: 0; line-height: 1.5; word-break: break-word; ' . $font . ' font-size: 13px; mso-line-height-alt: 20px; mso-ansi-font-size: 14px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 13px; color: #8412c0; mso-ansi-font-size: 14px;">To see the details and add this event to your calendar. Please click below.</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://wangmai.eng.cmu.ac.th/bookverify.php?text=' . $identifycode . '" style="height:40.5pt;width:246pt;v-text-anchor:middle;" arcsize="0%" strokeweight="0.75pt" strokecolor="#8412c0" fillcolor="#8412c0"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:14px"><![endif]--><a href="https://wangmai.eng.cmu.ac.th/bookverify.php?text=' . $identifycode . '" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #8412c0; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width: auto; width: auto; border-top: 1px solid #8412c0; border-right: 1px solid #8412c0; border-bottom: 1px solid #8412c0; border-left: 1px solid #8412c0; padding-top: 10px; padding-bottom: 10px; ' . $font . ' text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:40px;padding-right:40px;font-size:14px;display:inline-block;letter-spacing:undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; ' . $font . ' mso-line-height-alt: 32px;"><span data-mce-style="font-size: 14px; line-height: 28px;" style="font-size: 14px; line-height: 28px;">Booking Confirmation Code </span></span></span></a>
				<!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
				</div>
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 15px; font-family: Arial, sans-serif"><![endif]-->
				<div style="color:#393d47;' . $font . 'line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
				<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; ' . $font . ' color: #393d47; mso-line-height-alt: 14px;">
				<p style="margin: 0; font-size: 10px; line-height: 1.2; word-break: break-word; text-align: center; ' . $font . ' mso-line-height-alt: 12px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 10px; color: #aa67cf;"><span style="">If you didnt response upcoming notification in 5 minutes, the booking will be automatic cancelled.</span></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 20px; font-family: Arial, sans-serif"><![endif]-->
				<div style="color:#393d47;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
				<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;">
				<p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin-top: 0; margin-bottom: 0;"><span style="color: #8a3b8f;">Please do not respond directly to this email, as it has been generated by an automated system.</span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<div style="background-color:#f3e6f8;">
				<div class="block-grid" style="min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
				<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
				<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3e6f8;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
				<!--[if (mso)|(IE)]><td align="center" width="650" style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:10px;"><![endif]-->
				<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
				<div class="col_cont" style="width:100% !important;">
				<!--[if (!mso)&(!IE)]><!-->
				<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
				<!--<![endif]-->
				<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 5px;" valign="top">
				<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
				<tbody>
				<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: Arial, sans-serif"><![endif]-->
				<div style="color:#393d47;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
				<div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;">
				<p style="margin: 0; text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin-top: 0; margin-bottom: 0;"><span style="color: #8a3b8f;"><span style="font-size: 11px;">WangMai: Classroom Vacancy Checking and Booking System</span></span></p>
				<p style="margin: 0; text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin-top: 0; margin-bottom: 0;"> </p>
				<p style="margin: 0; text-align: center; line-height: 1.2; word-break: break-word; mso-line-height-alt: 14px; margin-top: 0; margin-bottom: 0;"><span style="color: #8a3b8f;"><span style="font-size: 11px;">清迈大学工程学院计算机工程系学</span></span></p>
				</div>
				</div>
				<!--[if mso]></td></tr></table><![endif]-->
				<!--[if (!mso)&(!IE)]><!-->
				</div>
				<!--<![endif]-->
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
				</div>
				</div>
				</div>
				<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
				</tr>
				</tbody>
				</table>
				<!--[if (IE)]></div><![endif]-->
				</body>
				</html>';
    $mail->msgHTML($body);
    $mail->Encoding = 'base64';

    if($mail->send())
    {
        echo TRUE;
    }
    else
    {
        echo $mail->ErrorInfo;
    }
