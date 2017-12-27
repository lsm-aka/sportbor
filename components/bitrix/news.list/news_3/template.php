<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="row flex-box">
	<div class="col-xs-12 col-sm-6 col-lg-4 item-1">
		<?
		$APPLICATION->IncludeFile(SITE_DIR . 'include/news/text_tpl_3.php', array(), array(
				"MODE" => "html",
				"NAME" => "текст",
			)
		);
		?>
	</div>
<?
$this->AddEditAction($arResult["TOP_ITEM"]["ID"], $arResult["TOP_ITEM"]["EDIT_LINK"], CIBlock::GetArrayByID($arResult["TOP_ITEM"]["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult["TOP_ITEM"]["ID"], $arResult["TOP_ITEM"]["DELETE_LINK"], CIBlock::GetArrayByID($arResult["TOP_ITEM"]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));

 $img_file = CFile::ResizeImageGet($arResult["TOP_ITEM"]['PREVIEW_PICTURE'], array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true); 

?>

<div class="col-xs-12 col-sm-6 col-lg-4 visible-lg item-2">
	<div class="news-elem-box round-agle id="<?=$this->GetEditAreaId($arResult["TOP_ITEM"]["ID"]);?>"">
		<a class="round-agle-tops" href="<?=$arResult["TOP_ITEM"]["DETAIL_PAGE_URL"]?>">
			<div class="img-box flex-box scale-box" style="background-image:url(<?=$img_file["src"];?>"></div>
		</a>
		<div class="content-wrap">
			<a class="detail-link" href="<?=$arResult["TOP_ITEM"]["DETAIL_PAGE_URL"]?>"><h3 class="list-elements-title"><?=$arResult["TOP_ITEM"]["NAME"];?></h3></a>
			<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["TOP_ITEM"]["DATE_ACTIVE_FROM"]){?>
				<span class="create-date">
					<?echo FormatDateFromDB( $arResult["TOP_ITEM"]["DATE_ACTIVE_FROM"], 'DD MMMM YYYY' );?>
				</span>
			<?}?>			
		</div>
	</div>
</div>


<div class="col-xs-12 col-sm-6 col-lg-4 item-3">
	<div class="news-elem-box round-agle">
		<div class="content-wrap">
			<div id="news-list-navbar" class="vert-news-slider">
				<ul class="list-unstyled">
					<?
					$n=0;
					foreach($arResult["ITEMS"] as $arItem){
						$n++;
						$this->AddEditAction($arItem["ID"], $arItem["EDIT_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem["ID"], $arItem["DELETE_LINK"], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

					?>
						<li id="<?=$this->GetEditAreaId($arItem["ID"]);?>">
							<div class="like-p">
								<a class="detail-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
							</div>
							<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
								<span class="create-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
							<?}?>
						</li>
						<?
						if( $n<count($arResult["ITEMS"]) ){
							echo '<li class="divider-li"></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
</div> <!-- /row -->
<div class="cls"></div>
<div class="col-xs-12 btn-block">
	<a href="<?=SITE_DIR?>news/" class="btn btn-color btn-md hidden-sm hidden-md hidden-lg"><?=GetMessage('CT_BNL_ALL_NEWS')?></a>
</div>