<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>

</head>
<body>
    <div class="full">
        <div class="menuDIV">
            <div class="loginDIV">
                    <p>Sulmaca</p>
                    <p>Administrator</p>
                    <p>jt9970440</p>
                    <a href="includes/logout.inc.php"> <button class="btn">ログアウト</button> </a>        
            </div>
            <div class="navDIV">
                 <button class="btn2" onclick="displayRegForm()">CREATE NEW</button></a>
                 <button class="btn2" onclick="displayProgress()">PROGRESS</button></a>
                 <button class="btn2" onclick="training()">TRAINING</button></a>
                 <button class="btn2" onclick="regSignature()"> REGISTER SIGNATURE</button></a>
                 <button class="btn2" onclick="userManagement()">USER MANAGEMENT</button></a>
            </div>
        </div>
         <!-----------REGISTRATION FORM----------->
        <div class="main" id="main" style="display: none">
            <div class="scroll" id="div-scroll">
            <div  id="creationdepartment">
                <h2>教育
                <input type="text"
                style="width:15%"
                name="departmentID"
                id="departmentID"
                value="">
                </h2>
            </div>
            <div id="mainrecord">
                <form action="registrationForm.php" method="post">
                    <table id="mainrecordTable" border="1" class="mainrecordT">
                    <tbody>
                    <tr>
                    <td>
                    <span>名称：</span>
                    <input type="text"
                     name="educationID"
                     id="educationID"
                     value=""
                     style="width:90%">
                    </td>
                    <td>
                    <input type="checkbox" id="trainingLocInternal" name="trainingLocInternal" value="internal">
                    <label for="trainingLocInternal">社内</label>
                    <!--<select name="trainingloc" id="trainingloc">
                        <option value="internal">INTERNAL</option>
                        <option value="external">EXTERNAL</option>
                    </select>-->
                    </td>
                    <td>
                    <input type="checkbox" id="trainingLocExternal" name="trainingLocExternal" value="external">
                    <label for="trainingLocExternal">社外</label>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table id="mainrecordTable2" border="1" class="mainrecordT2">
                    <tr>
                    <td>
                    <span>日勤者実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeRegularStart" id="datetimeRegularStart" value="">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeRegularEnd" id="datetimeRegularEnd" value="">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationRegular" name="LocationRegular" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorRegularID" name="instructorRegularID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ａ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeAStart" id="datetimeAStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeAEnd" id="datetimeAEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationA" name="LocationA" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorAID" name="instructorAID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｂ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeBStart" id="datetimeBStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeBEnd" id="datetimeBEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationB" name="LocationB" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorBID" name="instructorBID" value="">
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <span>Ｃ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeCStart" id="datetimeCStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeCEnd" id="datetimeCEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationC" name="LocationC" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorCID" name="instructorCID" value="">
                    </td>
                     </tr>
                    <tr>
                    <td>
                    <span>Ｄ班実施日時：</span>
                    <td>
                    <input type="datetime-local" name="datetimeDStart" id="datetimeDStart">
                    </td>
                    <td>
                    <input type="datetime-local" name="datetimeDEnd" id="datetimeDEnd">
                    </td>
                    <td>場所：
                    <input type="text" id="LocationD" name="LocationD" value="">
                    </td>
                    <td>講師：
                    <input type="text" id="instructorDID" name="instructorDID" value="">
                    </td>
                    </tr>
                    </tbody>
                    </table>
            </div>
            <div id="categoryDIV" class="categoryDIV">
                     <caption>区分　（該当項目を丸枠で囲んで下さい。）</caption>
                    <table id="categoryTable" border="1" class="categoryT">
                    <tbody>
                    <tr>
                    <td style="width:25%">
                    <input type="checkbox" id="categoryQuality" name="categoryQuality" value="Quality">
                    <label for="categoryQuality">品質</label>
                    <!--<select name="categoryID" id="categoryID" class="categoryT">
                        <option value="quality">Quality</option>
                        <option value="environment">Environment</option>
                        <option value="safetyandhygiene">Safety And Hygiene</option>
                        <option value="other">Other</option>-->
                    </td>
                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categoryEnvironment"
                    name="categoryEnvironment" 
                    value="Environment">
                    <label for="categoryEnvironment">環境</label>
                    </td>
                    <td style="width:25%">
                    <input type="checkbox" 
                    id="categorySafetyAndHygiene" 
                    name="categorySafetyAndHygiene" 
                    value="SafetyAndHygiene">
                    <label for="categorySafetyAndHygiene">安全衛生</label>
                    </td>
                    <td style="width:25%">
                    <div>
                    <input type="checkbox" 
                    id="categoryOther" 
                    name="categoryOther" 
                    value="Other">
                    <label for="categoryOther">その他</label>
                    <input type="text" 
                    id="categoryOtherManual" 
                    value="" 
                    name="categoryOtherManual" 
                    placeholder="PLEASE SPECIFY"
                    style="width:70%">
                    </div>
                    </td>   
                    </select>
                    </tr>
                    </tbody>
                    </table>        
            </div>
            <div id="purposeDIV" class="purposeDIV">
                     <caption>目的、対象者</caption>
                    <table id="purposeTable" border="1" class="purposeT">
                    <tr>
                    <td>目的：</td>
                    <td colspan="3"><input type="text" name="purposeID" id="purposeID" value="" style="width:96%"></td>
                    </tr>
                    <tr>
                    <td>対象者：</td>
                    <td><input type="text" name="audienceID" id="audienceID" value="" style="width:90%"></td>
                    <td>名</td>
                    <td><input type="text" name="audienceNo" id="audienceNo" value="" style="width:90%"></td>
                    </tr>
                    </table>
            </div>
            <div id="contentsDIV" class="contentsDIV">
                <caption>内容</caption>
                <table id="contentsTable" border="1" class="contentsT">
                <tr>
                <td><textarea type="text" name="contentsID" id="contentsID" value="" class="contentsInput" rows="3"></textarea></td>
                </tr>
                </table>
            </div>
            <div id="usageDIV">
                    <caption>使用資料　（作業標準がある場合には、作業標準№を記入、ない場合には資料名等を記入）</caption>
                    <table id="usageTable" border="1" class="usageT">
                    <tr>
                    <td><textarea type="text" name="usageID" id="usageID" value="" rows="3" class="usageInput"></textarea></td>
                    </tr>
                </table>
            </div>
               <!--------------------------------------->
            </div>
        </div>
     
        <div class="progress" id="progress" style="display: none">
            <div id="table-wrapper">
                <div id="table-scroll">
                    <table id="progressTable" border="1" class="progressT">
                        <thead>
                    <tr id="firstrow">
                    <th style="width:12.5%">No</th>
                    <th style="width:40%">ファイル名</th>
                    <th style="width:12.5%">全体状態</th>
                    <th style="width:12.5%">備考欄</th>
                    <th style="width:12.5%">【サイン進捗】</th>
                    <th style="width:12.5%">【未サイン者】</th></tr>
                    </thead>
                    <tr><td>SG026</td><td>SG026_20231221_上級監督者教育(安全衛生その他)</td><td style="bgcolor:green">完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG027</td><td>SG027_20240105_通勤災害の共有、通災MAPの教育</td><td>完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG028</td><td>SG028_20240110_熱戻し炉常時監視、省エネモード　取り扱い説明(安全衛生)</td><td>完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG029</td><td>SG029_20240110_通勤災害についての教育(安全衛生)</td><td>完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG030</td><td>SG030_20240111_AB工程　異物検出・テープ貼り位置検出カメラ教育(その他)</td><td>完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG031</td><td>SG031_20240206_教育訓練記録についての教育(その他)</td><td>完了</td><td></td><td>完了</td><td></td></tr>
                    <tr><td>SG032</td><td>SG032_20240209_教育訓練記録についての教育(安全衛生)</td><td>進行中</td><td></td><td></td><td></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="training" id="training" style="display: none">
        <p>TRAINING</p>
        </div>
        <div class="regsignature" id="regsignature" style="display: none">
        <p>REGISTER SIGNATURE</p>
        </div>
        <div class="usermanagement" id="usermanagement" style="display: none">
        <p>USER MANAGEMENT</p>
        </div>
        <div class="attendanceDIV" id="attendance" style="display: none">
        
        </div>
    </div>
</body>
</html>

<script type="text/javascript" src="home.js"></script>