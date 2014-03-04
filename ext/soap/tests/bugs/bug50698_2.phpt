--TEST--
Request #50698_2 (SoapClient should handle wsdls with some incompatiable endpoints -- EDGECASE: Large mix of compatiable and incompatiable endpoints.)
--INI--
soap.wsdl_cache_enabled=0
--FILE--
<?php
try {
    new SoapClient(dirname(__FILE__) . '/bug50698_2.wsdl');
    echo "Call: \"new SoapClient(dirname(__FILE__).'/bug50698_2.wsdl');\" should throw an exception of type 'SoapFault'";
} catch (SoapFault $e) {
    if ($e->faultcode == 'WSDL' && $e->faultstring == 'SOAP-ERROR: Parsing WSDL: Could not find any usable binding services in WSDL.') {
        echo "ok\n";
    } else {
        echo "Call: \"new SoapClient(dirname(__FILE__).'/bug50698_2.wsdl');\" threw a SoapFault with an incorrect faultcode or faultmessage.";
        print_r($e);
    }    
}
?>
--EXPECT--
ok
