<?php
/**
 * 
 * Videoparse(https://www.videoparse.cn)
 * 支持：抖音、快手、剪映、小红书、Tiktok(抖音国际版)、微博、QQ看点视频、西瓜视频、今日头条、趣头条、火锅视频、美拍、微视、火山小视频、皮皮虾、好看视频、
 * 绿洲、VUE、秒拍、梨视频、刷宝短视频、全民小视频、陌陌视频、UC浏览器、Bilibili、WIDE、开眼、全民K歌、最右、小咖秀、皮皮搞笑、小影、新片场、场库、
 * 阳光宽频网等超过30个平台的短视频去水印解析等平台的短视频去水印解析API接口
 *
 * 解析短视频接口 - 安全版
 */
function curlPost( $url = '', $data ) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //部分环境下，需要将参数值设为2，即：curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$response = curl_exec( $ch );
	curl_close ( $ch );

	return $response;	
}

function sign($appId, $appSecret, $url, $timestamp) {
	$param = [
		'appid'		=> $appId,
		'url'		=> $url,
		'timestamp'	=> $timestamp,
	];
	ksort($param);
	return substr(md5(substr(md5(http_build_query($param)), 6, 18) . $appSecret), 10, 16);
}

//开发者后台生成的appid
$appId = '';

//开发者后台生成的appsecret
$appSecret = '';

//需要解析的url
$url = '';

//时间戳
$timestamp = time();

//生成签名
$sign = sign($appId, $appSecret, $url, $timestamp);

//curl post请求接口解析短视频
$param = [
	'appid'		=> $appId,
	'url'		=> $url,
	'timestamp'	=> $timestamp,
	'sign'		=> $sign,
];

$apiUrl = 'https://api-sv.videoparse.cn/api/video/parse';
$videoInfo = curlPost($apiUrl, $param);
print_r($videoInfo);
