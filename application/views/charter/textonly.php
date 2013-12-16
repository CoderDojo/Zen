<div id="content">
    <div class="mainpage">
        <legend>Hello World Foundation charter for CoderDojo</legend>
        <p>All Dojos are required to agree with the below CoderDojo Charter. This Charter encompasses the basic ethos and core aspects of the CoderDojo movement, which all Dojos are founded on. The introduction of the Charter was announced by co-founder James Whelton to the CoderDojo Organisers Group on the 3rd of December 2013. </p>
        <div id="chartertext">
            <?php $this->load->view('charter/charter_text.'.Charter_Model::AGREEMENT_VERSION.'.php'); ?>
            <legend>Additional information</legend>
            <table>
                <tr><td colspan="2"></td></tr>
                <tr><td><strong>Version Number</strong></td><td><?php echo Charter_Model::AGREEMENT_VERSION ?></td></tr>
                <tr><td><strong>Publication Date</strong></td><td><?php echo Charter_Model::AGREEMENT_VERSION_DATE ?></td></tr>
            </table>
        </div>
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