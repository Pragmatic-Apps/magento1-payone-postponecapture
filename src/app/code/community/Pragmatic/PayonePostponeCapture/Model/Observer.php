<?php
class Pragmatic_PayonePostponeCapture_Model_Observer
{

    /**
     * After shipment created check if postponed capture is necessary
     * @param Varien_Event_Observer $observer
     */
    public function postponeCapture(Varien_Event_Observer $observer)
    {
        if (Mage::getStoreConfigFlag('payoneext_postpone/postponed_capture/payolution')) {
            $shipment = $observer->getEvent()->getShipment();
            $order = $shipment->getOrder();
            $payment = $order->getPayment();
            if (in_array($payment->getMethodInstance()->getCode(),array('payone_payolution_installment','payone_payolution_debit')))
            { // is payolution payment?
                $invoiceCollection = $order->getInvoiceCollection();
                foreach($invoiceCollection as $invoice) { // try to capture all existing invoices to this order
                    Mage::helper('pragmatic_payonepostponecapture')->capture($invoice);
                }
            }
        }
    }

}
