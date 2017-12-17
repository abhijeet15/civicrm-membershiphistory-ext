<?php

use CRM_Membershiphistory_ExtensionUtil as E;
use Civi\Test\HeadlessInterface;
use Civi\Test\HookInterface;
use Civi\Test\TransactionalInterface;

/**
 * FIXME - Add test description.
 *
 * Tips:
 *  - With HookInterface, you may implement CiviCRM hooks directly in the test class.
 *    Simply create corresponding functions (e.g. "hook_civicrm_post(...)" or similar).
 *  - With TransactionalInterface, any data changes made by setUp() or test****() functions will
 *    rollback automatically -- as long as you don't manipulate schema or truncate tables.
 *    If this test needs to manipulate schema or truncate tables, then either:
 *       a. Do all that using setupHeadless() and Civi\Test.
 *       b. Disable TransactionalInterface, and handle all setup/teardown yourself.
 *
 * @group headless
 */
class CRM_Membershiphistory_MyTest extends \PHPUnit_Framework_TestCase implements HeadlessInterface, HookInterface, TransactionalInterface {

  public function setUpHeadless() {
    // Civi\Test has many helpers, like install(), uninstall(), sql(), and sqlFile().
    // See: https://github.com/civicrm/org.civicrm.testapalooza/blob/master/civi-test.md
    /*return \Civi\Test::headless()
      ->sqlFile(__DIR__ . '/example.sql')
      ->installMe(__DIR__)
      ->apply();*/
  }

  public function setUp() {
    parent::setUp();
  }

  // public function tearDown() {
  //   parent::tearDown();
  // }

  /**
   * This method is to check whether extension is installed
   * correctly or not.
   * At time of installation `civirenewmebership_term` table
   * is created to maintain membership history, so
   * her in below test case we have have whether table is created
   * or not.
   */
  public function testExtensionInstallation( ) {
   
    $sql = "SHOW COLUMNS FROM `civirenewmebership_term`;";

    $membership_info  = CRM_Core_DAO::singleValueQuery( $sql, array( ) );

    $this->assertNotEmpty( $membership_info );
  }

}
