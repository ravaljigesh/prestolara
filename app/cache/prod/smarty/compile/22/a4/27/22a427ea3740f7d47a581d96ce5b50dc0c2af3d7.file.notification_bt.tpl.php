<?php /* Smarty version Smarty-3.1.19, created on 2017-09-23 16:47:09
         compiled from "/home/myjigeshraval/public_html/presta.jigeshraval.com/modules/gamification/views/templates/hook/notification_bt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18634008559c642b5780163-91480300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22a427ea3740f7d47a581d96ce5b50dc0c2af3d7' => 
    array (
      0 => '/home/myjigeshraval/public_html/presta.jigeshraval.com/modules/gamification/views/templates/hook/notification_bt.tpl',
      1 => 1506158297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18634008559c642b5780163-91480300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_id_tab' => 0,
    'current_level_percent' => 0,
    'current_level' => 0,
    'advice_hide_url' => 0,
    'link' => 0,
    'notification' => 0,
    'badges_to_display' => 0,
    'unlock_badges' => 0,
    'badge' => 0,
    'i' => 0,
    'next_badges' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59c642b57c13c0_44106194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c642b57c13c0_44106194')) {function content_59c642b57c13c0_44106194($_smarty_tpl) {?><script>
	var current_id_tab = <?php echo intval($_smarty_tpl->tpl_vars['current_id_tab']->value);?>
;
	var current_level_percent = <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
;
	var current_level = <?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
;
	var gamification_level = '<?php echo smartyTranslate(array('s'=>'Level','mod'=>'gamification','js'=>1),$_smarty_tpl);?>
';
	var advice_hide_url = '<?php echo $_smarty_tpl->tpl_vars['advice_hide_url']->value;?>
';
	var hide_advice = '<?php echo smartyTranslate(array('s'=>'Do you really want to hide this advice?','mod'=>'gamification','js'=>1),$_smarty_tpl);?>
';

	$('#dropdown_gamification .notifs_panel_header, #dropdown_gamification .tab-content').click(function () {
		return false;
	});

	$('#dropdown_gamification .panel-footer').click(function (elt) {
		window.location.href = '<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminGamification');?>
';
	});

	$('#gamification_tab li').click(function () {
		gamificationDisplayTab($(this).children('a'));
		return false;
	});

	function gamificationDisplayTab(elt)
	{
		$('#gamification_tab li, .gamification-tab-pane').removeClass('active');
		$(elt).parent('li').addClass('active');
		$('#'+$(elt).data('target')).addClass('active');
	}

</script>
<li id="gamification_notif" style="background:none" class="dropdown">
	<a href="javascript:void(0);" class="dropdown-toggle gamification_notif" data-toggle="dropdown">
		<i class="icon-trophy"></i>
                <svg class="icon-trophy-svg" viewBox="0 0 24 24">
                    <path fill="#6c868e" d="M20.2,2H19.5H18C17.1,2 16,3 16,4H8C8,3 6.9,2 6,2H4.5H3.8H2V11C2,12 3,13 4,13H6.2C6.6,15 7.9,16.7 11,17V19.1C8.8,19.3 8,20.4 8,21.7V22H16V21.7C16,20.4 15.2,19.3 13,19.1V17C16.1,16.7 17.4,15 17.8,13H20C21,13 22,12 22,11V2H20.2M4,11V4H6V6V11C5.1,11 4.3,11 4,11M20,11C19.7,11 18.9,11 18,11V6V4H20V11Z" />
                </svg>
		<span id="gamification_notif_number_wrapper" class="notifs_badge">
			<span id="gamification_notif_value"><?php echo intval($_smarty_tpl->tpl_vars['notification']->value);?>
</span>
		</span>
	</a>
	<div class="dropdown-menu notifs_dropdown" id="dropdown_gamification">
		<section id="gamification_notif_wrapper" class="notifs_panel" style="width:325px">
			<header class="notifs_panel_header">
				<h3><?php echo smartyTranslate(array('s'=>'Your Merchant Expertise','mod'=>'gamification'),$_smarty_tpl);?>

					<span class="label label-default" style="float:right"><?php echo smartyTranslate(array('s'=>'Level','mod'=>'gamification'),$_smarty_tpl);?>
 <?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
 : <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
 %</span>
				</h3>
			</header>
			<div class="progress" style="margin: 10px">
				<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
%;">
				<span style="color:#FFF"><?php echo smartyTranslate(array('s'=>'Level','mod'=>'gamification'),$_smarty_tpl);?>
 <?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
 : <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
 %</span>
				</div>
			</div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="gamification_tab" style="margin-left:10px">
				<li class="active">
					<a href="#home" data-toggle="tab" data-target="gamification_1" onclick="gamificationDisplayTab(this); return false;"><?php echo smartyTranslate(array('s'=>'Last badge :','mod'=>'gamification'),$_smarty_tpl);?>
</a>
				</li>
				<li>
					<a href="#profile" data-toggle="tab" data-target="gamification_2" onclick="gamificationDisplayTab(this); return false;"><?php echo smartyTranslate(array('s'=>'Next badge :','mod'=>'gamification'),$_smarty_tpl);?>
</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane gamification-tab-pane active" id="gamification_1">
					<ul id="gamification_badges_list" style="<?php if (count($_smarty_tpl->tpl_vars['badges_to_display']->value)<=2) {?> height:170px;<?php }?> padding-left:0">
					<?php  $_smarty_tpl->tpl_vars['badge'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['badge']->_loop = false;
 $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['unlock_badges']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['badge']->key => $_smarty_tpl->tpl_vars['badge']->value) {
$_smarty_tpl->tpl_vars['badge']->_loop = true;
 $_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars['badge']->key;
?>
						<?php if ($_smarty_tpl->tpl_vars['badge']->value->id) {?>
							<li class="<?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> unlocked <?php } else { ?> locked <?php }?>" style="float:left;">
								<span class="<?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> unlocked_img <?php } else { ?> locked_img <?php }?>" <?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?>style="left: 12px;"<?php }?>></span>
								<div class="gamification_badges_title"><span><?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> <?php echo smartyTranslate(array('s'=>'Last badge :','mod'=>'gamification'),$_smarty_tpl);?>
 <?php } else { ?> <?php echo smartyTranslate(array('s'=>'Next badge :','mod'=>'gamification'),$_smarty_tpl);?>
 <?php }?></span></div>
								<div class="gamification_badges_img" data-placement="<?php if ($_smarty_tpl->tpl_vars['i']->value<=1) {?>bottom<?php } else { ?>top<?php }?>" data-original-title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['badge']->value->description,'html','UTF-8');?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['badge']->value->getBadgeImgUrl();?>
"></div>
								<div class="gamification_badges_name"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['badge']->value->name,'html','UTF-8');?>
</div>
							</li>
						<?php }?>
					<?php } ?>
					</ul>
				</div>
				<div class="tab-pane gamification-tab-pane" id="gamification_2">
					<ul id="gamification_badges_list" style="<?php if (count($_smarty_tpl->tpl_vars['badges_to_display']->value)<=2) {?> height:170px;<?php }?> padding-left:0">
					<?php  $_smarty_tpl->tpl_vars['badge'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['badge']->_loop = false;
 $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['next_badges']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['badge']->key => $_smarty_tpl->tpl_vars['badge']->value) {
$_smarty_tpl->tpl_vars['badge']->_loop = true;
 $_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars['badge']->key;
?>
						<?php if ($_smarty_tpl->tpl_vars['badge']->value->id&&!$_smarty_tpl->tpl_vars['badge']->value->awb) {?>
							<li class="<?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> unlocked <?php } else { ?> locked <?php }?>" style="float:left;">
								<span class="<?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> unlocked_img <?php } else { ?> locked_img <?php }?>" <?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?>style="left: 12px;"<?php }?>></span>
								<div class="gamification_badges_title"><span><?php if ($_smarty_tpl->tpl_vars['badge']->value->validated) {?> <?php echo smartyTranslate(array('s'=>'Last badge :','mod'=>'gamification'),$_smarty_tpl);?>
 <?php } else { ?> <?php echo smartyTranslate(array('s'=>'Next badge :','mod'=>'gamification'),$_smarty_tpl);?>
 <?php }?></span></div>
								<div class="gamification_badges_img" data-placement="<?php if ($_smarty_tpl->tpl_vars['i']->value<=1) {?>bottom<?php } else { ?>top<?php }?>"data-toggle="tooltip" data-original-title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['badge']->value->description,'html','UTF-8');?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['badge']->value->getBadgeImgUrl();?>
"></div>
								<div class="gamification_badges_name"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escape'][0][0]->smartyEscape($_smarty_tpl->tpl_vars['badge']->value->name,'html','UTF-8');?>
</div>
							</li>
						<?php }?>
					<?php } ?>
					</ul>
				</div>
			</div>

			<footer class="panel-footer">
				<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminGamification');?>
"><?php echo smartyTranslate(array('s'=>'View my complete profile','mod'=>'gamification'),$_smarty_tpl);?>
</a>
			</footer>
		</section>
	</div>
</li>
<?php }} ?>
