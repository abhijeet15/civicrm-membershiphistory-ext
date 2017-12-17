DROP TABLE IF EXISTS `civirenewmebership_term`;

-- /*******************************************************
-- *
-- * civirenewmebership_term
-- *
-- * A Membership period/term table.
-- *
-- *******************************************************/
CREATE TABLE IF NOT EXISTS `civirenewmebership_term` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `contact_id` int(9) NOT NULL,
  `membership_id` int(9) NOT NULL,
  `contribution_id` int(9) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;