<?php use Stationer\Graphite\G; ?>
<div id="subheader">
    <a href="/Ledger/intro">Intro</a>
    <a href="/Ledger/faq">FAQ</a>
    <a href="/Ledger/list">Transaction List</a>
    <?php if (G::$S->roleTest('Ledger/Admin')) { ?>
        <a href="/Ledger/websites">Ledger Admin</a>
    <?php } ?>
</div>
