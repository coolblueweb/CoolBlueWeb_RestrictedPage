<?php
class CoolBlueWeb_RestrictedPage_Helper_Data extends Mage_Core_Helper_Abstract {

	/**
	 *	Check Customers Access Level
	 */
	public function customerCanAccessPage() {
		return false;
	}
}