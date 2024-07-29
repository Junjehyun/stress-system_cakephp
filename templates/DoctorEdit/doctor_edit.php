<?php $this->assign('title', '産業医一編集'); ?>
<div class="container mx-auto max-w-8xl pt-8 pb-8">
<h1 class="text-center text-5xl font-bold mt-5">新規産業医編集</h1>
    <?= $this->Form->create($userUpdating, ['url' => ['action' => 'doctorEdit', $userUpdating->USER_ID], 'type' => 'post']) ?>
        <div class="bg-zinc-50 p-3 rounded shadow-md gap-3 max-w-[70%] mx-auto mt-10">
            <div class="flex flex-wrap justify-between items-center gap-3">
                <div class="mx-auto mt-3">
                    <div class="flex items-center mb-3 space-x-6">
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">社員ID</label>
                            <?= $this->Form->text('USER_ID', [
                                'class' => 'form-input disabled:bg-gray-200 cursor-not-allowed',
                                'disabled' => true,    
                            ]) ?>
                        </div>
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">氏名</label>
                            <?= $this->Form->text('NAME', [
                                'class' => 'form-input',    
                            ]) ?>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 space-x-6">
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">会社名</label>
                            <?= $this->Form->select('KAISYA_CODE', $kaisyaList, [
                                'class' => 'form-select',
                            ]) ?>
                        </div>
                        <div class="inline-grid items-center">
                            <label class="text-gray-500 text-2xl font-bold mb-2">組織名</label>
                            <?= $this->Form->select('SOSHIKI_CODE', $soshikiList, [
                                'class' => 'form-select',
                            ]) ?>
                        </div>
                    </div>
                    <div class="flex items-center justify-start mb-3">
                        <div class="inline-flex items-center">
                            <?= $this->Form->checkbox('KENGEN_CHECK', [
                                'class' => 'form-checkbox mt-3', 
                                'name' => 'kengenCheck', 
                                'value' => '1',
                                'checked' => true
                            ]) ?>
                            <span class="text-gray-500 text-2xl font-bold mt-3 ml-1">権限区分</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-start mb-3">
                        <?= $this->Form->radio('KENGEN_KUBUN', [
                            [
                                'value' => '1',
                                'text' => '全社',
                                'id' => 'kengenKubun1',
                                'class' => 'form-radio mb-7 text-gray-500 text-base font-bold mr-4'
                            ],
                            [
                                'value' => '2',
                                'text' => '自社',
                                'id' => 'kengenKubun2',
                                'class' => 'form-radio mb-7 text-gray-500 text-base font-bold'
                            ]
                        ]); ?>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-cyan-300 hover:bg-cyan-500 font-bold py-2 px-4 rounded mr-2.5 border-none">確定</button>
                        <button type="button" class="bg-pink-300 hover:bg-pink-500 font-bold py-2 px-4 rounded border-none" onclick="backToListBtn()">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
<script>
    // 戻るボタン
    function backToListBtn() {
        location.href = '/doctor-list';
    }
</script>