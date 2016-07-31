# Spamty Statuspage

Powered by Uptime Robot API

## Website

`index.php` is the website that displays the current server status.
I can be found here <https://status.spamty.eu/>

The website is translated. Docs can be found here <https://github.com/philipp-r/spamty-website/blob/master/docs/translation.md>

## Twitter

`twitter.php` is called by Uptime Robot webhook and posts the server status to our Twitter account.

Authenticate for first run by calling `twitter_login.php` in browser and add keys to `twitter_config.php`.
