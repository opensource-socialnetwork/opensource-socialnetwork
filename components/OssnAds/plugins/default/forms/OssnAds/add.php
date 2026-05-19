<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-ad-creation-form">
    <div class="ossn-ad-split-layout">
        <!-- LEFT COLUMN: Configurations & Targeting -->
        <div class="ossn-ad-column-left">
            <!-- Ad Title Field -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:title'); ?></label>
                <input type="text" name="title" class="form-control-fancy" placeholder="e.g. Summer Flash Sale!" required/>
            </div>

            <!-- Ad Target Destination URL -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:site:url'); ?></label>
                <input type="url" name="siteurl" class="form-control-fancy" placeholder="https://example.com/promo" required/>
            </div>

            <!-- Placement Targeting -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:placement'); ?></label>
                <div class="checkbox-group-fancy-native">
                    <?php
                    // Added ossn_print keys to make the entire mapping translatable
                    $placementOptions = array(
                        'newsfeed' => ossn_print('ad:placement:newsfeed'),
                        'profile' => ossn_print('ad:placement:profile'),
                        'groups' => ossn_print('ad:placement:groups'),
                        'global' => ossn_print('ad:placement:global')
                    );

                    echo ossn_plugin_view('input/checkbox', array(
                        'name'    => 'placement',
                        'options' => $placementOptions,
                        'checked' => array('newsfeed')
                    ));
                    ?>
                </div>
            </div>

            <!-- Gender Targeting -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:gender:target'); ?></label>
                <div class="checkbox-group-fancy-native">
                    <?php
                    $genderTypes = (new OssnUser())->genderTypes();
                    $genderOptions = array();

                    if ($genderTypes && is_array($genderTypes)) {
                        foreach ($genderTypes as $gender) {
                            if ($gender === 'male' || $gender === 'female') {
                                $langKey = $gender;
                            } else {
                                $langKey = 'gender:other';
                            }
                            $genderOptions[$gender] = ossn_print($langKey);
                        }
                    }

                    echo ossn_plugin_view('input/checkbox', array(
                        'name'    => 'gender_target',
                        'options' => $genderOptions,
                        'checked' => $genderTypes
                    ));
                    ?>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Creative Copy, Expiry & Image Dropzone -->
        <div class="ossn-ad-column-right">
            <!-- Description Textarea Field -->
            <div class="form-group-fancy">
                <div class="form-label-row-fancy">
                    <label class="form-label-fancy"><?php echo ossn_print('ad:desc'); ?></label>
                    <span id="ossn-ad-desc-counter" class="char-counter-badge">250 left</span>
                </div>
                <textarea name="description" id="ossn-ad-description-input" class="form-control-fancy" rows="5" maxlength="250" placeholder="Write a brief, catchy description for your ad copy..."></textarea>
            </div>

            <!-- Expiry / End Date Field -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:end:date'); ?></label>
                <input type="date" name="expiry_date" class="form-control-fancy" min="<?php echo date('Y-m-d'); ?>" />
            </div>

            <!-- Ad Banner File Upload Dropzone -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:photo'); ?></label>
                
                <div class="custom-file-upload-container">
                    <input type="file" name="ossn_ads" id="ossn_ads_file" class="file-input-hidden" accept="image/*" />
                    
                    <!-- Drag & Drop Trigger Box -->
                    <div id="ossn-ad-dropzone" class="ossn-ad-dropzone-wrapper">
                        <label for="ossn_ads_file" class="btn-file-trigger">
                            <i class="fa fa-cloud-upload"></i>
                            <span class="main-text"><?php echo ossn_print('ad:file:choose'); ?></span>
                            <span class="sub-text"><?php echo ossn_print('ad:file:restriction'); ?></span>
                        </label>
                    </div>

                    <!-- Real-time Image Preview Context Panel -->
                    <div id="ossn-ad-preview-wrapper" class="image-preview-box hidden">
                        <img id="ossn-ad-preview-img" src="#" alt="Ad Preview"/>
                        <button type="button" id="ossn-ad-remove-file-btn" class="btn-remove-preview" title="<?php echo ossn_print('ad:file:remove'); ?>">
                            <i class="fa fa-times-circle me-0"></i> <?php echo ossn_print('ad:file:remove'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Submission Footer Section -->
    <div class="form-actions-fancy">
        <button type="submit" class="btn-fancy-success">
            <i class="fa fa-plus-circle"></i> <?php echo ossn_print('add'); ?>
        </button>
    </div>
</div>