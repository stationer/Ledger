--
-- Current Schema CREATE statements go here
-- 

 -- \Stationer\Ledger\models\Transaction
DROP TABLE IF EXISTS `Ledger_Transaction`;
CREATE TABLE IF NOT EXISTS `Ledger_Transaction` (
    `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `created_uts` int(10) unsigned NOT NULL DEFAULT 0,
    `updated_dts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `login_id` int(10) unsigned NOT NULL DEFAULT 0,
    `date` date NOT NULL,
    `type` varchar(16) NOT NULL,
    `checkNum` int(10) unsigned NOT NULL DEFAULT 0,
    `description` varchar(255) NOT NULL,
    `amount` decimal(9,2) NOT NULL,
    `category` varchar(32) NOT NULL,
    `account` varchar(16) NOT NULL,
    KEY (`updated_dts`),
    KEY (`login_id`),
    PRIMARY KEY(`transaction_id`)
);
