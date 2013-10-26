<div id="content">
    <div class="mainpage">
        <div class="col">
            <legend>Verified Dojos</legend>
            <table id="vfy-dojo-table" class="table">
                <?php $total = 0; $num_countries = 0;
                foreach(count_by_continent_country($verified_dojos) as $continent => $countries): ?>
                    <tr>
                        <th><?=$continent?></th>
                        <th><?=array_sum($countries)?></th>
                        <?php $total += array_sum($countries); ?>
                        <?php $num_countries += count($countries); ?>
                    </tr>
                    <?php foreach($countries as $country => $dojos): ?>
                        <tr>
                            <td><?=$country?></td>
                            <td><?=$dojos?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <tr>
                    <th>Total</th>
                    <th><?=$total?></th>
                </tr>
                <tr>
                    <th>Total Countries</th>
                    <th><?=$num_countries?></th>
                </tr>
            </table>
        </div>
        <div class="col">
            <legend>All Dojos</legend>
            <table id="all-dojo-table" class="table">
                <?php $total = 0; $num_countries = 0;
                foreach(count_by_continent_country($all_dojos) as $continent => $countries): ?>
                    <tr>
                        <th><?=$continent?></th>
                        <th><?=array_sum($countries)?></th>
                        <?php $total += array_sum($countries); ?>
                        <?php $num_countries += count($countries); ?>
                    </tr>
                    <?php foreach($countries as $country => $dojos): ?>
                        <tr>
                            <td><?=$country?></td>
                            <td><?=$dojos?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <tr>
                    <th>Total</th>
                    <th><?=$total?></th>
                </tr>
                <tr>
                    <th>Total Countries</th>
                    <th><?=$num_countries?></th>
                </tr>
            </table>
        </div>
        <div style="clear:both;"></div>
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