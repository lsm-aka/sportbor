<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="nav-bar-right list-unstyled round-agle">

<?
global $APPLICATION;
$link_dir = $APPLICATION->GetCurDir();
$links = explode('/', $link_dir);
$links_count = count($links);
$fruit = array_pop($links);
$fruit2 = array_pop($links);
$link_dir = implode('/', $links) . '/';
//####################################


$previousLevel = 0;
foreach($arResult as $arItem):?>
<?
//--------------------------------------------
$link_href = explode('/', $arItem["LINK"]);
$fruit3 = array_pop($link_href);
$fruit4 = array_pop($link_href);

$activate = false;
if($arItem["LINK"] == $link_dir){
	$activate = true;
}
elseif( in_array($fruit4, $links) ){
	$activate = true;
}

if( $links_count<5 ){
	$activate = false;
}
//-------------------------------------------
?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?if ($arItem["SELECTED"] || $activate ):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <i class="icon-chevron-small-down"></i></a></span>
				<ul class="list-unstyled first-ul">
		<?else:?>
			<li class="<?if ($arItem["SELECTED"] || $activate):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <i class="icon-chevron-small-down"></i></a></span>
				<ul class="list-unstyled">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"] || $activate):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span></li>
			<?else:?>
				<li class="<?if ($arItem["SELECTED"] || $activate):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"] || $activate):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span></li>
			<?else:?>
				<li class="<?if ($arItem["SELECTED"] || $activate):?>active<?else:?>li-item<?endif?>"><span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>