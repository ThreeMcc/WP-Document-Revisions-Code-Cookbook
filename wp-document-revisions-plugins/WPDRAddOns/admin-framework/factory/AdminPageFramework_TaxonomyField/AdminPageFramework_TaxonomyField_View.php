<?php
/**
 Admin Page Framework v3.5.6 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class wpdr_AdminPageFramework_TaxonomyField_View extends wpdr_AdminPageFramework_TaxonomyField_Model {
    public function _replyToPrintFieldsWOTableRows($oTerm) {
        echo $this->_getFieldsOutput(isset($oTerm->term_id) ? $oTerm->term_id : null, false);
    }
    public function _replyToPrintFieldsWithTableRows($oTerm) {
        echo $this->_getFieldsOutput(isset($oTerm->term_id) ? $oTerm->term_id : null, true);
    }
    private function _getFieldsOutput($iTermID, $bRenderTableRow) {
        $_aOutput = array();
        $_aOutput[] = wp_nonce_field($this->oProp->sClassHash, $this->oProp->sClassHash, true, false);
        $this->_setOptionArray($iTermID, $this->oProp->sOptionKey);
        $this->oForm->format();
        $_oFieldsTable = new wpdr_AdminPageFramework_FormTable($this->oProp->aFieldTypeDefinitions, $this->_getFieldErrors(), $this->oMsg);
        $_aOutput[] = $bRenderTableRow ? $_oFieldsTable->getFieldRows($this->oForm->aFields['_default'], array($this, '_replyToGetFieldOutput')) : $_oFieldsTable->getFields($this->oForm->aFields['_default'], array($this, '_replyToGetFieldOutput'));
        $_sOutput = $this->oUtil->addAndApplyFilters($this, 'content_' . $this->oProp->sClassName, implode(PHP_EOL, $_aOutput));
        $this->oUtil->addAndDoActions($this, 'do_' . $this->oProp->sClassName, $this);
        return $_sOutput;
    }
    public function _replyToPrintColumnCell($vValue, $sColumnSlug, $sTermID) {
        $_sCellHTML = '';
        if (isset($_GET['taxonomy']) && $_GET['taxonomy']) {
            $_sCellHTML = $this->oUtil->addAndApplyFilter($this, "cell_{$_GET['taxonomy']}", $vValue, $sColumnSlug, $sTermID);
        }
        $_sCellHTML = $this->oUtil->addAndApplyFilter($this, "cell_{$this->oProp->sClassName}", $_sCellHTML, $sColumnSlug, $sTermID);
        $_sCellHTML = $this->oUtil->addAndApplyFilter($this, "cell_{$this->oProp->sClassName}_{$sColumnSlug}", $_sCellHTML, $sTermID);
        echo $_sCellHTML;
    }
}