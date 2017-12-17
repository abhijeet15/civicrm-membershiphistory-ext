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
  

    // -- ------------------------------------------------------------------------------------

    /**
     * This method is get fetch information from {membership} table.
     *
     * @param int membership id
     *
     * @return array
     */
    public static function _membershiphistory_get_member_info( $membership_id ) 
    {
        $arrClause = $return = array( );

        // -- generate where clause.
        if( ! empty( $membership_id ) )
        {
            echo "\n".$sql = "SELECT contact_id, start_date, end_date
                FROM civicrm_membership
                WHERE id = " . $membership_id . " LIMIT 1;";

            $dao = CRM_Core_DAO::executeQuery( $sql, array( ) );

            $dao->fetch( );

            $return = array( 'contact_id' => $dao->contact_id, 'start_date' => $dao->start_date, 'end_date' => $dao->end_date );
        }

        return $return;
    }

    // -- ------------------------------------------------------------------------------------

    /**
     * This method is get store information in {civicrm_membership} table
     *
     * @param array 
     *
     * @return void
     */
    public static function _membershiphistory_insert_member_info( $param ) 
    {
        if( ! self::_membershiphistory_check_duplicate_term( $param ) )
        {
            echo "\n".$sql = "INSERT INTO 
                `civirenewmebership_term`
                ( `contact_id`, `membership_id`, `contribution_id`, `start_date`, `end_date` ) 
                VALUES
                ( " . $param[ 'contact_id' ] . ", " . $param[ 'membership_id' ] . ", " . $param[ 'contribution_id' ] . ", '" . $param[ 'start_date' ] . "', '" . $param[ 'end_date' ] . "' );";

            CRM_Core_DAO::executeQuery( $sql, array( ) );
        }
    }

    // -- ------------------------------------------------------------------------------------

    /**
     * This method is get check duplcaite record in {civicrm_membership} table
     *
     * @param array 
     *
     * @return int
     */
    public static function _membershiphistory_check_duplicate_term( $param ) {

      $count = false;

      if( ! empty( $param ) )
      {
          echo "\n". $sql = "SELECT 
                count(id) as count FROM civirenewmebership_term 
              WHERE 
                contact_id = '" . $param[ 'contact_id' ] . "' AND
                membership_id = '" . $param[ 'membership_id' ] . "' AND
                contribution_id = '" . $param[ 'contribution_id' ] . "' AND
                start_date = '" . $param[ 'start_date' ] . "' AND
                end_date = '" . $param[ 'end_date' ] . "';";
          $count = CRM_Core_DAO::singleValueQuery($sql, array());
      }

      return $count;

    }
}