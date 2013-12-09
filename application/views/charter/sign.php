<div id="content">
    <div class="mainpage">
        <legend>Hello World Foundation charter for CoderDojo</legend>
        <?php echo form_open('/charter/sign',array('class'=>'form-horizontal')); ?>
        <p>All Dojos are required to agree with the below CoderDojo Charter. This Charter encompasses the basic ethos and core aspects of the CoderDojo movement, which all Dojos are founded on. The introduction of the Charter was announced by co-founder James Whelton to the CoderDojo Organisers Group on the 3rd of December 2013. </p>
        <div id="chartertext">
            <?php $this->load->view('charter/charter_text.'.Charter_Model::AGREEMENT_VERSION.'.php'); ?>
            <div class="control-group">
                <label class="control-label" for="name">Your Full Name</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="name" name="name" value="<?php echo set_value("name"); ?>">
                    <div class="help-text">This should be your full name, not that of the Dojo.</div>
                    <div class="error-text"><?php echo validation_errors(); ?></div>
                </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit-agree" name="agree" value="I agree" class="btn btn-primary btn-large">I have read &amp; agree to the Charter</button>
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