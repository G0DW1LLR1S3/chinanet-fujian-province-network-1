INTRODUCTION

An user from OTX AlienVault made a post (https://otx.alienvault.com/pulse/5cc13d169607eec999523899)
i saw that one of the malicious scripts being executed was (botminer.php), if you are familiar with 
cryptocurrensy mining you know where this is might be going.

The Attacker is using a irc botnet known as PMA which uses the "phpMyAdmin Code Injection / Remote Code Execution".
(https://www.exploit-db.com/exploits/8992)

So after doing some recon work this is what i got, leave any comments or suggestions. ENJOY !!!

MALWARE & NETWORK DATA

The main piece that will prove eveything i am showing you is the Malware that the Attacker is using
to exploit vulnerable linux systems w/ MySQL/MariaDB & PHP modules installed. What will also be a secondary
piece are the traceroute scan results to the IRC Server hosting the botnet and FTP Server hosting the Malware.
 
E1 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/botminer.php)
E2 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/5cc13d169607eec999523899.csv)

E1 is the malware that is injected to vulnerable systems it is coded in php, and to prove that the Attacker actually
attacked a vulnerable system E2 is the evidence it consist of honeypot logs post to original author link is up top.
The FTP server is ftp://139.59.14.215/.pwlamea/botminer.php
The IRC Server is 117.28.254.177
The Malware Hash is 5ca28c854aefd65490ec518dd5d72441



THE IRC BOTNET ITSELF

What i am going to show you here are screenshots from connecting to the Attackers IRC Botnet and information on a single
bot i was about to catch through server outputs including server information.

THE SERVER HOSTING THE MALWARE

Now from here is where to me it got interesting because as you will see the Attacker used DigitalOcean servers hosted in India
to hold the Malware i tried to traceroute to see where i will end up but their server drops ping requests like crazy, i also
tried connecting the the server with regular http/https requests and the page will show a 502 error but i was still able to
grab their HTTPS certificate.

THE CONCLUSION

skjds.

