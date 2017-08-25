<?php
namespace Craft;

class PriceSwitcherPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Price Switcher');
    }

    public function getDescription()
    {
        return "Switches the price of a lineitem when it is added to the cart, checking for alternative custom price fields.";
    }

    function getVersion()
    {
        return '0.1';
    }

    function getDeveloper()
    {
        return 'Clive Portman';
    }

    function getDeveloperUrl()
    {
        return 'https://cliveportman.co.uk';
    }    
    
    public function init()
    {
        parent::init();

        craft()->on('commerce_lineItems.onPopulateLineItem', function($event){

            $purchasable= $event->params['purchasable'];
            $lineItem = $event->params['lineItem'];
            $cart = craft()->commerce_cart->getCart();

            // NOT SURE WHY, BUT SWITCH WASN'T WORKING HERE
            if ($cart->paymentCurrency == 'USD') {
                if (!empty($purchasable->usdPrice)) {
                    $lineItem->price = $purchasable->usdPrice;
                }
            }
            if ($cart->paymentCurrency == 'NZD') {
                if (!empty($purchasable->nzdPrice)) {
                    $lineItem->price = $purchasable->nzdPrice;
                }
            }
            if ($cart->paymentCurrency == 'AUD') {
                if (!empty($purchasable->audPrice)) {
                    $lineItem->price = $purchasable->audPrice;
                }
            }
            if ($cart->paymentCurrency == 'EUR') {
                if (!empty($purchasable->eurPrice)) {
                    $lineItem->price = $purchasable->eurPrice;
                }
            }
            if ($cart->paymentCurrency == 'CAD') {
                if (!empty($purchasable->cadPrice)) {
                    $lineItem->price = $purchasable->cadPrice;
                }
            }

        });
    }
    

}