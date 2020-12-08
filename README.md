# worldpay-wpg
Connect to the Worldpay API.

#### Installation

##### Composer
```
composer require thanhvo-cse/worldpay
```
##### Event
- Define your observer:
```php
use ThanhVo\Worldpay\WPG\Client;

class BeforeRequestListener implements ThanhVo\Worldpay\Event\ObserverInterface
{
/**
     * @return string
     */
    public function getSubject(): string
    {
        return Client::EVENT_BEFORE_REQUEST;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function onEvent($data)
    {
        // Handle your Observer here
        var_dump($data);
    }
}
```
- Add your observer
```php
$hosted = new \ThanhVo\Worldpay\WPG\Service\Hosted();
$beforeObserver = new BeforeRequestListener();
$hosted->addEventObserver($hosted);
...
```
##### Event list
- before_request
- after_response

#### Documentation
https://developer.worldpay.com/docs/wpg

#### Sample
The sample is located in sample directory. Please find the readme file in there.
