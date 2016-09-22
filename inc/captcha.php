<?php

//生成图片资源画布
$image = imagecreatetruecolor(100, 30);
$bgcolor = imagecolorallocate($image, 255, 255, 255);//#ffffff 纯白色
imagefill($image, 0,0, $bgcolor);

//添加随机验证码
for($i; $i <4; $i++){
	$fontSize = 6;
	$fontColor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
	$fontContent = rand(0,9);


	$x = (100/4 * $i) +rand(5,10);
	$y = rand(5, 10);

	imagestring($image, $fontSize, $x, $y, $fontContent, $fontColor);
}

for($i; $i<4; $i++){
	$fontSize = 6;
	$fontColor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	//字典
	$data = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$fontContent = substr($data, rand(0,strlen($data)),1);

	$x = (100/4 * $i) +rand(5,10);
	$y = rand(5, 10);

	imagestring($image, $fontSize, $x, $y, $fontContent, $fontColor);
}

//添加点干扰
for($i=0; $i<200; $i++){
	$pointColor = imagecolorallocate($image, rand(50,200),rand(50,200),rand(50,200));
	imagesetpixel($image, rand(0,99), rand(0,29), $pointColor);
}

//添加线干扰
for($i=0; $i<3; $i++){
	$lineColor = imagecolorallocate($image, rand(80,220), rand(80,220), rand(80,220));
	imageline($image, rand(1,99), rand(1,29), rand(1,29), rand(1,29), $lineColor);

}


header('content-type: image/png');
imagepng($image);
imagedestroy($image);