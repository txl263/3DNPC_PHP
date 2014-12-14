<?php

$xml=new DOMDocument();
$xml->loadXML('<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
    <soap:Body>
        <VersionResponse xmlns="http://www.securefreedom.com/">
            <VersionResult  List="0">
                <RequestID>0</RequestID>
                <Success>1</Success>
                <Message>3.0</Message>
            </VersionResult>
        </VersionResponse>
    </soap:Body>
</soap:Envelope>');
$VersionResultDom = $xml->getElementsByTagName("VersionResult");
foreach($VersionResultDom as $ResultDom){
    $Message = $ResultDom->getElementsByTagName("Message");
    echo "Message: " . $Message->item(0)->nodeValue ;
    $Success = $ResultDom->getElementsByTagName("Success");
    echo "Success: " . $Success->item(0)->nodeValue ;
}
?>