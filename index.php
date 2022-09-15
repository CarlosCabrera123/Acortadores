<?php 

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    require_once './utils/customLogClass.php';
    require_once './utils/response.php';
    require_once './utils/constants.php';
    $shortLog = new CustomShortLogClass();
    $emptyFields = array();
    $isPhone = '!function(a){var b=/iPhone/i,c=/iPod/i,d=/iPad/i,e=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,f=/Android/i,g=/(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,h=/(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,i=/IEMobile/i,j=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,k=/BlackBerry/i,l=/BB10/i,m=/Opera Mini/i,n=/(CriOS|Chrome)(?=.*\bMobile\b)/i,o=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,p=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),q=function(a,b){return a.test(b)},r=function(a){var r=a||navigator.userAgent,s=r.split("[FBAN");return"undefined"!=typeof s[1]&&(r=s[0]),s=r.split("Twitter"),"undefined"!=typeof s[1]&&(r=s[0]),this.apple={phone:q(b,r),ipod:q(c,r),tablet:!q(b,r)&&q(d,r),device:q(b,r)||q(c,r)||q(d,r)},this.amazon={phone:q(g,r),tablet:!q(g,r)&&q(h,r),device:q(g,r)||q(h,r)},this.android={phone:q(g,r)||q(e,r),tablet:!q(g,r)&&!q(e,r)&&(q(h,r)||q(f,r)),device:q(g,r)||q(h,r)||q(e,r)||q(f,r)},this.windows={phone:q(i,r),tablet:q(j,r),device:q(i,r)||q(j,r)},this.other={blackberry:q(k,r),blackberry10:q(l,r),opera:q(m,r),firefox:q(o,r),chrome:q(n,r),device:q(k,r)||q(l,r)||q(m,r)||q(o,r)||q(n,r)},this.seven_inch=q(p,r),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},s=function(){var a=new r;return a.Class=r,a};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=r:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=s():"function"==typeof define&&define.amd?define("isMobile",[],a.isMobile=s()):a.isMobile=s()}(this);';
    $shortLinkProvider = 0; #0 = our shortener, 1 = rebrandly
if(isset($_POST['action']) && $_POST['action']=="shortTextBlock"){
    //Shorten links embeded in a text block
    require_once './controllers/shortTextBlock.php';

    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    #Must be YYYY-MM-dd hh:mm
    #Ex 2020-03-03 19:05
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["textBlock"]) ||  $_POST["textBlock"] == "" || $_POST["textBlock"] == null) {
        $emptyFields[]="textBlock";
    }
    if (count($emptyFields)==0) {
        $textBlock = $_POST["textBlock"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $emptyFields;
        $shortLog->writeShortLog($_POST['action']." ".$textBlock ." ".$cid." ".$time);
        $shortLinkProvider = 0;

        if($textBlock =  shortTextBlock($textBlock,$cid,$time,$shortLinkProvider)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$textBlock);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="pwaShortTextBlockRebrandly"){
    //Shorten links embeded in a text block
    require_once './controllers/shortTextBlock.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    #Must be YYYY-MM-dd hh:mm
    #Ex 2020-03-03 19:05
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
   
    if (!isset($_POST["textBlock"]) ||  $_POST["textBlock"] == "" || $_POST["textBlock"] == null) {
        $emptyFields[]="textBlock";
    }
    if (count($emptyFields)==0) {
        $textBlock = $_POST["textBlock"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $emptyFields;
        $shortLog->writeShortLog($_POST['action']." ".$textBlock ." ".$cid." ".$time);
        $shortLinkProvider = 1;
        if($textBlock =  shortTextBlock($textBlock,$cid,$time,$shortLinkProvider)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$textBlock);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="shortTextBlockBitly"){
    //Shorten links embeded in a text block
    require_once './controllers/shortTextBlock.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    #Must be YYYY-MM-dd hh:mm
    #Ex 2020-03-03 19:05
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["textBlock"]) ||  $_POST["textBlock"] == "" || $_POST["textBlock"] == null) {
        $emptyFields[]="textBlock";
    }
    if (count($emptyFields)==0) {
        $textBlock = $_POST["textBlock"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $emptyFields;
        $shortLog->writeShortLog($_POST['action']." ".$textBlock ." ".$cid." ".$time);
        $shortLinkProvider = 2;
        if($textBlock =  shortTextBlock($textBlock,$cid,$time,$shortLinkProvider)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$textBlock);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="shortTextBlockCustomDomain"){
    //Shorten links embeded in a text block
    require_once './controllers/shortTextBlock.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    #Must be YYYY-MM-dd hh:mm
    #Ex 2020-03-03 19:05
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["textBlock"]) ||  $_POST["textBlock"] == "" || $_POST["textBlock"] == null) {
        $emptyFields[]="textBlock";
    }
    if (count($emptyFields)==0) {
        $textBlock = $_POST["textBlock"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $emptyFields;
        $shortLog->writeShortLog($_POST['action']." ".$textBlock ." ".$cid." ".$time);
        $shortLinkProvider = 3;
        if($textBlock =  shortTextBlock($textBlock,$cid,$time,$shortLinkProvider)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$textBlock);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="pwaShortLinks"){
    //Shorten PWA links 
    require_once './controllers/shortPWALink.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["phone"]) ||  $_POST["phone"] == "" || $_POST["phone"] == null) {
        $emptyFields[]="phone";
    }
    if (!isset($_POST["rid"]) ||  $_POST["rid"] == "" || $_POST["rid"] == null) {
        $emptyFields[]="rid";
    }
    
    if (count($emptyFields)==0) {
        $phone = $_POST["phone"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $rid = $_POST["rid"];

        #$loyaltyURL = $_POST["loyaltyURL"];

        $emptyFields;
        $shortLog->writeShortLog($_POST['action']." ".$phone ." ".$cid." ".$time." ".$rid);

        if($textBlock =  shortPWALink($phone,$cid,$time, $rid)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$phone);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="pwaShortLinksBulk"){
    //Shorten PWA links 
    require_once './controllers/shortPWALink.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["phone"]) ||  $_POST["phone"] == "" || $_POST["phone"] == null) {
        $emptyFields[]="phone";
    }
    if (!isset($_POST["rid"]) ||  $_POST["rid"] == "" || $_POST["rid"] == null) {
        $emptyFields[]="rid";
    }
    
    if (count($emptyFields)==0) {
        $phone = $_POST["phone"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];
        $rid = $_POST["rid"];

        #$loyaltyURL = $_POST["loyaltyURL"];

        $emptyFields;
        $jsonPhoneArray = json_decode($phone);
        //print_r($jsonPhoneArray);
       // $shortLog->writeShortLog($_POST['action']." ".$phone ." ".$cid." ".$time." ".$rid);

        if($textBlock =  shortPWALink($jsonPhoneArray,$cid,$time, $rid)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$phone);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="pwaShortLinksPreview"){
    //Shorten PWA links 
    require_once './controllers/shortPWALink.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    if (!isset($_POST["time"]) ||  $_POST["time"] == "" || $_POST["time"] == null) {
        $emptyFields[]="time";
    }
    if (!isset($_POST["phone"]) ||  $_POST["phone"] == "" || $_POST["phone"] == null) {
        $emptyFields[]="phone";
    }
    
    
    if (count($emptyFields)==0) {
        $phone = $_POST["phone"];
        $cid = $_POST["cid"];
        $time = $_POST["time"];

        #$loyaltyURL = $_POST["loyaltyURL"];

        $emptyFields;
        //$shortLog->writeShortLog($_POST['action']." ".$phone ." ".$cid." ".$time);

        if($textBlock =  shortPWALinkPreview($phone,$cid,$time)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$phone);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_POST['action']) && $_POST['action']=="pwaShortLinksCustomDomain"){
    //Shorten PWA links 
    require_once './controllers/shortPWALink.php';


    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    }
    if (!isset($_POST["long_url"]) ||  $_POST["long_url"] == "" || $_POST["long_url"] == null) {
        $emptyFields[]="long_url";
    }
    if (!isset($_POST["domainName"]) ||  $_POST["domainName"] == "" || $_POST["domainName"] == null) {
        $emptyFields[]="domainName";
    }
    if (!isset($_POST["domainId"]) ||  $_POST["domainId"] == "" || $_POST["domainId"] == null) {
        $emptyFields[]="domainId";
    }
  
    if (count($emptyFields)==0) {
        $cid = $_POST["cid"];
        $long_url = $_POST["long_url"];
        $domainName = $_POST["domainName"];
        $domainId = $_POST["domainId"];

        #$loyaltyURL = $_POST["loyaltyURL"];

        $emptyFields;
        //$shortLog->writeShortLog($_POST['action']." ".$phone ." ".$cid." ".$time." ".$rid);

        if($textBlock =  shortPWAWithCustomDomain($cid,$long_url,$domainName, $domainId)){
            echo  returnDataToCLient(SUCCESS_STATE,OK,"Shorted",null,$textBlock);
        }else{
            echo  returnDataToCLient(ERROR_STATE,INTERNAL_SERVER_ERROR,"Error shorten",null,$phone);
        }
    }else{
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }
    
    
} else if(isset($_GET['action']) && $_GET['action']=="shortener") {
    //Redirect shortLink
    require_once './controllers/redirect.php';
    $shortCode = $_GET["cstlnk"];
    $badRequests = array("wp-admin", "wordpress", "admin", "config");
    if (in_array($shortCode, $badRequests)){
        echo "What are you looking for? <br> <b>By</b><br>" .
        '<img src="https://crm.sprout.online/images/logo-sprout-v2.png" style="width:104px">';
        return; 
    }
       
  
    if($URL = redirectByCode($shortCode)){
            
            if (setClickPWAByID($URL['id_short_url'])) {
                /*echo " 
                <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>
                <script>
                window.onload = getIpClient;
            
                async function getIpClient() {
                    try {
                    const response = await axios.get('https://ipinfo.io?token=49dce08618c17b');
                    console.log(response);
                    
                    setData(response.data.city, response.data.country,  response.data.ip, isMobile.any ? 'Mobile' : 'Desktop')
                    } catch (error) {
                    console.error(error);
                    }
                }

                async function setData(city, country, ip, device) {
                    try {
                    const response = await axios.get('".SHORTENER_URL."?action=setData&city='+city+'&country='+country+'&ip='+ip+'&device='+device+'&id_shortlink=".$URL['id_short_url']."');
                    console.log(response);
                    window.location.href = '".$URL['complete_url']."';
                    } catch (error) {
                    console.error(error);
                    }
                }

                </script>
                    
                <script>$isPhone</script>";*/

                echo "  
                <script>
                window.location.href = '".$URL['complete_url']."';
                window.onload = updateClock;
                var totalTime = 0;
                function updateClock() {
                    document.getElementById('countdown').innerHTML = totalTime;
                    if(totalTime==0){
                        window.location.href = '".$URL['complete_url']."';
                    }else{
                    totalTime-=1;
                    setTimeout('updateClock()',1000);
                    }
                }
                </script>";
                
               
                echo  "Can't set stats in this shortcode ".$shortCode;
            } else {
                echo "  
                <script>
                window.location.href = '".$URL['complete_url']."';
                window.onload = updateClock;
                var totalTime = 0;
                function updateClock() {
                    document.getElementById('countdown').innerHTML = totalTime;
                    if(totalTime==0){
                        window.location.href = '".$URL['complete_url']."';
                    }else{
                    totalTime-=1;
                    setTimeout('updateClock()',1000);
                    }
                }
                </script>";
                
                echo  "Can't set stats in this shortcode ".$shortCode;
            }
        } else {
            echo "This shortLink doesn't exist ".$URL.$shortCode;
        } 
    
} else if(isset($_POST['action']) && $_POST['action']=="getShortLinkDataByRid"){
    require_once './controllers/shortLinkData.php';
    if (!isset($_POST["rid"]) ||  $_POST["rid"] == "" ||  $_POST["rid"] == null) {
        $emptyFields[]="rid";
    } 
   
    if (count($emptyFields)==0) {
        $rid = $_POST["rid"];
        if( $result = rippleTextSms($rid)) {
            
            // If topHours not exists will create an empty array.
            if (empty($result["topHours"])) {
                $result["topHours"] = [];
            }

            $result["topHours"] = convertHoursToTimeZone( $result["clientData"]["tmzn"], $result["topHours"]);
            echo $result = returnDataToCLient(SUCCESS_STATE,OK,"Success",null,$result);
        }
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }

} else if(isset($_POST['action']) && $_POST['action']=="getShortlinkDataByCid"){
    require_once './controllers/shortLinkData.php';
    if (!isset($_POST["cid"]) ||  $_POST["cid"] == "" ||  $_POST["cid"] == null) {
        $emptyFields[]="cid";
    } 
    if (!isset($_POST["date_lapsus"]) ||  $_POST["date_lapsus"] == "" ||  $_POST["date_lapsus"] == null) {
        $emptyFields[]="date_lapsus";
    } 
    if (!isset($_POST["client_date"]) ||  $_POST["client_date"] == "" ||  $_POST["client_date"] == null) {
        $emptyFields[]="client_date";
    }

    $toDate = null;
    if (count($emptyFields)==0) {
        $cid = $_POST["cid"];
        $dateLapsus = $_POST["date_lapsus"];
        $clientDate = $_POST["client_date"];

        if (isset($_POST["from_date"])) {
            $toDate = $_POST["from_date"];
        }

        echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null, getCidCampaignsData($cid, $dateLapsus, $clientDate, $toDate));
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }

} else if(isset($_POST['action']) && $_POST['action']=="getRidByShortlink"){
    require_once './controllers/shortLinkData.php';
    if (!isset($_POST["url"]) ||  $_POST["url"] == "" ||  $_POST["url"] == null) {
        $emptyFields[]="url";
    } 
    
    if (count($emptyFields)==0) {
        $url = $_POST["url"];

        echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null,getRidByUrl($url));
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }

} else if(isset($_POST['action']) && $_POST['action']=="getRandomCode"){
    require_once './controllers/shortLinkData.php';
    if (!isset($_POST["url"]) ||  $_POST["url"] == "" ||  $_POST["url"] == null) {
        $emptyFields[]="url";
    } 
    
    if (count($emptyFields)==0) {
        $url = $_POST["url"];

        echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null,getRandomCodeByUrl(verifyShortedLinks($url)[0]));
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }

} else if(isset($_POST['action']) && $_POST['action']=="setClickByRandomCode"){
    require_once './controllers/shortLinkData.php';
    if (!isset($_POST["randomCode"]) ||  $_POST["randomCode"] == "" ||  $_POST["randomCode"] == null) {
        $emptyFields[]="randomCode";
    } 
    if (!isset($_POST["phn"]) ||  $_POST["phn"] == "" ||  $_POST["phn"] == null) {
        $emptyFields[]="phn";
    } 
    
    if (count($emptyFields)==0) {
        $randomCode = $_POST["randomCode"];
        $phn = $_POST["phn"];


        echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null,verifyRandomAndSetClick($randomCode, $phn));
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }

} else if(isset($_GET['action']) && $_GET['action']=="setData"){
    require_once './controllers/shortLinkData.php';

    if (!isset($_GET["id_shortlink"]) ||  $_GET["id_shortlink"] == "" ||  $_GET["id_shortlink"] == null) {
        $emptyFields[]="id_shortlink";
    }  

    if (count($emptyFields)==0) {
        $id_shortlink = $_GET["id_shortlink"];
        echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null,setClicskWithData($_GET));
    } else {
        echo  returnDataToCLient(ERROR_STATE,CONFLICT,"Empty fields",null,$emptyFields);
    }



    print_r($_GET);  

}  else if(isset($_GET['action']) && $_GET['action']=="getCurrentDomains"){
   
       // echo  returnDataToCLient(SUCCESS_STATE,OK,"Success",null,setClicskWithData($_GET));
   
       $csv = array_map("str_getcsv", file("ripples3.csv")); 
        $header = array_shift($csv); 
        // Seperate the header from data

        $col = array_search("txt", $header, true); 
        $flag = 0;
        $sproutDomainCounter = 0;
        $rebrandlyCounter = 0;

        //foreach ($csv as $row) {
            if (($open = fopen("ripples3.csv", "r")) !== FALSE) 
            {
            
              while (($row = fgetcsv($open, 1000, ";")) !== FALSE) 
              {     
            $flag ++;     
            
            echo "<Br>";
            echo $row[0];
            $SproutDomains = ["mobevip.org","mobevip.info","mobevip.com","mobevip.net","moreinf.online","wmloyalty.link","mobevip.click","mobevip.link","mobevip.live","loylty.click","loylty.live","loylty.online","loylty.link","rewardm.click","mobevip.online","rewardm.link","mobevip.news","wmrewards.live","loyaltywm.live","loyaltywm.online","loyaltywm.today","loyaltywm.click","loyaltywm.news","wmloyalty.online","loyaltywm.link","wmloyalty.today","wmloyalty.live","loyaltywm.fyi","wmloyalty.news","rewardm.today","loylty.today","wmloyalty.fyi","wmloyalty.click","loylty.fyi","rewardm.news","rewardm.fyi","rewardm.liv","bttlecreek.link","baycity.click","dnkonarrival.click","fivedime.click","motownm.click","remedii.click","shakebake.click","stateline.click","thestation.click","thestation.link"];
            foreach ($SproutDomains as $key => $value) {
                if(strpos($row[$col], $value)){
                    echo ";BrandedDomains;"; 
                    $sproutDomainCounter++;
                }
            }
            
            if(strpos($row[$col], "rebrand.ly")){
                echo ";rebrandly; "; 
                $rebrandlyCounter++;
            } else { 
                echo ";NoLinkDetected; "; 
            }

            
            if ($flag == 10000) {
                return false;
            }
        }

    }


} else {
   returnDataToCLient(WARNING_STATE,OK,"Nothing to do",null,null);
}


