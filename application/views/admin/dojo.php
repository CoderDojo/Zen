<div id="content">
    <div class="mainpage">
            <legend><?=$pagename?> Dojos</legend>
            <form action="/admin/" method="post">
                <input type="submit" name="submit" value="Done" class="btn-primary" style="float:right;">
                <table id="vfy-dojo-table" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dojo</th>
                            <th>Stage</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>User</th>
                            <th>Edit</th>
                            <th><i>Verify</i></th>
                            <th><i>Delete</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dojos as $dojo){ ?>
                        <tr>
                            <td><a href="/dojo/<?=$dojo->dojoid;?>" target="_blank"><?=$dojo->dojoid;?></a></td>
                            <td><a href="/dojo/<?=$dojo->dojoid;?>" target="_blank"><?=$dojo->name;?></a></td>
                            <td><?=$dojo->stage;?></td>
                            <td><?=$dojo->country;?></td>
                            <td><?=$dojo->dojoemail;?></td>
                            <td><a href="https://hwf.zendesk.com/tickets/new?email=<?=urlencode($dojo->useremail);?>&ticket[set_collaborators]=<?=urlencode($dojo->dojoemail);?>&ticket[subject]=<?=urlencode($dojo->name);?>&ticket[status]=pending&ticket[type]=question&ticket[priority]=normal&ticket[group_id]=21222293" target="_blank" title="Open a Ticket" style="color: #<?=$dojo->charter==Charter_Model::AGREEMENT_VERSION?'33CC33':'CC3333';?>"><?=$dojo->useremail;?></a></td>
                            <td><a href="/admin/edit/<?=$dojo->dojoid;?>" target="_blank">Edit</a></td>
                            <td><select name="verify[<?=$dojo->dojoid?>]" class="verif verif-<?=$dojo->verified?>">
                                <option value="0" <?=$dojo->verified==0?'selected':'';?>>Unverified</option>
                                <option <?=$dojo->charter==Charter_Model::AGREEMENT_VERSION?'':'disabled';?> value="1" <?=$dojo->verified==1?'selected':'';?>>Verified</option>
                                <option value="2" <?=$dojo->verified==2?'selected':'';?>>Previous</option>
                            </select></td>
                            <td><input type="checkbox" name="delete[<?=$dojo->dojoid?>]" value="delete" <?=isset($dojo->deleted)&&$dojo->deleted?'checked':'';?>></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="submit" name="submit" value="Done" class="btn-primary" style="float:right;">
            </form>
            <div style="clear:both;">&nbsp;</div>
    </div>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#vfy-dojo-table").tablesorter({
        sortList: [[0,1]],
        headers: {
            5: {
                sorter: false
            }
        }
    });
});
</script>
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
