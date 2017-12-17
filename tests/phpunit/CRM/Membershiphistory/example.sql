
SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE `civicrm_contact`;
TRUNCATE TABLE `civicrm_membership_type`;
TRUNCATE TABLE `civicrm_membership`;
TRUNCATE TABLE `civirenewmebership_term`;




INSERT INTO `civicrm_contact` (`id`, `contact_type`, `contact_sub_type`, `do_not_email`, `do_not_phone`, `do_not_mail`, `do_not_sms`, `do_not_trade`, `is_opt_out`, `legal_identifier`, `external_identifier`, `sort_name`, `display_name`, `nick_name`, `legal_name`, `image_URL`, `preferred_communication_method`, `preferred_language`, `preferred_mail_format`, `hash`, `api_key`, `source`, `first_name`, `middle_name`, `last_name`, `prefix_id`, `suffix_id`, `formal_title`, `communication_style_id`, `email_greeting_id`, `email_greeting_custom`, `email_greeting_display`, `postal_greeting_id`, `postal_greeting_custom`, `postal_greeting_display`, `addressee_id`, `addressee_custom`, `addressee_display`, `job_title`, `gender_id`, `birth_date`, `is_deceased`, `deceased_date`, `household_name`, `primary_contact_id`, `organization_name`, `sic_code`, `user_unique_id`, `employer_id`, `is_deleted`, `created_date`, `modified_date`) VALUES
(210, 'Individual', NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, 'Bagul, Arnav', 'Mr. Arnav Bagul', 'Arnav', NULL, NULL, NULL, 'en_US', 'Both', '05d487b8e2aa22e2c57c213633a6e3d4', NULL, NULL, 'Arnav', 'Abhijeetjr', 'Bagul', 3, NULL, NULL, 1, 1, NULL, 'Dear Arnav', 1, NULL, 'Dear Arnav', 1, NULL, 'Mr. Arnav Abhijeetjr Bagul', 'Student', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-12-09 13:19:47', '2017-12-09 13:19:47');



INSERT INTO `civicrm_membership_type` (`id`, `domain_id`, `name`, `description`, `member_of_contact_id`, `financial_type_id`, `minimum_fee`, `duration_unit`, `duration_interval`, `period_type`, `fixed_period_start_day`, `fixed_period_rollover_day`, `relationship_type_id`, `relationship_direction`, `max_related`, `visibility`, `weight`, `receipt_text_signup`, `receipt_text_renewal`, `auto_renew`, `is_active`) VALUES
(1, 1, 'General', 'Regular annual membership.', 1, 2, '250.00', 'year', 2, 'rolling', NULL, NULL, '7', 'b_a', NULL, 'Public', 1, NULL, NULL, 0, 1),
(2, 1, 'Student', 'Discount membership for full-time students.', 1, 2, '50.00', 'year', 1, 'rolling', NULL, NULL, NULL, NULL, NULL, 'Public', 2, NULL, NULL, 0, 1),
(3, 1, 'Lifetime', 'Lifetime membership.', 1, 2, '1200.00', 'lifetime', 1, 'rolling', NULL, NULL, '7', 'b_a', NULL, 'Admin', 3, NULL, NULL, 0, 1);






INSERT INTO `civicrm_membership` (`id`, `contact_id`, `membership_type_id`, `join_date`, `start_date`, `end_date`, `source`, `status_id`, `is_override`, `owner_membership_id`, `max_related`, `is_test`, `is_pay_later`, `contribution_recur_id`, `campaign_id`) VALUES
(39, 210, 1, '2017-12-13', '2017-12-13', '2017-12-15', 'Manul', 1, NULL, NULL, NULL, 0, 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS=1;