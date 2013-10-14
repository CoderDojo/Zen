<div id="content">
    <div class="mainpage">
            <legend>Your Dojos</legend>
            <table id="vfy-dojo-table" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dojo</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dojos as $dojo){ ?>
                    <tr>
                        <td><a href="/dojo/<?=$dojo->dojo_id;?>"><?=$dojo->dojo_id;?></a></td>
                        <td><a href="/dojo/<?=$dojo->dojo_id;?>"><?=$dojo->name;?></a></td>
                        <td><a href="/dojo/edit/<?=$dojo->dojo_id;?>">Edit</a></td>
                        <td><a href="/dojo/delete/<?=$dojo->dojo_id;?>">Delete</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </table>
            <div style="clear:both;">&nbsp;</div>
    </div>
</div>

<style type="text/css">
.mainpage {
    background:#fff;
    width:1024px;
    margin:auto;
    padding:20px;
}
.mainpage table {
    width:100%;
}
th {
    background: #ccc;
}
th.headerSortUp {
    color: #fff;
    background: #999;
}
th.headerSortUp:after {
    content: " (d)";
}
th.headerSortDown {
    color: #fff;
    background: #999;
}
th.headerSortDown:after {
    content: " (a)";
}
</style>