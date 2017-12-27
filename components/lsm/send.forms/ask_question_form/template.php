<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div id="ajax-add-answer">
  <h3><?=$arParams["FORM_TITLE_TEXT"]?></h3>

    <?if(!empty($arResult["ERROR_MESSAGE"]))
    {
      foreach($arResult["ERROR_MESSAGE"] as $v)
        ShowError($v);
    }
    if(strlen($arResult["OK_MESSAGE"]) > 0)
    {
      ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
    }
  ?>

  <form id="lsm_form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
  <?=bitrix_sessid_post()?>
    <div class="form-group">    
      <input type="text" class="form-control" id="fio" name="user_name" placeholder="<?=GetMessage("MFT_NAME")?>"  value="<?=$arResult["AUTHOR_NAME"]?>" />
    </div>

    <div class="form-group">    
      <input type="text" class="form-control" id="email" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>" />
    </div>

    <div class="form-group">    
      <input type="tel" class="form-control" id="phone" name="user_phone" placeholder="<?=GetMessage("MFT_PHONE")?>" />
    </div>

    <div class="divider-box-text">    
      <?=GetMessage("MFT_MESSAGE_THEME")?>
    </div>

    <div class="form-group">  
      <select class="js-select2" name="userselect">
        <option value="<?=GetMessage("MFT_SELECT_1")?>"><?=GetMessage("MFT_SELECT_1")?></option>
        <option selected="selected" value="<?=GetMessage("MFT_SELECT_2")?>"><?=GetMessage("MFT_SELECT_2")?></option>
        <option value="<?=GetMessage("MFT_SELECT_3")?>"><?=GetMessage("MFT_SELECT_3")?></option>
        <option value="<?=GetMessage("MFT_SELECT_4")?>"><?=GetMessage("MFT_SELECT_4")?></option> 
        <option value="<?=GetMessage("MFT_SELECT_5")?>"><?=GetMessage("MFT_SELECT_5")?></option> 
      </select>
    </div>
    
    <div class="form-group">    
        <textarea name="MESSAGE" class="form-control" placeholder="<?=GetMessage("MFT_MESSAGE")?>"><?=$arResult["MESSAGE"]?></textarea>
    </div>
  
	<div class="form-group captcha-container">
		<?if($arParams["USE_CAPTCHA"] == "Y"){?>
		<div class="row">
			<div class="col-xs-6">			
				<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="144" height="46" alt="CAPTCHA">
			</div>
			<div class="col-xs-6">		
				<input type="text" class="captcha_word_input form-control" name="captcha_word" size="30" maxlength="50" value="">
			</div>
		</div>
		<?}?>
		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
    <input type="hidden" name="element-name" value="<?=$arParams["ELEMENT_NAME"]?>">
	</div>

	<div class="form-checkbox-group">
		<input type="checkbox" id="c1" name="user_agree" value="Y" />
		<label for="c1"><span></span><?=GetMessage("MFT_CHECKBOX_TITLE")?></label>    
	</div>

    <div  class="btn-block">
      <input class="btn btn-color btn-md" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
    </div>

  </form>

  <script>
    if(document.getElementById("phone")){
      var selector1 = document.getElementById("phone");
      var im = new Inputmask("99-9999999");
      im.mask(selector1);
      Inputmask({"mask": "+7(999) 999-9999"}).mask(selector1);
    }
    selectCall();
  </script>
</div>