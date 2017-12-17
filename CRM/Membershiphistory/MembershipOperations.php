<?php
/**
 * This class is a static class to perform general operations
 * related to `Membershiphistory` extension.
 *
 * @author Abhijeet Bagul<abhijeet.bagul@gmail.com>
 * Date: 7th December, 2017
 */
class CRM_Membershiphistory_MembershipOperations
{
  



    /**
     * This method is get fetch information from {membership} table and used as
     * input to membership history listing.
     *
     * @param int membership id
     *
     * @return array
     */
    function _membershiphistory_get_member_info( ) 
    {
        $return = array( );

        // -- generate where clause.
        {
            $sql = "SELECT a.*, b.source, b.net_amount,b.receive_date,b.currency
                FROM civirenewmebership_term a LEFT JOIN civicrm_contribution b ON a.contribution_id = b.id
                WHERE a.contact_id = " . ( ! empty( $this->_id ) ? $this->_id : "-1" ) . " and a.membership_id = " . ( ! empty( $this->_mid ) ? $this->_mid : "-1" ) . " ORDER BY a.id DESC;";

            $dao = CRM_Core_DAO::executeQuery( $sql, array( ) );

            while( $dao->fetch( ) )
            {
              $return[ ] = array( 
                
            // -- table - civirenewmebership_term
            'id'        => $dao->id, 
            'contact_id'    => $dao->contact_id, 
            'membership_id'   => $dao->start_date, 
            'start_date'    => $dao->start_date, 
            'end_date'      => $dao->end_date, 
            'contribution_id'   => $dao->contribution_id,

            // -- table - civirenewmebership_term
            'source'      => $dao->source,
            'net_amount'    => $dao->net_amount,
            'receive_date'    => $dao->receive_date,
            'currency'      => $dao->currency,
          );
            }

        }

        return $return;
    }
    
    // -- ------------------------------------------------------------------------------

    /**
     * This method is record membership information.
     *
     * @param int membership id
     *
     * @return array
     */
    public static function _membershiphistory_record( $membership_id ) 
    {
        if( ! empty( $membership_id ) )
        {

          // -- ----------------------------------------------
          // -- fetch membership information from database.
          // -- ----------------------------------------------
          $sql              = "SELECT contact_id, start_date, end_date FROM `civicrm_membership` WHERE id = " . $membership_id . " LIMIT 1;";
          $membership_info  = CRM_Core_DAO::executeQuery( $sql, array( ) );
          $membership_info->fetch( );
          // -- ----------------------------------------------


          // -- ----------------------------------------------
          // -- insert membership term into database.
          // -- ----------------------------------------------
          return self::_membershiphistory_insert_member_info( array(
                "contact_id"    => $membership_info->contact_id,
                "membership_id" => $membership_id,
                "start_date"    => $membership_info->start_date,
                "end_date"      => $membership_info->end_date
            ) );
          // -- ----------------------------------------------

        }
    }

    // -- -------------------------------------------------------------------------------------------------

    /**
     * This method is record membership information.
     *
     * @param int membership id
     *
     * @return array
     */
    public static function _membershiphistory_delete( $membership_id ) 
    {
        if( ! empty( $membership_id ) )
        {
          // -- ----------------------------------------------
          // -- delete membership related all information.
          // -- ----------------------------------------------
          $sql = "DELETE FROM `civirenewmebership_term` WHERE membership_id = " . $membership_id . ";";
          CRM_Core_DAO::executeQuery( $sql, array( ) );
          // -- ----------------------------------------------

        }
    }

    // -- -------------------------------------------------------------------------------------------------
  
    /**
     * This method is to update contribution information into {civirenewmebership_term} table,
     * base on contact id and membership id, for that last recod from {civirenewmebership_term} table
     * is taken and updated with contribution id.
     *
     * @param int membership id
     * @param int contribution id
     *
     * @return array
     */
    public static function _membershiphistory_update_contribution( $membership_id, $contribution ) 
    {
        if( ! empty( $membership_id ) )
        {

          // -- ----------------------------------------------
          // -- fetch civirenewmebership_term information from database.
          // -- ----------------------------------------------
          $sql = "SELECT id FROM `civirenewmebership_term` WHERE membership_id = " . $membership_id . " ORDER BY id DESC LIMIT 1;";
          $id  = CRM_Core_DAO::singleValueQuery( $sql, array( ) );
          // -- ----------------------------------------------


          // -- ----------------------------------------------
          // -- update contribution id in civirenewmebership_term table
          // -- ----------------------------------------------
          $sql = "UPDATE `civirenewmebership_term` SET contribution_id = '" . $contribution . "' WHERE id = '" . $id . "' LIMIT 1;";
          CRM_Core_DAO::executeQuery( $sql, array( ) );
          // -- ----------------------------------------------

        }
    }

    // -- ------------------------------------------------------------------------------------

    /**
     * This method is get store information in {civirenewmebership_term} table
     *
     * @param array 
     *
     * @return void
     */
    public static function _membershiphistory_insert_member_info( $param ) 
    {

        $sql = "SELECT count(id) as count FROM `civirenewmebership_term` WHERE 
                  contact_id = '" . $param[ 'contact_id' ] . "' AND 
                    membership_id = '" . $param[ 'membership_id' ] . "' AND 
                        start_date = '" . $param[ 'start_date' ] . "' AND 
                          end_date = '" . $param[ 'end_date' ] . "';";

        if( ! CRM_Core_DAO::singleValueQuery($sql, array( ) ) )
        {
            $sql = "INSERT INTO 
                `civirenewmebership_term`
                ( `contact_id`, `membership_id`, `contribution_id`, `start_date`, `end_date` ) 
                VALUES
                ( " . $param[ 'contact_id' ] . ", " . $param[ 'membership_id' ] . ", '', '" . $param[ 'start_date' ] . "', '" . $param[ 'end_date' ] . "' );";

            CRM_Core_DAO::executeQuery( $sql, array( ) );

            return true;
        }

        return false;
    }
}