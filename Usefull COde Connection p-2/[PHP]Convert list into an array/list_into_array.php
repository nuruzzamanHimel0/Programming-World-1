$input='<ul><li class="color"><a data-toggle="tooltip" title="One free com, link, .BUSINESS, .Company or .CLICK domain with purchase of a new 12-, 24- or 36-month plan. For details contact our support">FREE Domain</a></li><li>1cPanel &amp; FTP</li><li class="color">You can Host 10 WebSite</li><li>40 GB SSD Storage</li><li class="color">Unlimited Bandwidth</li><li>Unlimited Sub Domains</li><li class="color">Unlimited Databases</li><li>300+ apps with 1-click install</li><li class="color">CageFS Hacker Protection</li><li>Free Dedicated Ip &amp; SSL</li><li class="color">Unlimited E-Mail Accounts</li><li>24/7 Unlimited Support</li><li class="color">Free Cloudflare</li></ul>';

preg_match_all('(<(li class="color"|Li|LI|lI)>(.*)</(li|Li|LI|lI)>)siU', $input, $output);

echo "<pre>";
print_r($output[2]);

OUTPUT:
Array
(
    [0] => FREE Domain
One free com, link, .BUSINESS, .Company or .CLICK domain with purchase of a new 12-, 24- or 36-month plan. For details contact our support

    [1] => 1cPanel & FTP
    [2] => You can Host 10 WebSite
    [3] => 40 GB SSD Storage
    [4] => Unlimited Bandwidth
    [5] => Unlimited Sub Domains
    [6] => Unlimited Databases
    [7] => 300+ apps with 1-click install
    [8] => CageFS Hacker Protection
    [9] => Free Dedicated Ip & SSL
    [10] => Unlimited E-Mail Accounts
    [11] => 24/7 Unlimited Support
    [12] => Free Cloudflare
)

