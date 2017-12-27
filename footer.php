<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<?
if( !Csimplekit::IsMainPage() ){ // Если перешли на внутренную страницу
?>
				</div>
			</div>
		</div>
	</section>
</div><!-- /inner-page -->
<?	
 }
?>

<?
$params_in_index = (isset($arLsmTheme["FOOTER_TPL"]["VALUE"]) && $arLsmTheme["DISPLAY_TPL_FOOTER"]["VALUE"] == 'Y');
if( $params_in_index || !Csimplekit::IsMainPage() ){
?>
 
		<footer class="<?php echo $arLsmTheme["FOOTER_BG"]["VALUE"];?>">	
			<?				
				$APPLICATION->IncludeComponent(
		          "bitrix:main.include",
		          "",
		          Array(
		            "AREA_FILE_SHOW" => "file",
		            "AREA_FILE_SUFFIX" => "",
		            "AREA_FILE_RECURSIVE" => "Y",
		            "EDIT_TEMPLATE" => "standard.php",
		            "PATH" => SITE_DIR . 'include/footer/tpl' . $arLsmTheme["FOOTER_TPL"]["VALUE"] . '/index.php'
		          )
		        );    
			?>
		</footer>
<?	
}			
?>
    
	</div>	
	</div> <!-- global-container -->
</body>
</html>