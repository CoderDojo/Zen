<div id="content">
    <div class="mainpage">
            <legend>Dojos</legend>
            <table id="vfy-dojo-table" class="table">
                <tr>
                    <th></th>
                    <th>Verified</th>
                    <th>Total</th>
                </tr>
                <?php
                $totals = array(
                    'verified' => 0,
                    'total' => 0
                );
                foreach($stats as $continent => $countries):
                    $continent_totals = array(
                        'verified' => 0,
                        'total' => 0
                    );
                ?>
                    <?php foreach ($countries as $country => $values): ?>
                        <tr>
                            <td><?=$country?></td>
                            <td><?=@$values['verified']?:0;?></td>
                            <td><?=$values['total']?></td>
                        </tr>
                    <?php 
                        $continent_totals['verified'] += @$values['verified']?:0;
                        $continent_totals['total'] += $values['total'];
                        $totals['verified'] += @$values['verified']?:0;
                        $totals['total'] += $values['total'];
                    endforeach;
                    ?>
                    <tr>
                        <th><?=$continent?> Total</th>
                        <th><?=$continent_totals['verified']?></th>
                        <th><?=$continent_totals['total']?></th>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th>Total</th>
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