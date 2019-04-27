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

E3 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/1.jpg)

E4 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/2.jpg)

E5 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/3.jpg)

E3 & E4 are the results i got from a traceroute luckly the network was accepting my pings.

E5 are the results of a port scan i found 22/open, 80/open and they both were easy to connect to
so we know the port is active besides just open, i also found some very interesting ports that were open
i highly suggest you take a look.


THE IRC BOTNET ITSELF

What i am going to show you here are screenshots from connecting to the Attackers IRC Botnet and information on a single
bot i was about to catch through server outputs including server information.

E6 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/5.jpg)

E7 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/4.jpg)

E8 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/6.jpg)

E6 shows me successfully connecting to the IRC Server hosting the botnet and information on the server like
the server name, version, creation date, local users, local/global channel.

E7 shows me joining the channel that are hosting the bots, the bots start joining and quiting the session

E8 shows me grabbing irc nickname of a bot and doing a simple irc /WHO command, i was then showed hostname and
operating system information of that bot.

THE SERVER HOSTING THE MALWARE

Now from here is where to me it got interesting because as you will see the Attacker used DigitalOcean servers hosted in India
to hold the Malware i tried to traceroute to see where i will end up but their server drops ping requests like crazy, i also
tried connecting the the server with regular http/https requests and the page will show a 502 error but i was still able to
grab their HTTPS certificate.

E9 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/7.jpg)

E10 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/8.jpg)

E11 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/9.jpg)

E12 -(https://github.com/G0DW1LLR1S3/chinanet-fujian-province-network-1/blob/master/wikioptitin.crt)

E9 Shows information about the location of the FTP Server plus what company host that server.

E10 shows whois information on the server which goes furthur to prove a network user from Chinanet Fujian Province Network
created this FTP Server to host their malicous malware.

E11 show the results of a port scan against the FTP Server we got port 22/open and 21/open.

E12 shows the HTTPS certifcate from the FTP Server.

THE CONCLUSION

Well that's it guys, if you are wondering why i did this. I saw the IP Address country was china and i didn't belong to an ISP
so i got sketched out and got into THE MODE.

