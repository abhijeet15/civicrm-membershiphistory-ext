<?php
use CRM_Membershiphistory_ExtensionUtil as E;

class CRM_Membershiphistory_Page_MembershipHistory extends CRM_Core_Page {

	public function run()
	{

		// -- access url vaiable.
		$this->_id = CRM_Utils_Request::retrieve('cid', 'Positive', $this, FALSE);
		$this->_mid = CRM_Utils_Request::retrieve('mid', 'Positive', $this, FALSE);

		// -- replace token templates.
		CRM_Utils_System::setTitle( E::ts('MembershipHistory') );
		$this->assign('rows', CRM_Membershiphistory_MembershipOperations::_membershiphistory_get_member_info( ) );

		parent::run();

	}

}
