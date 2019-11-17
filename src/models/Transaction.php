<?php
/**
 * Main Controller for 'Ledger' Financial Account Analyzer
 * File: /src/models/Transaction.php
 *
 * PHP version 7
 *
 * @package  Stationer\Ledger
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/Ledger/blob/master/LICENSE
 * @link     http://github.com/stationer/Ledger
 */

namespace Stationer\Ledger\models;

use Stationer\Graphite\data\PassiveRecord;

/**
 * Transaction class -
 * A Transaction
 * File: /src/models/Transaction.php
 *
 * PHP version 7
 *
 * @package  Stationer\Ledger
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/Ledger/blob/master/LICENSE
 * @link     http://github.com/stationer/Ledger
 * @see      PassiveRecord.php
 * @property int    $transaction_id
 * @property int    $created_uts
 * @property string $updated_dts
 * @property string $date
 * @property string $type
 * @property int    $checkNum
 * @property string $description
 * @property float  $amount
 * @property string $category
 * @property string $account
 */
class Transaction extends PassiveRecord {
    protected static $table = G_DB_TABL.'Ledger_Transaction';
    protected static $pkey = 'transaction_id';
    protected static $keys = ['login_id'];
    protected static $query = '';

    protected static $vars = [
        'transaction_id' => ['type' => 'i', 'min' => 1, 'guard' => true],
        'created_uts'    => ['type' => 'ts', 'min' => 0, 'guard' => true],
        'updated_dts'    => ['type' => 'dt', 'def' => NOW, 'guard' => true],
        'login_id'       => ['type' => 'i', 'min' => 0],
        'date'           => ['type' => 'dt', 'format' => 'Y-m-d', 'ddl' => '`date` date NOT NULL'],
        'type'           => ['type' => 's', 'max' => 16],
        'checkNum'       => ['type' => 'i', 'min' => 0],
        'description'    => ['type' => 's', 'max' => 255],
        'amount'         => ['type' => 'f', 'min' => -9999999.99, 'max' => 9999999.99,
                             'ddl' => '`amount` decimal(9,2) NOT NULL'],
        'category'       => ['type' => 's', 'max' => 32],
        'account'        => ['type' => 's', 'max' => 16],
    ];
}
