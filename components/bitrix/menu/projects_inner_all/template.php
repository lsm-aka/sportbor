<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="center-menu list-inline button-group">
		<li><a href="<?=SITE_DIR?>projects/" class="btn btn-color btn-sm"><?=GetMessage('ALL_LINKS_BTN');?></a></li>
		<?
		foreach($arResult as $arItem):
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
				continue;
		?>
			<li><a href="<?=$arItem["LINK"]?>" class="btn btn-sm"><?=$arItem["TEXT"]?></a></li>			
		<?endforeach?>

	</ul>
<?endif?>