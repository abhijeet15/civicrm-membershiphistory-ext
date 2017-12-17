{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.6                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2015                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*}


{if $rows}
  <div id="discount-list">
    {strip}
      {* handle enable/disable actions *}
      {include file="CRM/common/enableDisableApi.tpl"}
      {include file="CRM/common/jsortable.tpl"}
      <table id="options" class="display">
        <thead>
        <tr>
          <th id="sortable">{ts}Source{/ts}</th>
          <th>{ts}Membership Start Date{/ts}</th>
          <th>{ts}Membership End Date{/ts}</th>
          <th>{ts}Receive Date{/ts}</th>
          <th>{ts}Amount{/ts}</th>
          <th>{ts}Contribution{/ts}</th>
        </tr>
        </thead>
        {foreach from=$rows item=row}
          <tr id="discount_code-{$row.id}" class="crm-entity {$row.class}{if NOT $row.is_active} disabled{/if}">
            <td class="crm-discount-code"> {if $row.source}{$row.source}{else}--{/if}</td>
            <td>{$row.start_date}</td>
            <td>{$row.end_date}</td>
            <td class="right">{if $row.receive_date}{$row.receive_date}{else}--{/if}</td>
            <td class="right">{if $row.net_amount}{$row.currency} {$row.net_amount}{else}--{/if}</td>
            
            <td>
            {if $row.contribution_id}
              <a href="{crmURL p='civicrm/contact/view/contribution' q="reset=1&id=`$row.contribution_id`&cid=`$row.contact_id`&action=view&context=contribution&selectedChild=contribute"}" class="action-item crm-hover-button" target="_blank" title="View Contribution">View</a>
            {else}
              --
            {/if}
            </td>
          </tr>
        {/foreach}
      </table>
    {/strip}
  </div>
{else}
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>
    {ts}There are no membership history.{/ts}
  </div>
{/if}
