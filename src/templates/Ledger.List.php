<?php
/** @var \Stationer\Ledger\models\Transaction[] $Transactions */
/** @var string $json */
echo $this->render('header'); ?>
    <section>
    <div class="c-card">
        <div class="header">
            <h5>Transactions</h5>
        </div>
        <div class="content Ledger">
            <table id="Ledger_list" class="js-sort-table">
                <thead>
                <tr>
                    <th class="js-sort-date">Date</th>
                    <th class="js-sort-string">Type</th>
                    <th class="js-sort-number">CheckNum</th>
                    <th class="js-sort-string">Description</th>
                    <th class="js-sort-number">Amount</th>
                    <th class="js-sort-string">Category</th>
                    <th class="js-sort-string">Account</th>
                </tr>
                </thead>
                <tbody id="Ledger_List">
                <?php
                if (is_array($Transactions) && count($Transactions) > 0) {
                    foreach ($Transactions as $id => $Transaction) { ?>
                <tr>
                    <td><?php html($Transaction['date']); ?></td>
                    <td><?php html($Transaction['type']); ?></td>
                    <td><?php html($Transaction['checkNum']); ?></td>
                    <td><?php html($Transaction['description']); ?></td>
                    <td><?php html($Transaction['amount']); ?></td>
                    <td><?php html($Transaction['category']); ?></td>
                    <td><?php html($Transaction['account']); ?></td>
                </tr>
                <?php
                    }
                } else {
                    ?>
                <tr><td colspan="9">You will need to add a Transaction, but I didn't implement that yet.</td></tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </section>
    <script type="text/javascript"><!--
        List =<?php echo $json; ?>;
        // --></script>
<?php echo $this->render('footer');
