<div id="content">
    <div class="mainpage">
        <legend>Are you sure?</legend>
        <?php echo validation_errors(); ?>
        <?php echo form_open('/dojo/delete/'.$id); ?>
        <p>We want to be sure you know what exactly happens when you delete your page.</p>
        <p>Once you submit this page your Dojo will be marked as deleted in our database. This means it will not be possible for anyone except Zen administrators to view. If you would like to completely remove the record you should email <a href="mailto:enquiries@coderdojo.com">enquiries@coderdojo.com</a>.</p>
        <div class="control-group">
            <label class="control-label" for="need_mentors"><b>I understand</b></label>
            <div class="controls">
                <label class="checkbox inline">
                    <input type="checkbox" name="confirm" value="1">
                </label>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="submit" class="btn-primary" value="Submit">
            </div>
        </div>
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
</style>