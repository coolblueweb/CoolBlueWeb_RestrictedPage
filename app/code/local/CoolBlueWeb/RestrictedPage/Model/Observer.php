<?php
class CoolBlueWeb_RestrictedPage_Model_Observer {
	
	/**
	 *	Function Hit by Frontend Controller Event
	 */
	public function canAccessPage(Varien_Event_Observer $observer) {
    	$cms_page = Mage::getModel('cms/page')->load($observer->getControllerAction()->getRequest()->getParam('page_id'));
		if ( (bool)$cms_page->getIsRestricted() ) {
			if ( !Mage::helper('restricted_page')->customerCanAccessPage() ) {
				$response_url = Mage::getUrl('restricted_page/index/password/', array('page_id' => $cms_page->getId()));
				Mage::app()->getResponse()->setRedirect($response_url);
			}
		}
		return;	
	}

	/**
	 *	Add Fields to CMS Page
	 */
	public function addCmsFields($observer) {
		$cms_model = Mage::registry('cms_page');
		$cms_form = $observer->getForm();
		$fieldset = $cms_form->addFieldSet('coolblueweb_restriction_fieldset', array('legend' => Mage::helper('cms')->__('Restriction Settings'), 'class' => 'fieldset-wide'));

		$fieldset->addField('is_restricted', 'select', array(
			'name'		=>		'is_restricted',
			'label'		=>		Mage::helper('cms')->__('Enable Password Restriction'),
			'title'		=>		Mage::helper('cms')->__('Enable Password Restriction'),
			'disabled'	=>		false,
			'value'		=>		$cms_model->getIsRestricted(),
			'values'	=>		array(0 => 'No', 1 => 'Yes'),
		));

		$fieldset->addField('restriction_password', 'password', array(
			'name'		=>		'restriction_password',
			'label'		=>		Mage::helper('cms')->__('Restriction Password'),
			'title'		=>		Mage::helper('cms')->__('Restriction Password'),
			'disabled'	=>		false,
			'value'		=>		$cms_model->getRestrictionPassword()
		));

	}
}