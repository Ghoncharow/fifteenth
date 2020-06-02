<? define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/dev/log.html");

if (IsModuleInstalled("socialnetwork") && CModule::IncludeModule("socialnetwork")) {

    if (IsModuleInstalled("im") && CModule::IncludeModule("im")) {
        AddEventHandler("im", "OnBeforeMessageNotifyAdd", "beforeMessageNotifyAdd");
        function beforeMessageNotifyAdd($arFields) {

            if($arFields["NOTIFY_TYPE"] == 2 && $arFields["FROM_USER_ID"] != $arFields["TO_USER_ID"] &&
             strpos($arFields["NOTIFY_TAG"], "SOCNET|OWNER_GROUP|") !== false) {
                $groupId = preg_replace('/[^0-9]/', '', $arFields["NOTIFY_TAG"]);

                $userTo = new CUser;        
                // какие поля раздела инфоблока выбираем
                $arSelect = array(
                    'ID',
                    'NAME',
                    'UF_*' // получаем пользовательские поля
                );
                // условия выборки раздела инфоблока
                $arFilter = array(
                    'IBLOCK_ID' => 44,
                    'ACTIVE' => 'Y',
                    'UF_IB44_COUNCIL' => $groupId
                );
                // выполняем запрос к базе данных
                $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
                $latestSectionTo = intval($rsSection->GetNext()["ID"]);
                $rsUserTo = CUser::GetByID($arFields["TO_USER_ID"]);
                $arUserTo = $rsUserTo->Fetch();
                $fullNameTo = $arUserTo["LAST_NAME"]." ".$arUserTo["NAME"]." ".$arUserTo["SECOND_NAME"];
                if (empty($arUserTo["UF_YOUTH_COUNCIL"])) $arUserTo["UF_YOUTH_COUNCIL"] = array();
                if (in_array($latestSectionTo, $arUserTo["UF_YOUTH_COUNCIL"])) $arUserNewPositionsTo = $arUserTo["UF_YOUTH_COUNCIL"];
                else $arUserNewPositionsTo = array_merge($arUserTo["UF_YOUTH_COUNCIL"], array($latestSectionTo));

                $userFieldsTo = Array( 
                    "UF_YOUTH_COUNCIL" => $arUserNewPositionsTo, 
                    "UF_COUNCIL_POSITION" => $arUserTo["UF_COUNCIL_POSITION"] ? $arUserTo["UF_COUNCIL_POSITION"] : "Член совета", 
                );                
                
                $arMessageFieldsTo = array(
                    // получатель
                   "TO_USER_ID" => $arFields["FROM_USER_ID"],
                   // отправитель
                   "FROM_USER_ID" => $arFields["TO_USER_ID"], 
                   // тип уведомления
                   "NOTIFY_TYPE" => IM_NOTIFY_FROM, 
                   // модуль запросивший отправку уведомления
                   "NOTIFY_MODULE" => "im", 
                   // символьный тэг для группировки и массового удаления, если это не требуется - не задаем параметр
                   // "NOTIFY_TAG" => "BLOG|POST|123", 
                   // текст уведомления на сайте
                   "NOTIFY_MESSAGE" => '[b]Внимание:[/b] впишите или измените должность сотрудника '.$fullNameTo.
                   ' в <a href="/workgroups/group/'.$groupId.'/structure/" class="bx-notifier-item-action">структуре Молодёжного совета</a>.', 
                   // текст уведомления для отправки на почту (или XMPP), если различий нет - не задаем параметр
                   "NOTIFY_MESSAGE_OUT" => 'Кадровые изменения в структуре Молодёжного совета Федерального казначейства.' 
                );

                if ($latestSectionTo) {
                    CIMNotify::Add($arMessageFieldsTo);
                    $userTo->Update($arFields["TO_USER_ID"], $userFieldsTo);
                    AddMessage2Log("СТАЛ_ГЛАВНЫМ<script>console.log(".json_encode($arUserNewPositionsTo).");</script><br>", '', 0);
                } 
            }
            if($arFields["NOTIFY_TYPE"] == 2 && strpos($arFields["NOTIFY_TAG"], "SOCNET|INVITE_GROUP_SUCCESS|") !== false) {
                
                $rsUser = CUser::GetByID($arFields["FROM_USER_ID"]);
                $arUser = $rsUser->Fetch();
                $fullName = $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"];
                $arMessageFields = array(
                    // получатель
                   "TO_USER_ID" => $arFields["TO_USER_ID"],
                   // отправитель
                   "FROM_USER_ID" => $arFields["FROM_USER_ID"], 
                   // тип уведомления
                   "NOTIFY_TYPE" => IM_NOTIFY_FROM, 
                   // модуль запросивший отправку уведомления
                   "NOTIFY_MODULE" => "im", 
                   // символьный тэг для группировки и массового удаления, если это не требуется - не задаем параметр
                   // "NOTIFY_TAG" => "BLOG|POST|123", 
                   // текст уведомления на сайте
                   "NOTIFY_MESSAGE" => $arFields["NOTIFY_MESSAGE"].'.[br][b]Внимание:[/b] необходимо вписать должность сотрудника '.
                   $fullName.' в <a href="/workgroups/group/'.preg_replace('/[^0-9]/', '', $arFields["NOTIFY_TAG"]).
                   '/structure/" class="bx-notifier-item-action">структуре Молодёжного совета</a>.', 
                   // текст уведомления для отправки на почту (или XMPP), если различий нет - не задаем параметр
                   "NOTIFY_MESSAGE_OUT" => 'Кадровые изменения в структуре Молодёжного совета Федерального казначейства.' 
                );
                CIMNotify::Add($arMessageFields);

                AddMessage2Log("СОГЛАСИЛСЯ_ВСТУПИТЬ<script>console.log(".json_encode($arUser).");</script><br>", '', 0); 
            }
            if($arFields["NOTIFY_TYPE"] == 2 && strpos($arFields["NOTIFY_TAG"], "SOCNET|INVITE_GROUP|".$arFields["TO_USER_ID"]) !== false) {

                $rsUser = CUser::GetByID($arFields["TO_USER_ID"]);
                $arUser = $rsUser->Fetch();
                $fullName = $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"];
                $inviteId = str_replace("SOCNET|INVITE_GROUP|".$arFields["TO_USER_ID"]."|", "", $arFields["NOTIFY_TAG"]);
                $arrInvite = CSocNetUserToGroup::GetByID($inviteId);

                $user = new CUser;        
                // какие поля раздела инфоблока выбираем
                $arSelect = array(
                    'ID',
                    'NAME',
                    'DESCRIPTION',
                    'UF_*' // получаем пользовательские поля
                );
                // условия выборки раздела инфоблока
                $arFilter = array(
                    'IBLOCK_ID' => 44,
                    'ACTIVE' => 'Y',
                    'UF_IB44_COUNCIL' => $arrInvite["GROUP_ID"]
                );
                // выполняем запрос к базе данных
                $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
                $latestSection = intval($rsSection->GetNext()["ID"]);
                $rsUser = CUser::GetByID($arFields["TO_USER_ID"]);
                $arUserPositions = $rsUser->Fetch();
                if (empty($arUserPositions["UF_YOUTH_COUNCIL"])) $arUserPositions["UF_YOUTH_COUNCIL"] = array();
                if (in_array($latestSection, $arUserPositions["UF_YOUTH_COUNCIL"])) $arUserNewPositions = $arUserPositions["UF_YOUTH_COUNCIL"];
                else $arUserNewPositions = array_merge($arUserPositions["UF_YOUTH_COUNCIL"], array($latestSection));

                $userFields = Array( 
                    "UF_YOUTH_COUNCIL" => $arUserNewPositions, 
                    "UF_COUNCIL_POSITION" => $arUserPositions["UF_COUNCIL_POSITION"] ? $arUserPositions["UF_COUNCIL_POSITION"] : "Член совета", 
                );

                $arMessageFields = array(
                    // получатель
                   "TO_USER_ID" => $arFields["FROM_USER_ID"],
                   // отправитель
                   "FROM_USER_ID" => $arFields["TO_USER_ID"], 
                   // тип уведомления
                   "NOTIFY_TYPE" => IM_NOTIFY_FROM, 
                   // модуль запросивший отправку уведомления
                   "NOTIFY_MODULE" => "im", 
                   // символьный тэг для группировки и массового удаления, если это не требуется - не задаем параметр
                   // "NOTIFY_TAG" => "BLOG|POST|123", 
                   // текст уведомления на сайте
                   "NOTIFY_MESSAGE" => '[b]Внимание:[/b] необходимо вписать должность сотрудника '.$fullName.
                   ' в <a href="/workgroups/group/'.$arrInvite["GROUP_ID"].
                   '/structure/" class="bx-notifier-item-action">структуре Молодёжного совета</a>.', 
                   // текст уведомления для отправки на почту (или XMPP), если различий нет - не задаем параметр
                   "NOTIFY_MESSAGE_OUT" => 'Кадровые изменения в структуре Молодёжного совета Федерального казначейства.' 
                );

                if ($latestSection) {
                    CIMNotify::Add($arMessageFields);
                    $user->Update($arFields["TO_USER_ID"], $userFields);
                    AddMessage2Log("ВСТУПИЛ_АГА<script>console.log(".json_encode($arUserNewPositions).");</script><br>", '', 0);
                }
            }   
        }
    }

    AddEventHandler("socialnetwork", "OnSocNetUserConfirmRequestToBeMember", "socnetUserConfirmRequestToBeMember");
    function socnetUserConfirmRequestToBeMember($inviteId) {
        // при получении запроса о членстве в группе соцсети
        $arFields = CSocNetUserToGroup::GetByID($inviteId);        

        $user = new CUser;        
		// какие поля раздела инфоблока выбираем
        $arSelect = array(
            'ID',
            'NAME',
            'DESCRIPTION',
            'UF_*' // получаем пользовательские поля
        );
        // условия выборки раздела инфоблока
        $arFilter = array(
            'IBLOCK_ID' => 44,
            'ACTIVE' => 'Y',
            'UF_IB44_COUNCIL' => $arFields["GROUP_ID"]
        );
        // выполняем запрос к базе данных
        $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
        $latestSection = intval($rsSection->GetNext()["ID"]);
        $rsUser = CUser::GetByID($arFields["USER_ID"]);
        $arUserPositions = $rsUser->Fetch();
        if (empty($arUserPositions["UF_YOUTH_COUNCIL"])) $arUserPositions["UF_YOUTH_COUNCIL"] = array();
        if (in_array($latestSection, $arUserPositions["UF_YOUTH_COUNCIL"])) $arUserNewPositions = $arUserPositions["UF_YOUTH_COUNCIL"];
        else $arUserNewPositions = array_merge($arUserPositions["UF_YOUTH_COUNCIL"], array($latestSection));

        $userFields = Array( 
            "UF_YOUTH_COUNCIL" => $arUserNewPositions, 
            "UF_COUNCIL_POSITION" => $arUserPositions["UF_COUNCIL_POSITION"] ? $arUserPositions["UF_COUNCIL_POSITION"] : "Член совета", 
        );

        if ($latestSection) {
            $user->Update($arFields["USER_ID"], $userFields);
            AddMessage2Log("ВСТУПИЛ_УЖЕ3<script>console.log(".json_encode($arUserNewPositions).");</script><br>", '', 0);
        }
    } 
    AddEventHandler("socialnetwork", "OnSocNetUserToGroupDelete", "___OnSocNetUserToGroupDelete");
    function ___OnSocNetUserToGroupDelete($inviteId) {
        // в момент удаления связи между пользователем и рабочей группой
        $arFields = CSocNetUserToGroup::GetByID($inviteId);        

        $user = new CUser;      
		// какие поля раздела инфоблока выбираем
        $arSelect = array(
            'ID',
            'NAME',
            'DESCRIPTION',
            'UF_*' // получаем пользовательские поля
        );
        // условия выборки раздела инфоблока
        $arFilter = array(
            'IBLOCK_ID' => 44,
            'ACTIVE' => 'Y',
            'UF_IB44_COUNCIL' => $arFields["GROUP_ID"]
        );
        // выполняем запрос к базе данных
        $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
        $latestSection = intval($rsSection->GetNext()["ID"]);
        $rsUser = CUser::GetByID($arFields["USER_ID"]);
        $arUserPositions = $rsUser->Fetch();            
        $arUserNewPositions = $arUserPositions["UF_YOUTH_COUNCIL"];
        if(($key = array_search($latestSection, $arUserNewPositions)) !== FALSE){
            unset($arUserNewPositions[$key]);
        }

        $userFields = Array( 
            "UF_YOUTH_COUNCIL" => $arUserNewPositions, 
            "UF_COUNCIL_POSITION" => empty($arUserNewPositions) ? "" : $arUserPositions["UF_COUNCIL_POSITION"], 
        ); 

        if ($latestSection) {
            $user->Update($arFields["USER_ID"], $userFields);
            AddMessage2Log("УДАЛЁН_ТУТ<script>console.log(".json_encode($arUserNewPositions).");</script><br>", '', 0);
        }
    }
}
