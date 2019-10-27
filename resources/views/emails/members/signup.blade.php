<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Welcome to APUSDS</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
    </head>
    <body>
        <div>Dear {{ $name }}</div>
        <br>
        <div>
            Welcome to the APU Student Developer Society!
        </div>
        <div>
            Firstly, we would like to wholeheartedly thank you on behalf of all our committee members for becoming a part of our club. As a club member, you will get early access to our events, purchase tickets at a discounted price, attend exclusive activities, and build cool projects with us! Our secret base is still under construction (no joke), so stay tuned.
        </div>
        <br>
        <div>
            Please join our official Discord guild for SDS members only:
            <br>
            <a href="https://discordapp.com/invite/BM5DEEZ" target="_blank">https://discordapp.com/invite/BM5DEEZ</a>
            <br>
            (You will need to verify your email with the SDS Bot)
        </div>
        <br>
        <div>
            Also, to always stay connected with us and enjoy exclusively curated content follow us on our socials:
            <br>
            Facebook - <a href="https://www.facebook.com/apusds/" target="_blank">https://www.facebook.com/apusds/</a>
            <br>
            Instagram - <a href=" https://www.instagram.com/dsc.apu/" target="_blank"> https://www.instagram.com/dsc.apu/</a>
        </div>
        <br>
        <div>
            We hope you will find your journey within the club a fun and fulfilling experience with a lot of learning and sharing. Welcome to the most amazing and one of a kind club in APU!
        </div>
        <br>
        <div>P.S. Here's a little advice from us:</div>
        <br>
        <img src="{{ $message->embed(public_path('\img\welcome_meme_01.jpg')) }}">
        <br>
        <div>
            Best Regards,
            <br>
            APU Student Developer Society

            <br>
            <br>
            <img src="{{ $message->embed(public_path('\img\sds.png')) }}" style="max-width:200px;height:auto;">
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
