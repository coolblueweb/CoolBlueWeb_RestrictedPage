<?php
class CoolBlueWeb_RestrictedPage_IndexController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {
		$this->_initLayout();
	}

	public function passwordAction() {
		$this->_initLayout();
	}

	public function validateAction() {
		if ( $page_id = Mage::app()->getRequest()->getPost('page_id') ) {
			$cms_page = Mage::getModel('cms/page')->load($page_id);

			if( $cms_page->getRestrictionPassword() == Mage::app()->getRequest()->getPost('password') ) {
				Mage::getSingleton('core/session')->addSuccess(Mage::helper('cms')->__('Password Matches'));
			}
			else {
				Mage::getSingleton('core/session')->addError(Mage::helper('cms')->__('Wrong Password'));
			}

		}
				Mage::getSingleton('core/session')->addSuccess(Mage::helper('cms')->__('Password Matches'));

			// $this->_redirect('restricted_page/index/password');
		$this->_initLayout();

	}

	/**
	 *	Page Load Shortcut
	 */
	protected function _initLayout() {
		return $this->loadLayout()->renderLayout();
	}

	/**
	 * Debug Layout Shortcut
	 */
	protected function _debugLayout() {
		$this->_initLayout();
		Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
	}
}