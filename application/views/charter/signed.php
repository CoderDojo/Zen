<div id="content">
    <div class="mainpage">
        <legend>Hello World Foundation charter for CoderDojo</legend>
        <p>All Dojos are required to agree with the below CoderDojo Charter. This Charter encompasses the basic ethos and core aspects of the CoderDojo movement, which all Dojos are founded on. The introduction of the Charter was announced by co-founder James Whelton to the CoderDojo Organisers Group on the 3rd of December 2013.</p>
        <div id="chartertext" class="form-horizontal">
            <?php $this->load->view('charter/charter_text.'.$signed->agreement_version.'.php'); ?>
            <div class="control-group">
                <label class="control-label" for="name">Agreed to by</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="name" value="<?php echo $signed->full_name; ?>" readonly>
                    <div class="error-text"><?php echo validation_errors('name'); ?></div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="name">Agreed to at</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="name" value="<?php $dt = new DateTime($signed->timestamp,new DateTimeZone('Europe/Dublin')); echo $dt->format(DateTime::RFC2822); ?>" readonly>
                    <div class="error-text"><?php echo validation_errors('name'); ?></div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<style type="text/css">
.mainpage {
    background:#fff;
    max-width:900px;
    min-width:300px;
    margin:auto;
    padding:20px;
}
.mainpage table {
    width:100%;
}
#chartertext {
    width:75%;
    min-width:275px;
    margin:auto;
}
#chartertext ul {
    margin-left:35px;
    list-style:outside;
}
</style>