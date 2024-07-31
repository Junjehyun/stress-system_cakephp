<?php $this->assign('title', '産業医一覧'); ?>
<div class="container w-3/4 mx-auto py-8">
    <div class="bg-zinc-50 p-3 rounded shadow-xl gap-3">
        <?= $this->Form->create(null, ['url' => ['controller' => 'DoctorList', 'action' => 'hyojiSearch']]) ?>
            <div class="flex flex-wrap justify-center items-center gap-3">
                <div class="mx-auto mt-3 w-3/5">
                    <!--会社名-->
                    <div class="flex items-center justify-start mb-3 space-x-4">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="companyCheck" name="companyCheck" class="form-checkbox h-6 w-6 transition duration-150 ease-in-out" <?= (!empty($companyCheck) && $companyCheck === 'true') || !empty($this->request->getData('companyCheck')) ? 'checked' : '' ?> onchange="changeActiveCheckBox()">
                            <label class="text-gray-500 font-bold text-2xl px-2 mb-0">会社名</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input id="companyNameInput" name="companyNameInput" type="text" class="form-control placeholder-gray-500 border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-lime-500 focus:border-transparent disabled:bg-gray-200 disabled:cursor-not-allowed" style="width: 200px;" placeholder="会社名を入力" value="<?= h($companyNameInput ?: $this->request->getData('companyNameInput')) ?>">
                            <button type="button" id="ajaxSearchBtn" class="bg-lime-200 hover:bg-lime-400 text-green-800 font-bold py-2 px-4 rounded focus:outline-none border-none disabled:bg-gray-200 disabled:hover:bg-gray-300" disabled>
                                検索
                            </button>
                            <select id="companyNameOutput" name="companyNameOutput" class="form-select bg-white border border-gray-300 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-2xl" style="width: 200px;" disabled>
                                <option value="">会社名を選択</option>
                                <?php if (!empty($companyName)): ?>
                                    <option value="<?= h($companyName) ?>" selected><?= h($searchResultCompany->KAISYA_NAME_JPN) ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!--組織名-->
                    <div class="flex items-center justify-start mb-3 space-x-4">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="soshikiCheck" name="soshikiCheck" class="form-checkbox h-6 w-6 transition duration-150 ease-in-out" <?= (!empty($soshikiCheck) && $soshikiCheck === 'true') || !empty($this->request->getData('soshikiCheck')) ? 'checked' : '' ?> onchange="changeActiveCheckBox()">
                            <label class="text-gray-500 font-bold text-2xl px-2 mb-0">組織名</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input id="soshikiNameInput" name="soshikiNameInput" type="text" class="form-control placeholder-gray-500 border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-lime-500 focus:border-transparent disabled:bg-gray-200 disabled:cursor-not-allowed"  style="width: 200px;" placeholder="組織名を入力" value="<?= h($soshikiNameInput ?: $this->request->getData('soshikiNameInput')) ?>">
                            <button type="button" id="ajaxSoshikiBtn" class="bg-lime-200 hover:bg-lime-400 text-green-800 font-bold py-2 px-4 rounded focus:outline-none border-none disabled:bg-gray-200 disabled:hover:bg-gray-300">
                                検索
                            </button>
                            <select id="soshikiNameOutput" name="soshikiNameOutput" class="form-select bg-white border border-gray-300 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-2xl" style="width: 200px;">
                                <option value="">組織名を選択</option>
                                <?php if (!empty($soshikiName)): ?>
                                    <option value="<?= h($soshikiName) ?>" selected><?= h($searchResultSoshiki->SOSHIKI_NAME_JPN) ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!-- 権限区分 -->
                    <div class="mt-4">
                        <div class="form-check inline-flex items-center">
                            <input id="kengenCheck" name="kengenCheck" type="checkbox" class="form-checkbox h-6 w-6 text-indigo-600 transition duration-150 ease-in-out" <?= (!empty($kengenCheck) && $kengenCheck === 'true') || !empty($this->request->getData('kengenCheck')) ? 'checked' : '' ?>>
                            <span class="text-gray-500 font-bold text-2xl px-2">権限区分</span>
                        </div>
                        <div class="mt-2">
                            <div class="inline-flex items-center mr-2">
                                <input type="radio" class="" id="kengenKubun1" name="kengenKubun" value="1" 
                                <?= ($this->request->getData('kengenKubun') == '1' || $this->request->getQuery('kengenKubun') == '1') ? 'checked' : '' ?>>
                                <label class="text-gray-500 text-2xl font-bold h-1 ml-2">全社</label>
                            </div>
                            <div class="inline-flex items-center">
                                <input type="radio" class="" id="kengenKubun2" name="kengenKubun" value="2" 
                                <?= ($this->request->getData('kengenKubun') == '2' || $this->request->getQuery('kengenKubun') == '2') ? 'checked' : '' ?>>
                                <label class="text-gray-500 text-2xl font-bold h-1 ml-2">自社</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-lime-200 hover:bg-lime-400 text-green-800 font-bold py-2 px-4 rounded mr-5 border-none">
                    表示する
                </button>
                <button type="button" class="bg-teal-200 hover:bg-teal-400 text-green-800 font-bold py-2 px-4 rounded border-none" onclick="goToCreate()">
                    追加する
                </button>
            </div>
            <!--checkbox hidden-->
        <div class="w-1/4">
            <?= $this->Form->hidden('hidden_companyCheck', ['value' => !empty($companyCheck) && $companyCheck === 'true' ? 'true' : 'false', 'id' => 'hidden_companyCheck']) ?>
            <?= $this->Form->hidden('hidden_soshikiCheck', ['value' => !empty($soshikiCheck) && $soshikiCheck === 'true' ? 'true' : 'false', 'id' => 'hidden_soshikiCheck']) ?>
            <?= $this->Form->hidden('hidden_kengenCheck', ['value' => !empty($kengenCheck) && $kengenCheck === 'true' ? 'true' : 'false', 'id' => 'hidden_kengenCheck']) ?>
            <!--input hidden-->
            <?= $this->Form->hidden('hidden_companyNameInput', ['value' => $companyNameInput, 'id' => 'hidden_companyNameInput']) ?>
            <?= $this->Form->hidden('hidden_soshikiNameInput', ['value' => $soshikiNameInput, 'id' => 'hidden_soshikiNameInput']) ?>
            <!-- select hidden -->
            <?= $this->Form->hidden('hidden_companyNameOutput', ['value' => $companyNameOutput, 'id' => 'hidden_companyNameOutput']) ?>
            <?= $this->Form->hidden('hidden_soshikiNameOutput', ['value' => $soshikiNameOutput, 'id' => 'hidden_soshikiNameOutput']) ?>
            <!--radio hidden-->
            <?= $this->Form->hidden('hidden_kengenKubun', ['value' => $kengenKubun, 'id' => 'hidden_kengenKubun']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table-auto border-collapse border border-gray-50 hover:bg-zinc-50 text-center align-middle w-full text-2xl">
            <thead>
                <tr class="bg-zinc-100">
                    <th class="border-r border-zinc-300 text-center">No.</th>
                    <th class="border-r border-zinc-300 text-center">利用者ID</th>
                    <th class="border-r border-zinc-300 text-center">氏名</th>
                    <th class="border-r border-zinc-300 text-center">会社名</th>
                    <th class="border-r border-zinc-300 text-center">組織名</th>
                    <th class="border-r border-zinc-300 text-center">権限区分</th>
                    <th class="border-r border-zinc-300 text-center">備考</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= $index + 1 ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= h($user->USER_ID) ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= h($user->NAME) ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= h($user->kaisya_mst->KAISYA_NAME_JPN) ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= h($user->taisyo_soshiki->SOSHIKI_NAME_JPN) ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center"><?= h($user->KENGEN_KUBUN == 1? '全社' : '自社') ?></td>
                    <td class="border-r border-zinc-300 font-bold text-gray-500 text-center">
                        <!-- <a href="<?= $this->Url->build(['controller' => 'DoctorEdit', 'action' => 'doctorEdit', $user->USER_ID]) ?>">
                            <button type="button" class="bg-cyan-300 hover:bg-cyan-400 py-2 px-4 rounded border-none">
                                変更
                            </button>
                        </a> -->
                        <button type="button" class="bg-cyan-300 hover:bg-cyan-400 py-2 px-4 text-white rounded border-none" onclick="goToUpdate(this)" data-userid="<?= h($user->USER_ID) ?>">
                            変更
                        </button>
                        <button type="button" class="bg-pink-300 hover:bg-pink-400 py-2 px-4 rounded border-none" data-user-id="<?= h($user->USER_ID) ?>" onclick="deleteUser(this)">
                            削除
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator mt-10">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('最初')) ?>
                <?= $this->Paginator->prev('< ' . __('前')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('次') . ' >') ?>
                <?= $this->Paginator->last(__('最後') . ' >>') ?>
            </ul>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var hiddenCompanyNameOutput = document.getElementById('hidden_companyNameOutput').value;
        var hiddenSoshikiNameOutput = document.getElementById('hidden_soshikiNameOutput').value;

        if (hiddenCompanyNameOutput) {
            var companyNameOutputSelect = document.getElementById('companyNameOutput');
            var newOption = new Option(hiddenCompanyNameOutput, hiddenCompanyNameOutput, true, true);
            companyNameOutputSelect.add(newOption);
        }

        if (hiddenSoshikiNameOutput) {
            var soshikiNameOutputSelect = document.getElementById('soshikiNameOutput');
            var newOption = new Option(hiddenSoshikiNameOutput, hiddenSoshikiNameOutput, true, true);
            soshikiNameOutputSelect.add(newOption);
        }

        changeActiveCheckBox();
        toggleKengenKubun();
    });


    // 追加するページへ移動する
    function goToCreate() {
        // checkbox
        var companyCheck = document.getElementById('companyCheck').checked ? 'true' : 'false';
        var soshikiCheck = document.getElementById('soshikiCheck').checked ? 'true' : 'false';
        var kengenCheck = document.getElementById('kengenCheck').checked ? 'true' : 'false';
        // input 
        var companyNameInput = document.getElementById('companyNameInput').value;
        var soshikiNameInput = document.getElementById('soshikiNameInput').value;
        // select
        var companyNameOutput = document.getElementById('hidden_companyNameOutput').value;
        var soshikiNameOutput = document.getElementById('hidden_soshikiNameOutput').value;
        // radio
        //var kengenKubun = document.querySelector('input[name="kengenKubun"]:checked').value;
        var kengenKubun1 = $('input[name="kengenKubun"][value="1"]').is(':checked') ? '1' : '';
        var kengenKubun2 = $('input[name="kengenKubun"][value="2"]').is(':checked') ? '2' : '';
        var kengenKubun = kengenKubun1 || kengenKubun2;
        

        var url = '/doctor-create?' +
            'companyCheck=' + encodeURIComponent(companyCheck) +
            '&soshikiCheck=' + encodeURIComponent(soshikiCheck) +
            '&kengenCheck=' + encodeURIComponent(kengenCheck) +
            '&companyNameInput=' + encodeURIComponent(companyNameInput) +
            '&soshikiNameInput=' + encodeURIComponent(soshikiNameInput) +
            '&companyNameOutput=' + encodeURIComponent(companyNameOutput) +
            '&soshikiNameOutput=' + encodeURIComponent(soshikiNameOutput) +
            '&kengenKubun=' + encodeURIComponent(kengenKubun)
            ;
        window.location.href = url; 
    }

    function goToUpdate(button) {
        var userId = button.getAttribute('data-userid');
        console.log("User ID: ", userId); // 디버깅을 위해 추가

        // checkbox
        var companyCheck = document.getElementById('companyCheck').checked ? 'true' : 'false';
        var soshikiCheck = document.getElementById('soshikiCheck').checked ? 'true' : 'false';
        var kengenCheck = document.getElementById('kengenCheck').checked ? 'true' : 'false';
        
        // input 
        var companyNameInput = document.getElementById('companyNameInput').value;
        var soshikiNameInput = document.getElementById('soshikiNameInput').value;
        
        // select
        var companyNameOutput = document.getElementById('hidden_companyNameOutput').value;
        var soshikiNameOutput = document.getElementById('hidden_soshikiNameOutput').value;
        
        // radio
        var kengenKubun1 = $('input[name="kengenKubun"][value="1"]').is(':checked') ? '1' : '';
        var kengenKubun2 = $('input[name="kengenKubun"][value="2"]').is(':checked') ? '2' : '';
        var kengenKubun = kengenKubun1 || kengenKubun2;

        var url = '/doctor-edit/' + encodeURIComponent(userId) + '?' +
            'companyCheck=' + encodeURIComponent(companyCheck) +
            '&soshikiCheck=' + encodeURIComponent(soshikiCheck) +
            '&kengenCheck=' + encodeURIComponent(kengenCheck) +
            '&companyNameInput=' + encodeURIComponent(companyNameInput) +
            '&soshikiNameInput=' + encodeURIComponent(soshikiNameInput) +
            '&companyNameOutput=' + encodeURIComponent(companyNameOutput) +
            '&soshikiNameOutput=' + encodeURIComponent(soshikiNameOutput) +
            '&kengenKubun=' + encodeURIComponent(kengenKubun);

        console.log("Generated URL: ", url); // 디버깅을 위해 추가
        window.location.href = url;
    }

    // Ajax Search Company
    $(document).ready(function() {
        var csrfToken = <?= json_encode($this->request->getAttribute('csrfToken')); ?>;

        $('#ajaxSearchBtn').click(function() {
            var companyName = $('#companyNameInput').val();

            $.ajax({
                url: '/doctor-list/search-company',
                type: 'POST',
                data: {
                    companyName: companyName,
                    _csrfToken: csrfToken
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                },
                dataType: 'json',
                success: function(response) {

                    var $select = $('#companyNameOutput');
                    $select.empty();
                    $select.append('<option value="">会社名の結果を確認!</option>');
                    $.each(response, function(index, company) {
                        $select.append('<option value="' + company.KAISYA_CODE + '">' + company.KAISYA_NAME_JPN + '</option>');
                    });
                    $select.change(function() {
                        var selectedText = $('#companyNameOutput option:selected').text();
                        $('#hidden_companyNameOutput').val(selectedText);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('エラー: ' + error);
                }
            });
        });
    });
    // Ajax Search Soshiki
    $(document).ready(function() {
        var csrfToken = <?= json_encode($this->request->getAttribute('csrfToken')); ?>;

        $('#ajaxSoshikiBtn').click(function() {
            var soshikiName = $('#soshikiNameInput').val();

            $.ajax({
                url: '/doctor-list/search-soshiki',
                type: 'POST',
                data: {
                    soshikiName: soshikiName,
                    _csrfToken: csrfToken
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                },
                dataType: 'json',
                success: function(response) {
                    var $select = $('#soshikiNameOutput');
                    $select.empty();
                    $select.append('<option value="">組織名の結果を確認!</option>');
                    $.each(response, function(index, soshiki) {
                        $select.append('<option value="' + soshiki.SOSHIKI_CODE + '">' + soshiki.SOSHIKI_NAME_JPN + '</option>');
                    });
                    $select.change(function() {
                        var selectedText = $('#soshikiNameOutput option:selected').text();
                        $('#hidden_soshikiNameOutput').val(selectedText);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('エラー: ' + error);
                }
            });
        });
    });
    
    //削除処理
    function deleteUser(button) {
        var userId = $(button).data('user-id');
        var csrfToken = <?= json_encode($this->request->getAttribute('csrfToken')); ?>;

        if(confirm('本当に削除しますか?')) {
            $.ajax({
                url: '/doctor-list/delete-doctor',
                type: 'POST',
                data: {
                    USER_ID: userId,
                    _csrfToken: csrfToken
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('ユーザーを削除しました');
                        location.reload();
                    } else {
                        alert('削除できませんでした: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('エラー: ' + error);
                    alert('削除に失敗しました。');
                }
            });
        }
    }
    //KengenKubunの有効無効切り替え
    function toggleKengenKubun() {

        const kengenCheck = document.getElementById('kengenCheck');
        const kengenKubunInputs = document.querySelectorAll('input[name="kengenKubun"]');

        kengenKubunInputs.forEach(input => {
            input.disabled = !kengenCheck.checked;
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const kengenCheck = document.getElementById('kengenCheck');
        kengenCheck.addEventListener('change', toggleKengenKubun);

        toggleKengenKubun();
    });

    // チェックボックスの有効無効切り替え
    function changeActiveCheckBox() {
        var companyCheck = document.getElementById('companyCheck').checked;
        var soshikiCheck = document.getElementById('soshikiCheck').checked;

        var companyNameInput = document.getElementById('companyNameInput');
        var searchKaisyaBtn = document.getElementById('ajaxSearchBtn');
        var companyNameOutput = document.getElementById('companyNameOutput');

        var soshikiNameInput = document.getElementById('soshikiNameInput');
        var searchSoshikiBtn = document.getElementById('ajaxSoshikiBtn');
        var soshikiNameOutput = document.getElementById('soshikiNameOutput');

        companyNameInput.disabled = !companyCheck;
        searchKaisyaBtn.disabled = !companyCheck;
        companyNameOutput.disabled = !companyCheck;

        soshikiNameInput.disabled = !soshikiCheck;
        searchSoshikiBtn.disabled = !soshikiCheck;
        soshikiNameOutput.disabled = !soshikiCheck;

    }

    changeActiveCheckBox();
</script>