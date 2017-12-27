<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)){?>
<div id="top-navbar">
	<nav id="navbar_greedy" class="navbar navbar-default greedy">
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav nav-bar list-inline links">
				<?	
				foreach($arResult as $arItem){			
				?>
						<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){?>
							<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
						<?}?>		

							<?if ($arItem["IS_PARENT"]){?>

								<?if ($arItem["DEPTH_LEVEL"] == 1){?>
									<li class="dropdown"><a class="menu-link drop-down" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <span class="icon-chevron-small-down"></span></a>
										<ul class="list-unstyled dropdown-menu level-<?=$arItem["DEPTH_LEVEL"]?>">
								<?}else{?>
									<li<?if ($arItem["SELECTED"]){?> class="item-selected"<?}?>><a class="menu-link child-menu-link drop-down" href="<?=$arItem["LINK"]?>"><span class="top-menu-subtext"><?=$arItem["TEXT"]?></span> <span class="icon-chevron-small-down submenu-icones"></span></a>
										<ul class="list-unstyled level-<?=$arItem["DEPTH_LEVEL"]?>">
								<?}?>

							<?}else{?>

								<?if ($arItem["PERMISSION"] > "D"){?>

									<?if ($arItem["DEPTH_LEVEL"] == 1){?>
										<li><a class="menu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
									<?}else{?>
										<li<?if ($arItem["SELECTED"]){?> class="item-selected"<?}?>><a class="menu-link child-menu-link" href="<?=$arItem["LINK"]?>"><span class="top-menu-subtext"><?=$arItem["TEXT"]?></span></a></li>
									<?}?>

								<?}else{?>

									<?if ($arItem["DEPTH_LEVEL"] == 1){?>
										<li><a class="menu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
									<?}else{?>
										<li><a href="" class="denied child-menu-link menu-link" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><span class="top-menu-subtext"><?=$arItem["TEXT"]?></span></a></li>
									<?}?>

								<?}?>

							<?}?>

						<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
					
					<?} //endforeach?>

					<?if ($previousLevel > 1){//close last item tags?>
						<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
					<?}?>
			</ul>
		</div>									
	</nav>
</div><!-- /top-navbar -->
	
<?}?>