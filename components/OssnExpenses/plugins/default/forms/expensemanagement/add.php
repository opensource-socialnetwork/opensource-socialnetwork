<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="expense-add-container em-form-wrapper">
    <div class="ossn-widget">
        <div class="widget-heading">
            <i class="fa fa-shopping-bag"></i>
            <span><?php echo ossn_print('em:addexpense'); ?></span>
        </div>
        <div class="widget-contents">
            <div class="em-form-date-box">
                <label for="expense-date-input">
                    <i class="fa fa-calendar"></i>
                    <span><?php echo ossn_print('em:date'); ?></span>
                </label>
                <input
                    type="text"
                    id="expense-date-input"
                    name="expnesedate"
                    required="required"
                    readonly="readonly"
                />
            </div>

            <div class="items-enter">
                <div class="row expense-form-item">
                    <div class="col-md-6">
                        <div class="input-icon-wrapper item-icon">
                            <input
                                type="text"
                                class="expense-input"
                                id="expense-management-item"
                                name="items[]"
                                placeholder="<?php echo ossn_print('em:itemname'); ?>"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-icon-wrapper price-icon">
                            <input
                                type="number"
                                class="expense-input"
                                id="expense-management-price"
                                name="price[]"
                                step="0.01"
                                placeholder="<?php echo ossn_print('em:price'); ?>"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="em-form-footer">
                <div class="em-form-row-btns">
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm remove-item hidden" title="<?php echo ossn_print('em:remove:row'); ?>">&minus;</a>
                    <a href="javascript:void(0);" class="btn btn-success btn-sm add-item" title="<?php echo ossn_print('em:add:row'); ?>">+</a>
                </div>
                <input type="submit" class="btn btn-success btn-sm add-items right" value="<?php echo ossn_print('save'); ?>" />
            </div>
        </div>
    </div>
</div>