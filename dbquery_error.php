<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// страница-заглушка
// https://www.mousedc.ru/learning/94/
?>
<script type="text/javascript">
    document.querySelector('head').innerHTML = '<title>Технические работы</title>';  
    var intermediateText = '<div style="position: absolute; top: 0; background-color: white; width: 99%; height: 99%; z-index: 1000000;">' + 
                    '<div style="font-size: 22px; text-align: center; margin: 45vh auto; z-index: 1000010;">' + 
        'Внимание! На портале ведутся технические работы.<br>Приносим извинения за доставленные неудобства.</div></div>';

    var newScript = document.createElement("script");
    newScript.innerHTML = 'document.addEventListener("DOMContentLoaded", function() { document.body.innerHTML = ' + 
    intermediateText + '; });';

    document.body.innerHTML = intermediateText;
    document.querySelector('head').appendChild(newScript);
    document.addEventListener("DOMContentLoaded", function() {
        document.body.innerHTML = intermediateText;
	});  
</script>
