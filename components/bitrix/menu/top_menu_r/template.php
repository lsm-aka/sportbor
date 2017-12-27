<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)){?>
<nav class="navbar navbar-default">
	<ul class="nav-bar list-unstyled">
			<?	
			foreach($arResult as $arItem){			
			?>
					<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){?>
						<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
					<?}?>		

						<?if ($arItem["IS_PARENT"]){?>

							<?if ($arItem["DEPTH_LEVEL"] == 1){?>
								<li><a class="menu-link drop-down level_<?=$arItem["DEPTH_LEVEL"]?> <?if ($arItem["SELECTED"]){?>active<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <span class="icon-chevron-small-down"></span></a>
									<ul class="list-unstyled">
							<?}else{?>
								<li<?if ($arItem["SELECTED"]){?> class="item-selected"<?}?>><a class="menu-link child-menu-link drop-down level_<?=$arItem["DEPTH_LEVEL"]?> <?if ($arItem["SELECTED"]){?>active<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <span class="icon-chevron-small-down"></span></a>
									<ul class="list-unstyled">
							<?}?>

						<?}else{?>

							<?if ($arItem["PERMISSION"] > "D"){?>

								<?if ($arItem["DEPTH_LEVEL"] == 1){?>
									<li><a class="menu-link level_<?=$arItem["DEPTH_LEVEL"]?> <?if ($arItem["SELECTED"]){?>active<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
								<?}else{?>
									<li<?if ($arItem["SELECTED"]){?> class="item-selected"<?}?>><a class="menu-link child-menu-link level_<?=$arItem["DEPTH_LEVEL"]?> <?if ($arItem["SELECTED"]){?>active<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
								<?}?>

							<?}else{?>

								<?if ($arItem["DEPTH_LEVEL"] == 1){?>
									<li><a class="menu-link level_<?=$arItem["DEPTH_LEVEL"]?> <?if ($arItem["SELECTED"]){?>active<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
								<?}else{?>
									<li><a href="" class="denied child-menu-link menu-link level_<?=$arItem["DEPTH_LEVEL"]?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
								<?}?>

							<?}?>

						<?}?>

					<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
				
				<?} //endforeach?>

				<?if ($previousLevel > 1){//close last item tags?>
					<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
				<?}?>			
		</ul>
</nav>
<?}?>