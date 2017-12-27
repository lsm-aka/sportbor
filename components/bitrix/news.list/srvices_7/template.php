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
<div class="container services-body">
		<div class="row">
			<?
			if( count($arResult["THIS_SECTIONS"])>0 ){	
				$n=0;		
				foreach ($arResult["THIS_SECTIONS"] as $arSections) {
					$n++;
					if( $arSections["PICTURE"]>0 ){
						$img_file = CFile::ResizeImageGet($arSections["PICTURE"], array('width'=>640, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true);
					}
					else{
						$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"640", "height"=>"360");
					}

					if($n==3){
						$hidden_class = ' hidden-xs hidden-sm';
					}

					if($n>3){
						break;
					}
										
			?>

			<div class="item col-xs-12 col-sm-6 col-md-4<?=$hidden_class;?>">
				<div class="row">					
					<div class="img-box col-xs-12 col-sm-3">
						<a href="<?=$arSections['SECTION_PAGE_URL']?>" class="detail-link">
						<span aria-hidden="true" class="uf-vector-<?=$arSections["UF_SERVICES_ICONS"];?> service_icons"></span>
						</a>		
					</div>
					<div class="content-box col-xs-12 col-sm-9">
						<a href="<?=$arSections['SECTION_PAGE_URL']?>">
							<h3 class="list-elements-title"><?=$arSections["NAME"]?></h3>
						</a>
						<?
						if( strlen($arSections["DESCRIPTION"]) ){
						?>
							<p>	
								<?				
									if( $arParams["PREVIEW_TRUNCATE_LEN"]>0 ){
										$truncate_len = $arParams["PREVIEW_TRUNCATE_LEN"];
									}
									else{
										$truncate_len = 150;
									}
									$obParser = new CTextParser;
									if($truncate_len > 0){
										$arSections["DESCRIPTION"] = $obParser->html_cut($arSections["DESCRIPTION"], $truncate_len);
									}													
									echo $arSections["DESCRIPTION"];
								?>
							</p>
						<?					
						}
						?>		

						<?
						if( count($arResult["THIS_SECTIONS"]["SECTIONS"])>0 ){
							echo '<ul class="list-unstyled">';
							foreach ($arResult["THIS_SECTIONS"]["SECTIONS"][$arSections["ID"]] as $arItemSection) {
						?>
								<li class="flex-box"><i class="icon-checkmark"></i> <a href="<?=$arItemSection['SECTION_PAGE_URL']?>"><?=$arItemSection["NAME"]?></a></li>
						<?
							}
							echo '</ul>';
						}
						?>
		

					</div>	
				</div>				
			</div>
			<?					
				}	
			}
			?>
			<div class="cls"></div>				
		</div> <!-- /row -->	
		<div class="btn-block">			
			<a href="<?=SITE_DIR?>services/" class="btn btn-default btn-md"><?=GetMessage('CT_BNL_ALL_SERVICES');?></a>
		</div>			
	</div>