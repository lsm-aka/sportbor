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
<div id="projects-inner-body">
	<div class="row inner-row">				
		<?
		if( count($arResult["ITEMS"])>0 ){
			$n=0;
			foreach ($arResult["ITEMS"] as $arItem) {
				$n++;
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if( $arItem["PREVIEW_PICTURE"]["ID"]>0 ){
					$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>400, 'height'=>289), BX_RESIZE_IMAGE_EXACT, true);
				}
				elseif( $arItem["DETAIL_PICTURE"]["ID"]>0 ){
					$img_file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>400, 'height'=>289), BX_RESIZE_IMAGE_EXACT, true);
				}			
				else{
					$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.jpg", "width"=>"400", "height"=>"289");
				}					
		?>
				<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-sm-6 col-lg-4 item">
					
					<?if( is_array($img_file) ){?>
						<div class="image-box round-agle scale-img-box">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="project-link">
								<img src="<?=$img_file['src']?>" alt="" class="img-responsive" />
							</a>
						</div>
					<?}?>							
					<div class="list-content">
						<div class="preview-block">						
								<h3 class="title-box">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="project-link">
										<?
											if( strlen($arItem["NAME"])>140 ){
												$name_text = strip_tags($arItem["NAME"]);
												$name_text = substr($name_text, 0, 140);
												$name_text = rtrim($name_text, "!,.-");
												$name_text = substr($name_text, 0, strrpos($name_text, ' '));
												echo  '<span>' . $name_text."… " . '</span>';
											}
											else{
												echo '<span>' . $arItem["NAME"] . '</span>';
											}	
											
										?>
									</a>
								</h3>
						</div>									
					</div>		
				</div>
		<?
				if($n%3==0){
					echo '<div class="cls visible-lg"></div>';
				}
				if($n%2==0){
					echo '<div class="cls visible-sm visible-md"></div>';
				}
				
			}
		}
		?>
	</div>			
</div>