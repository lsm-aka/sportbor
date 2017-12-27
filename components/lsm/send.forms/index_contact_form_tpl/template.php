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

<div class="contacts-form contacts-form-index">     
  <form id="contact_form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <?=bitrix_sessid_post()?>

    <div class="row">
      <div class="form-left-group col-xs-12 col-sm-6">
          <div class="form-group">
            <input type="text" class="form-control requare round-agle" id="input_con_1" name="user_date_1" placeholder="<?=GetMessage("MFT_DATA_1")?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control requare round-agle" id="input_con_2" name="user_name" placeholder="<?=GetMessage("MFT_NAME")?>">
          </div> 
          <div class="form-group">
            <input type="tel" class="form-control requare round-agle" id="input_con_3" name="user_phone" placeholder="<?=GetMessage("MFT_PHONE")?>">
          </div>        
      </div>
      <div class="form-right-group col-xs-12 col-sm-6">
        <div class="form-group">
            <input type="text" class="form-control requare round-agle" id="input_con_4" name="user_date_2" placeholder="<?=GetMessage("MFT_DATA_2")?>">
          </div>
        <div class="form-group">
            <input type="text" class="form-control requare round-agle" id="input_con_5" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>">
        </div>
        <div class="form-group">  
          <select class="js-select3 form-control round-agle" name="userselect">
            <option value="<?=GetMessage("MFT_SELECT_1")?>"><?=GetMessage("MFT_SELECT_1")?></option>
            <option selected="selected" value="<?=GetMessage("MFT_SELECT_2")?>"><?=GetMessage("MFT_SELECT_2")?></option>
            <option value="<?=GetMessage("MFT_SELECT_3")?>"><?=GetMessage("MFT_SELECT_3")?></option>
            <option value="<?=GetMessage("MFT_SELECT_4")?>"><?=GetMessage("MFT_SELECT_4")?></option> 
            <option value="<?=GetMessage("MFT_SELECT_5")?>"><?=GetMessage("MFT_SELECT_5")?></option> 
          </select>
        </div>
      </div>
    </div><!-- end row -->

    <div class="row">
     <div class="form-group col-xs-12">
      <textarea class="form-control requare round-agle" name="msgtext" rows="3" placeholder="<?=GetMessage("MFT_MESSAGE")?>"></textarea>
     </div>
    </div><!-- end row -->

    <div class="row">
      <div class="form-group captcha-container col-xs-12">
        <?if($arParams["USE_CAPTCHA"] == "Y"){?>
        <div class="captcha-row">
          <div class="captcha_sid-box col-xs-12 col-sm-6 col-md-5 col-lg-5">      
            <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="200" height="46" alt="CAPTCHA">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">    
            <input type="text" class="captcha_word_input form-control" name="captcha_word" size="30" maxlength="50" value="" placeholder="<?=GetMessage("MFT_QAPTCHS_PH")?>">
          </div>
        </div>
        <?}?>
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input type="hidden" name="element-name" value="<?=$arParams["ELEMENT_NAME"]?>">
      </div>
    </div><!-- end row -->

    <div class="row">
      <div class="form-checkbox-group col-xs-12">
        <input type="checkbox" id="cin1" name="user_agree" value="Y" />
        <label for="cin1"><span></span><?=GetMessage("MFT_CHECKBOX_TITLE")?></label>
      </div>

      <div class="form-group btn-box col-xs-12 text-center">
        <input class="btn btn-color btn-lg round-agle" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT2")?>">
      </div>
    </div><!-- end row -->
  </form>

    <?if(!empty($arResult["ERROR_MESSAGE"]))
      {
        foreach($arResult["ERROR_MESSAGE"] as $v)
          ShowError($v);
        echo '<script>selectCall3();</script>';
      }
      if(strlen($arResult["OK_MESSAGE"]) > 0)
      {
        ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
        echo '<script>selectCall3();</script>';
      }
    ?>
</div>

 <script>
    if(document.getElementById("input_con_3")){
      var selector2 = document.getElementById("input_con_3");
      var im = new Inputmask("99-9999999");
      im.mask(selector2);
      Inputmask({"mask": "+7(999) 999-9999"}).mask(selector2);
    }
  </script>