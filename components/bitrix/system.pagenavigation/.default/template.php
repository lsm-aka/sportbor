<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult["NavPageCount"] != 1 && empty($arResult["bShowAll"]) && $arResult["nEndPage"] > 0){?>
	<?
	$count_item = 1;
	$arResult["nStartPage"] = $arResult["NavPageNomer"] - $count_item;
	$arResult["nStartPage"] = $arResult["nStartPage"] <= 0 ? 1 : $arResult["nStartPage"];
	
	$arResult["nEndPage"] = $arResult["NavPageNomer"] + $count_item;
	$arResult["nEndPage"] = $arResult["nEndPage"] > $arResult["NavPageCount"] ? $arResult["NavPageCount"] : $arResult["nEndPage"];
	
	$strNavQueryString = !empty($arResult["NavQueryString"]) ? $arResult["NavQueryString"].'&amp;' : '';
	$strNavQueryStringFull = !empty($arResult["NavQueryString"]) ? "?".$arResult["NavQueryString"] : '';
	?>
	<div class="wrap_pagination">
		<ul class="pagination list-unstyled">
			<?if($arResult["NavPageNomer"] > 1){?>
				<li class="prev"><a class="flex-box" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><i class="navigation-icons icon-angle-left"></i> <span class="nav-text-l"><?=GetMessage('nav_left');?></span></a></li>
			<?
			}
			else{
			?>
				<li class="prev"><a class="flex-box" href="javascript:void(0);"><i class="navigation-icons icon-angle-left"></i> <span class="nav-text-l"><?=GetMessage('nav_left');?></span></a></li>
			<?
			}
			?>
			<?if($arResult["nStartPage"] > 1){?>
				<li><span>...</span></li>
			<?}?>
			<?while($arResult["nStartPage"] <= $arResult["nEndPage"]){?>			
				<?if($arResult["nStartPage"] == $arResult["NavPageNomer"]){?>
					<li class="active"><span><?=$arResult["nStartPage"]?></span></li>
				<?}elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false){?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
				<?}else{?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
				<?}?>
				<?++$arResult["nStartPage"];?>
			<?}?>
			<?if($arResult["nEndPage"] < $arResult["NavPageCount"]){?>
				<li class="before"><span>...</span></li>
			<?}?>
			<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
				<li class="next"><a class="flex-box" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span class="nav-text-r"><?=GetMessage('nav_right');?></span> <i class="navigation-icons icon-angle-right"></i></a></li>				
			<?
			}
			else{
			?>
				<li class="next"><a class="flex-box" href="javascript:void(0);"><span class="nav-text-r"><?=GetMessage('nav_right');?></span> <i class="navigation-icons icon-angle-right"></i></a></li>
			<?	
			}
			?>
		</ul>
	</div>
<?}?>