<?php /* Smarty version Smarty-3.1.19, created on 2017-09-25 13:08:44
         compiled from "/home/myjigeshraval/public_html/presta.jigeshraval.com/storeadmin/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93392515359c8b284deba02-84921374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4d8bdc27abf5ed1cbda10a5befacdbfe224fff2' => 
    array (
      0 => '/home/myjigeshraval/public_html/presta.jigeshraval.com/storeadmin/themes/default/template/content.tpl',
      1 => 1503921074,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93392515359c8b284deba02-84921374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c8b284ded1e2_70273980',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c8b284ded1e2_70273980')) {function content_59c8b284ded1e2_70273980($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }} ?>
