<?php /* Smarty version Smarty-3.1.19, created on 2017-09-25 13:08:44
         compiled from "/home/myjigeshraval/public_html/presta.jigeshraval.com/storeadmin/themes/default/template/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124373712459c8b284f068f5-94925634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f410b8bfc8a69db1f3f1d572edaf3b12af84fcc9' => 
    array (
      0 => '/home/myjigeshraval/public_html/presta.jigeshraval.com/storeadmin/themes/default/template/layout.tpl',
      1 => 1503921074,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124373712459c8b284f068f5-94925634',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'conf' => 0,
    'error' => 0,
    'errors' => 0,
    'disableDefaultErrorOutPut' => 0,
    'informations' => 0,
    'info' => 0,
    'confirmations' => 0,
    'warnings' => 0,
    'warning' => 0,
    'page' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c8b284f16b38_78930684',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c8b284f16b38_78930684')) {function content_59c8b284f16b38_78930684($_smarty_tpl) {?>
<?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)) {?>
	<div class="bootstrap">
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $_smarty_tpl->tpl_vars['conf']->value;?>

		</div>
	</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
  <div class="bootstrap">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

    </div>
  </div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['errors']->value)&&current($_smarty_tpl->tpl_vars['errors']->value)!=''&&(!isset($_smarty_tpl->tpl_vars['disableDefaultErrorOutPut']->value)||$_smarty_tpl->tpl_vars['disableDefaultErrorOutPut']->value==false)) {?>

	<div class="bootstrap">
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php if (count($_smarty_tpl->tpl_vars['errors']->value)==1) {?>
			<?php echo reset($_smarty_tpl->tpl_vars['errors']->value);?>

		<?php } else { ?>
			<?php echo smartyTranslate(array('s'=>'%d errors','sprintf'=>array(count($_smarty_tpl->tpl_vars['errors']->value))),$_smarty_tpl);?>

			<br/>
			<ol>
				<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
					<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
				<?php } ?>
			</ol>
		<?php }?>
		</div>
	</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['informations']->value)&&count($_smarty_tpl->tpl_vars['informations']->value)&&$_smarty_tpl->tpl_vars['informations']->value) {?>
	<div class="bootstrap">
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<ul id="infos_block" class="list-unstyled">
				<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['informations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value) {
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
					<li><?php echo $_smarty_tpl->tpl_vars['info']->value;?>
</li>
				<?php } ?>
			</ul>
		</div>
	</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['confirmations']->value)&&count($_smarty_tpl->tpl_vars['confirmations']->value)&&$_smarty_tpl->tpl_vars['confirmations']->value) {?>
	<div class="bootstrap">
		<div class="alert alert-success" style="display:block;">
			<?php  $_smarty_tpl->tpl_vars['conf'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['conf']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['confirmations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['conf']->key => $_smarty_tpl->tpl_vars['conf']->value) {
$_smarty_tpl->tpl_vars['conf']->_loop = true;
?>
				<?php echo $_smarty_tpl->tpl_vars['conf']->value;?>

			<?php } ?>
		</div>
	</div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)) {?>
	<div class="bootstrap">
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)>1) {?>
				<h4><?php echo smartyTranslate(array('s'=>'There are %d warnings:','sprintf'=>array(count($_smarty_tpl->tpl_vars['warnings']->value))),$_smarty_tpl);?>
</h4>
			<?php }?>
			<ul class="list-unstyled">
				<?php  $_smarty_tpl->tpl_vars['warning'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['warning']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warnings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['warning']->key => $_smarty_tpl->tpl_vars['warning']->value) {
$_smarty_tpl->tpl_vars['warning']->_loop = true;
?>
					<li><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</li>
				<?php } ?>
			</ul>
		</div>
	</div>
<?php }?>
<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

<?php }} ?>
