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

$ad = $params['entity'];

// Decode stored configurations back into native arrays to pre-check checkboxes
$saved_placements = json_decode($ad->placement, true);
$saved_genders    = json_decode($ad->gender_target, true);

if (!is_array($saved_placements)) { $saved_placements = array(); }
if (!is_array($saved_genders)) { $saved_genders = array(); }

// Pre-format timestamp into system level browser standard input value format (YYYY-MM-DD)
$saved_date = '';
if (!empty($ad->expire_time)) {
    $saved_date = date('Y-m-d', $ad->expire_time);
} 

// Stored banner preview configuration fallback asset lookup URL
$photo_url = $ad->getPhotoURL();
?>
<div class="ossn-ad-creation-form">
    <input type="hidden" name="guid" value="<?php echo $ad->guid; ?>" />
    
    <div class="ossn-ad-split-layout">
        
        <!-- LEFT COLUMN: Configurations & Targeting Map -->
        <div class="ossn-ad-column-left">
            <!-- Ad Title Field -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:title'); ?></label>
                <input type="text" name="title" class="form-control-fancy" value="<?php echo $ad->title; ?>" placeholder="e.g. Summer Flash Sale!" required/>
            </div>

            <!-- Ad Target Destination URL -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:site:url'); ?></label>
                <input type="url" name="siteurl" class="form-control-fancy" value="<?php echo $ad->site_url; ?>" placeholder="https://example.com/promo" required/>
            </div>

            <!-- Placement Targeting -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:placement'); ?></label>
                <div class="checkbox-group-fancy-native">
                    <?php
                    $placementOptions = array(
                        'newsfeed' => ossn_print('ad:placement:newsfeed'),
                        'profile'  => ossn_print('ad:placement:profile'),
                        'groups'   => ossn_print('ad:placement:groups'),
                        'global'   => ossn_print('ad:placement:global')
                    );

                    echo ossn_plugin_view('input/checkbox', array(
                        'name'    => 'placement',
                        'options' => $placementOptions,
                        'value' => $saved_placements
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
                            $langKey = ($gender === 'male' || $gender === 'female') ? $gender : 'gender:other';
                            $genderOptions[$gender] = ossn_print($langKey);
                        }
                    }

                    echo ossn_plugin_view('input/checkbox', array(
                        'name'    => 'gender_target',
                        'options' => $genderOptions,
                        'value' => $saved_genders
                    ));
                    ?>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Creative Copy, Expiry & Image Dropzone Preview -->
        <div class="ossn-ad-column-right">
            <!-- Description Textarea Field -->
            <div class="form-group-fancy">
                <div class="form-label-row-fancy">
                    <label class="form-label-fancy"><?php echo ossn_print('ad:desc'); ?></label>
                    <span id="ossn-ad-desc-counter" class="char-counter-badge">250 left</span>
                </div>
                <textarea name="description" id="ossn-ad-description-input" class="form-control-fancy" rows="5" maxlength="250" placeholder="Write a brief, catchy description for your ad copy..."><?php echo $ad->description; ?></textarea>
            </div>

            <!-- Expiry / End Date Field -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:end:date'); ?></label>
                <input type="date" name="expiry_date" class="form-control-fancy" value="<?php echo $saved_date; ?>" min="<?php echo date('Y-m-d'); ?>" />
            </div>

            <!-- Ad Banner File Upload Dropzone -->
            <div class="form-group-fancy">
                <label class="form-label-fancy"><?php echo ossn_print('ad:photo'); ?></label>
                
                <div class="custom-file-upload-container">
                    <input type="file" name="ossn_ads" id="ossn_ads_file" class="file-input-hidden" accept="image/*" />
                    
                    <!-- Drag & Drop Trigger Box (Hidden if photo exists) -->
                    <div id="ossn-ad-dropzone" class="ossn-ad-dropzone-wrapper <?php echo !empty($photo_url) ? 'hidden' : ''; ?>">
                        <label for="ossn_ads_file" class="btn-file-trigger">
                            <i class="fa fa-cloud-upload"></i>
                            <span class="main-text"><?php echo ossn_print('ad:file:choose'); ?></span>
                            <span class="sub-text"><?php echo ossn_print('ad:file:restriction'); ?></span>
                        </label>
                    </div>

                    <!-- Real-time Image Preview Context Panel (Populated with existing photo) -->
                    <div id="ossn-ad-preview-wrapper" class="image-preview-box <?php echo empty($photo_url) ? 'hidden' : ''; ?>">
                        <img id="ossn-ad-preview-img" src="<?php echo !empty($photo_url) ? $photo_url : '#'; ?>" alt="Ad Preview"/>
                        <button type="button" id="ossn-ad-remove-file-btn" class="btn-remove-preview" title="<?php echo ossn_print('ad:file:remove'); ?>">
                            <i class="fa fa-times-circle me-0"></i> <?php echo ossn_print('ad:file:remove'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if(isset($ad->expired) && $ad->expired == true){ ?>
    <div class="form-actions-fancy">
        <button type="button" class="btn btn-danger" disabled="disabled">
            <i class="fa fa-clock"></i> <?php echo ossn_print('ad:status:expired'); ?>
        </button>
    </div>
    <?php } else { ?>
    <div class="form-actions-fancy">
        <button type="submit" class="btn-fancy-success">
            <i class="fa fa-floppy-disk"></i> <?php echo ossn_print('save'); ?>
        </button>
    </div>    
    <?php } ?>
</div>