<?php $this->assign('title', '産業医一登録'); ?>
<div class="container mx-auto max-w-8xl pt-8 pb-8">
<h1 class="text-center text-5xl font-bold mt-5">新規産業医登録</h1>
    <?= $this->Form->create(null, ['url' => ['controller' => 'DoctorCreate', 'action' => 'createDoctor']]) ?>
        <div class="bg-zinc-50 p-3 rounded shadow-md gap-3 max-w-[70%] mx-auto mt-10">   
            <div class="flex items-center gap-3">
                <div class="mx-auto mt-3">
                    <div class="flex items-center mb-3 space-x-6">
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">社員ID</label>
                            <?= $this->Form->text('USER_ID', ['class' => 'form-input mx-1']) ?>
                        </div>
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">氏名</label>
                            <?= $this->Form->text('NAME', ['class' => 'form-input mx-1']) ?>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 space-x-6">
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">会社名</label>
                            <?= $this->Form->select('KAISYA_CODE', $companyName, [
                                'empty' => '会社名を選択', 
                                'class' => 'form-select w-96'
                            ]) ?>
                        </div>
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">組織名</label>
                            <?= $this->Form->select('SOSHIKI_CODE', $soshikiName, [
                                'empty' => '組織名を選択',
                                'class' => 'form-select w-96'
                            ]) ?>
                        </div>
                    </div>
                    <div class="flex items-center justify-start mb-3">
                        <div class="inline-flex items-center">
                            <?= $this->Form->checkbox('KENGEN_CHECK', ['class' => 'form-checkbox mt-3', 'name' => 'kengenCheck', 'value' => '1']) ?>
                            <span class="text-gray-500 text-2xl font-bold mt-3 ml-1">権限区分</span>
                        </div>
                    </div>
                    <div class="inline-flex items-center mb-3">
                            <input type="radio" name="KENGEN_KUBUN" id="kengenKubun" value="1" class="form-radio mb-7 w-5 h-5">
                            <label class="text-gray-500 text-2xl font-bold ml-1.5"> 全社</label>
                            <input type="radio" name="KENGEN_KUBUN" id="kengenKubun" value="2" class="form-radio mb-7 w-5 h-5 ml-3">
                            <label class="text-gray-500 text-2xl font-bold ml-1.5"> 自社</label>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-cyan-300 hover:bg-cyan-500 font-bold py-2 px-4 rounded mr-2.5 border-none">確定</button>
                        <button type="button" class="bg-pink-300 hover:bg-pink-500 font-bold py-2 px-4 rounded border-none" onclick="backToListBtn()">戻る</button>
                    </div>
                </div>
            </div>
        </div>
        <!--会社名のhidden-->
        <?= $this->Form->text('hidden_companyCheck', ['value' => $companyCheck]) ?>
        <?= $this->Form->text('hidden_soshikiCheck', ['value' => $soshikiCheck]) ?>
        <?= $this->Form->text('hidden_kengenCheck', ['value' => $kengenCheck]) ?>
        <?= $this->Form->text('hidden_companyNameInput', ['value' => $companyNameInput]) ?>
        <?= $this->Form->text('hidden_soshikiNameInput', ['value' => $soshikiNameInput]) ?>

        <?= $this->Form->text('hidden_companyNameOutput', ['value' => $this->request->getQuery('companyNameOutput')]) ?>
        <?= $this->Form->text('hidden_kengenKubun', ['value' => $kengenKubun]) ?>
    <?= $this->Form->end() ?>
</div>
<script>
    // 戻るボタン
    function backToListBtn() {

        var companyCheck = document.querySelector('[name="hidden_companyCheck"]').value;
        var soshikiCheck = document.querySelector('[name="hidden_soshikiCheck"]').value;
        var kengenCheck = document.querySelector('[name="hidden_kengenCheck"]').value;
        var companyNameInput = document.querySelector('[name="hidden_companyNameInput"]').value;
        var soshikiNameInput = document.querySelector('[name="hidden_soshikiNameInput"]').value;
        var kengenKubun = document.querySelector('[name="hidden_kengenKubun"]').value;

        var companyNameOutput = document.querySelector('[name="hidden_companyNameOutput"]').value;

        var url = '/doctor-list?' +
            'companyCheck=' + encodeURIComponent(companyCheck) +
            '&soshikiCheck=' + encodeURIComponent(soshikiCheck) +
            '&kengenCheck=' + encodeURIComponent(kengenCheck) +
            '&companyNameInput=' + encodeURIComponent(companyNameInput) +
            '&soshikiNameInput=' + encodeURIComponent(soshikiNameInput) +
            '&companyNameOutput=' + encodeURIComponent(companyNameOutput) +
            
            '&kengenKubun=' + encodeURIComponent(kengenKubun)
            ;

            //alert(companyNameOutput);

        window.location.href = url;

    }
</script>