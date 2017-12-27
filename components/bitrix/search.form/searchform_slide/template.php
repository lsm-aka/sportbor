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
$this->setFrameMode(true);?>
<div class="search-form container">
	<form action="<?=$arResult["FORM_ACTION"]?>">		
		<div class="search-form-input-box">
			<input class="search-form-input" type="text" name="q" value="" size="15" maxlength="50" placeholder="<?=GetMessage('BSF_T_SEARCH_BUTTON')?>" />
			<button class="search-form-submit" type="submit"><span class="icon-search"></span></button>
		</div>			
	</form>
</div>