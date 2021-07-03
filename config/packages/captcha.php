<?php
 if (!class_exists('CaptchaConfiguration')) { return; }

 // You could have more than one object like ExampleCaptcha. For example, one for the login page, another for the register page, etc.
 return [
   'FilmCaptcha' => [
     'UserInputID' => 'captchaCode',
     'CodeLength' => CaptchaRandomization::GetRandomCodeLength(5, 6),
     'ImageWidth' => 250,
     'ImageHeight' => 50,
     'ImageStyle' => ImageStyle::Bullets,
   ],
   'ContactCaptcha' => [
     'UserInputID' => 'contactCode',
     'CodeLength' => CaptchaRandomization::GetRandomCodeLength(5, 6),
     'ImageWidth' => 250,
     'ImageHeight' => 50,
     'ImageStyle' => ImageStyle::Bullets,
   ],
   'UserCaptcha' => [
     'UserInputID' => 'userCode',
     'CodeLength' => CaptchaRandomization::GetRandomCodeLength(5, 6),
     'ImageWidth' => 250,
     'ImageHeight' => 50,
     'ImageStyle' => ImageStyle::Bullets,
   ],
 ];

