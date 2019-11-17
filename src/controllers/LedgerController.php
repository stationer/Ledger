<?php
/**
 * Main Controller for 'Ledger' Financial Account Analyzer
 * File: /src/controllers/LedgerController.php
 *
 * PHP version 7
 *
 * @package  Stationer\Ledger
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/Ledger/blob/master/LICENSE
 * @link     http://github.com/stationer/Ledger
 */

namespace Stationer\Ledger\controllers;

use Stationer\Graphite\Controller;
use Stationer\Graphite\data\IDataProvider;
use Stationer\Graphite\View;
use Stationer\Graphite\G;
use Stationer\Ledger\models\Transaction;

/**
 * LedgerController class -
 * Main Controller for 'Ledger' Financial Account Analyzer
 * File: /src/controllers/LedgerController.php
 *
 * PHP version 7
 *
 * @package  Stationer\Ledger
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/Ledger/blob/master/LICENSE
 * @link     http://github.com/stationer/Ledger
 */
class LedgerController extends Controller {
    protected $action = 'intro';

    /**
     * LedgerController constructor.
     *
     * @param array         $argv Argument list passed from Dispatcher
     * @param IDataProvider $DB   DataProvider to use with Controller
     * @param View          $View Graphite View helper
     */
    public function __construct($argv = [], IDataProvider $DB = null, View $View = null) {
        parent::__construct($argv, $DB, $View);

        $path = str_replace(SITE, '', dirname(__DIR__));
        $this->View->_style($path.'/css/letterhead.css');
        $this->View->_style($path.'/css/Ledger.css');
        $this->View->_script($path.'/js/Ledger.js');
        $this->View->_script($path.'/js/oksort.js');
        $this->View->setTemplate('subheader', 'Ledger.subheader.php');
        $this->View->_title = 'Ledger : '.$this->View->_siteName;
    }

    /**
     * Intro Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_intro(array $argv = [], array $request = []) {
        $this->View->_title    = 'Introduction : Ledger : '.$this->View->_siteName;
        $this->View->_template = 'Ledger.Intro.php';

        return $this->View;
    }

    /**
     * FAQ Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_faq(array $argv = [], array $request = []) {
        $this->View->_title    = 'Frequently Anticipated Questions : Ledger : '.$this->View->_siteName;
        $this->View->_template = 'Ledger.Faq.php';

        return $this->View;
    }

    /**
     * List Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_list(array $argv = [], array $request = []) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to view Transactions.', 'error');

            return $this->do_intro($argv);
        }

        $Transactions = $this->DB->fetch(Transaction::class, ['login_id' => G::$S->Login->login_id], ['date' => true]);

        $this->View->_title       = 'List : Ledger : '.$this->View->_siteName;
        $this->View->_template    = 'Ledger.List.php';
        $this->View->Transactions = $Transactions;
        $this->View->json         = json_encode($Transactions);

        return $this->View;
    }
}
