<?php

require_once 'membershiphistory.civix.php';
use CRM_Membershiphistory_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function membershiphistory_civicrm_config(&$config) {
  _membershiphistory_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function membershiphistory_civicrm_xmlMenu(&$files) {
  _membershiphistory_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function membershiphistory_civicrm_install() {
  _membershiphistory_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function membershiphistory_civicrm_postInstall() {
  _membershiphistory_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function membershiphistory_civicrm_uninstall() {
  _membershiphistory_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function membershiphistory_civicrm_enable() {
  _membershiphistory_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function membershiphistory_civicrm_disable() {
  _membershiphistory_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function membershiphistory_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _membershiphistory_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function membershiphistory_civicrm_managed(&$entities) {
  _membershiphistory_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function membershiphistory_civicrm_caseTypes(&$caseTypes) {
  _membershiphistory_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function membershiphistory_civicrm_angularModules(&$angularModules) {
  _membershiphistory_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function membershiphistory_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _membershiphistory_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * [ CUSTOM HOOK ]
 *
 * This mothod is post hook, written for Renew Membership to store 
 * membership information and contribution relation.
 * Here we are storing membership history in 2 steps, [1] - when we get
 * 'Membership' post call that time we insert membersip information in
 * {civirenewmebership_term} table, [2] - when we get 'Contribution' post
 * call then we fetch last inserted membership from database base on conatct id
 * and membership id and update contribution infomation.
 */

function membershiphistory_civicrm_post($op, $objectName, $objectId, &$objectRef)
{
  switch ( $objectName ) 
  {
      case 'Membership':
          if( $op == "create" || $op == "edit" )
          {
              // -- Record membership renewal information
              CRM_Membershiphistory_MembershipOperations::_membershiphistory_record( $objectRef->id );
          }
          elseif( $op == "delete" )
          {
              CRM_Membershiphistory_MembershipOperations::_membershiphistory_delete( $objectRef->id );
          }

      break;
      
      case 'MembershipPayment':
          if( $op == "create" || $op == "edit" )
          {
             //  -- upate contibution id.
             CRM_Membershiphistory_MembershipOperations::_membershiphistory_update_contribution( $objectRef->membership_id, $objectRef->contribution_id );
          }

      break;
  }
}

// -- ------------------------------------------------------------------------------------

/**
 * [ CUSTOM HOOK ]
 *
 * This method is to alter membership template,
 * for 'CRM_Member_Page_Tab'.
 *
 * @param string $formName name of the form
 * @param object $form (reference) form object
 * @param string $context page or form
 * @param string $tplName (reference) change this if required to the altered tpl file
 */
function membershiphistory_civicrm_alterTemplateFile($formName, &$form, $context, &$tplName) {

  if( $formName == "CRM_Member_Page_Tab" && $tplName == "CRM/Member/Page/Tab.tpl"  )
  {
    
    $override_tplfile = dirname(__FILE__) . "/templates/CRM/Member/Page/Tab.tpl";
        
    if( file_exists( $override_tplfile  ) ) 
      $tplName = dirname(__FILE__) . "/templates/CRM/Member/Page/Tab.tpl";
  }

  
}