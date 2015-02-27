<div id="content">
    <div class="mainpage">
            <legend>Charter</legend>
            <p><?=$charter?> <?=$charter==1?'person has':'people have'?> signed the current version of the charter.</p>
            <legend>Dojos</legend>
            <table id="vfy-dojo-table" class="table">
                <tr>
                    <th></th>
                    <th>Active</th>
                    <th>Verified</th>
                    <th>Total</th>
                </tr>
                <?php
                $totals = array(
                    'active_verified' => 0,
                    'verified' => 0,
                    'total' => 0
                );
                foreach($stats as $continent => $countries):
                    $continent_totals = array(
                        'active_verified' => 0,
                        'verified' => 0,
                        'total' => 0
                    );
                ?>
                    <?php foreach ($countries as $country => $values): ?>
                        <tr>
                            <td><?=$country?></td>
                            <td><?=@$values['active_verified']?:0;?></td>
                            <td><?=@$values['verified']?:0;?></td>
                            <td><?=$values['total']?></td>
                        </tr>
                    <?php 
                        $continent_totals['active_verified'] += @$values['active_verified']?:0;
                        $continent_totals['verified'] += @$values['verified']?:0;
                        $continent_totals['total'] += $values['total'];
                        $totals['active_verified'] += @$values['active_verified']?:0;
                        $totals['verified'] += @$values['verified']?:0;
                        $totals['total'] += $values['total'];
                    endforeach;
                    ?>
                    <tr>
                        <th><?=$continent?> Total</th>
                        <th><?=$continent_totals['active_verified']?></th>
                        <th><?=$continent_totals['verified']?></th>
                        <th><?=$continent_totals['total']?></th>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th>Total</th>
                    <th><?=$totals['active_verified']?></th>
                    <th><?=$totals['verified']?></th>
                    <th><?=$totals['total']?></th>
                </tr>
            </table>
    </div>
</div>

<style type="text/css">
.mainpage {
    background:#fff;
    width:1024px;
    margin:auto;
    padding:20px;
}
.col {
    width:460px;
    float:left;
    margin-right:32px;
}
th {
    background: #ccc;
}
</style>