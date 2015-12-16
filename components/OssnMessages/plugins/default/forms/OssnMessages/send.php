                <textarea name="message" placeholder="<?php echo ossn_print('message:placeholder'); ?>"></textarea>
                <input type="hidden" name="to" value="<?php echo $params['user']->guid; ?>"/>

                <div class="controls">
                    <?php 
                    //this form should be in OssnMessages/forms 
                    echo ossn_plugin_view('input/security_token'); 
                    ?>
                    <div class="ossn-loading ossn-hidden"></div>                               
                    <input type="submit" class="btn btn-primary" value="<?php echo ossn_print('send'); ?>"/>
                </div>