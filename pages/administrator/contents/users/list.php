<?php
echo  ossn_view_form('admin/users/list_search', array(
				'action' => ossn_site_url('administrator/users'),
				'class' => 'ossn-admin-form',
 ));
echo  ossn_view_form('admin/users/list', array(
				'action' => ossn_site_url('action/admin/users/delete'),
				'class' => 'ossn-admin-form',
 ));