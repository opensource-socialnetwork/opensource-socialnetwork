<?php
echo  ossn_view_form('admin/user/edit', array(
				'action' => ossn_site_url('action/admin/edit/user'),
				'class' => 'ossn-admin-form',
				'params' => $params,
 ));?>