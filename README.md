# Magento (v1): Payone Postponed Online Capture (for Payolution Payments)
This extension extends the [Payone Payment extension](https://github.com/PAYONE-GmbH/magento-1) with an postponed capture functionality. This is necessary as some payment provides (e.g. Payolution Debit) just reserve a payment and require to actually capture the amount only **after shipment**.
The extension listens to the *shipment_saved_after* event and then checks if a capture has to be set. 

## Installation

### Modman
You can easily clone this repo with modman. Learn more in the modman wiki at https://github.com/colinmollenhour/modman/wiki/Tutorial

```
$ modman clone https://github.com/trendmarke-gmbh/magento1_extendend_zip_validation
```

### Manual installation
Alternatively you can download the repo and transfer the content of the src directory into your Magento root directory. After the installation clear the cache and that's it.

## Configuration
You find the configuration as a new section at Payone Extensions. You can set:
* **Capture Payolution on Shipping:** Activate the automatic capture of Payolution payments after shipment was created

## Customization
Feel free to edit and change the extensions as you wish. You can easily extend the logic to other payment methods by adding them to the observer method. Moreover, the capture function also supports offline captures necessary.

## Notes and Credits
- This extension was tested with Magento 1.9.x but it should also work with older versions (probably till 1.4.x).