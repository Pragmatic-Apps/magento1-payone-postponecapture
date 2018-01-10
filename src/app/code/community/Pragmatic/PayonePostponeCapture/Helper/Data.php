<?php
class Pragmatic_PayonePostponeCapture_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Capture a invoice
     * @param $invoice
     * @param string $mode
     */
    public function capture($invoice,$mode="online") {
        if (is_int($invoice)) { // if id give initialize invoice object
            $invoice = Mage::getModel('sales/order_invoice')->load($invoice);
        }
        if ($mode=="online") { // capture online and tell payone about it
            try {
                $invoice->capture();
                $this->_saveInvoice($invoice);
                return true;
            } catch (Exception $e) {
                Mage::log("Could not capture online Order ".$invoice->getOrder()->getIncrementId());
                return false; // something went wrong
            }
        } else { // just capture offline that order can be fruther processed in magento
            try {
                $invoice->setRequestedCaptureCase('offline')->setCanVoidFlag(false)->pay();
                $transactionSave = Mage::getModel('core/resource_transaction')
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder());
                $transactionSave->save();
                return true;
            } catch (Exception $e) {
                Mage::log("Could not capture offline Order ".$invoice->getOrder()->getIncrementId());
                return false; // something went wrong
            }
        }
    }

}
	 