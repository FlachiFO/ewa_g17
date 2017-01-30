<?php

$bankleitzahl = $_GET["blz"];

interface BLZAdapterInterface
{
  /**
   * Funktion getBank.
   * 
   * @param string $bankleitzahl
   * @return stdClass
   **/
  public function getBank($bankleitzahl);
}

class BLZAdapter implements BLZAdapterInterface
{
  protected $soapclient = null;
  
  public function __construct()
  {
    $wsdl = 'http://www.thomas-bayer.com/axis2/services/BLZService?wsdl';
    $this->soapclient = new SoapClient($wsdl);
  }
  
  public function getBank($bankleitzahl)
  {
     return $this->soapclient->getBank(array('blz'=>$bankleitzahl))->details; 
  }
}

class BLZAdapterCacheDecorator implements BLZAdapterInterface
{
    protected $service = null;
    protected $cache   = array();

    public function __construct(BLZAdapterInterface $service)
    {
      $this->service = $service; 
    }
      
    public function getBank($bankleitzahl)
    {
       if(empty($this->cache[$bankleitzahl]))
          $this->cache[$bankleitzahl] = $this->service->getBank($bankleitzahl);
       return  $this->cache[$bankleitzahl]; 
    }
}

#$bankleitzahl = '12070000'; // testdaten
$service      = new BLZAdapterCacheDecorator(new BLZAdapter);

?>
<h3>Ihre Bank</h3>
Bankleitzahl: <?php echo $bankleitzahl ?> <br> 
Name der Bank: <?php echo $service->getBank($bankleitzahl)->bezeichnung ?> <br>
BIC: <?php echo $service->getBank($bankleitzahl)->bic ?> <br>
Postleitzahl: <?php echo $service->getBank($bankleitzahl)->plz ?> <br>
Ort: <?php echo $service->getBank($bankleitzahl)->ort ?> <br>
<a href="javascript:history.back()"><br>Zur&uuml;ck</a>