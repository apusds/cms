<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Please activate your Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>
<body>
<div>Dear {{ $name }}</div>
<br>
<div>
    Greetings from APUSDS!
</div>
<br>
<div>
    As promised since the start, every Member of APUSDS will get exclusive and early access to our new platforms. <br> Today, we are proud to announce the first iteration of our Member Dashboard, and you will witness the Member Dashboard go through various changes on it's UI and UX. <br><br> <b>Now, don't fret!</b> More fun and cool stuffs are awaiting along with an Offical announcement of the Member Dashboard will be on our Discord.
</div>
<br>
<div>
    <span style="color: red;">Please verify your Email and set a Password in order to access our Cool Member's Dashboard :)</span>
    <br>
    <a href="https://apusds.com/verify/member/{{ $token }}" target="_blank">https://apusds.com/verify/member/{{ $token }}</a>
    <br>
</div>
<br>
<div>
    Best Regards,
    <br>
    APU Student Developer Society

    <br>
    <br>
    <img src="{{ $message->embed(public_path('img/sds.png')) }}" style="max-width:200px;height:auto;">
    <br>
    <a href="http://apusds.com/" target="_blank">apusds.com</a>
    <br>
    ASIA PACIFIC UNIVERSITY OF
    <br>
    TECHNOLOGY & INNOVATION (APU)
    <br>
    <br>
    Jalan Teknologi 5,
    <br>
    Technology Park Malaysia
    <br>
    Bukit Jalil, Kuala Lumpur 57000
    <br>
    Malaysia
    <br>
    <br>
    Follow us:
    <br>
    <a href="https://www.facebook.com/apusds/" target="_blank">https://www.facebook.com/apusds/</a>
    <br>
    <a href="https://www.instagram.com/dsc.apu/" target="_blank">https://www.instagram.com/dsc.apu/</a>
    <br>
    <a href="https://www.linkedin.com/company/apusds/" target="_blank">https://www.linkedin.com/company/apusds/</a>
    <br>
</div>

</body>
</html>
