<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
?>
<div class="backend-content-wrap">
    <div class="backend-content-header">
        <div>
            <div class="backend-content-title">
                <div>
                    <span>Редактирование блока</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/blocks">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            К списку блоков
                        </span>
                        </div>
                    </button>
                </div>
            </a>
        </div>
    </div>
    <div class="backend-content-body">
        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="form-group">
            <h2>Основные поля: </h2>
        <?= $form->field($block, 'name')
            ->textInput(
                [
                    'placeholder' => 'Название',
                    'value' => $block->getName(),
                    'class' => 'form-control'
                ]
                )->label('Название');
        ?>
        </div>

        <div class="form-group">
        <?= $form->field($block, 'key')
            ->textInput(
                [
                    'placeholder' => 'Символьный код',
                    'value' => $block->getKey(),
                    'class' => 'form-control'
                ]
                )->label('Символьный код');
        ?>
        </div>
        <div class="form-group">
            <?= $form->field($block, 'view')
                ->textInput(
                    [
                        'placeholder' => 'Представление',
                        'value' => $block->getView(),
                        'class' => 'form-control'
                    ]
                )->label('Представление');
            ?>
        </div>
        <div class="form-group">
            <h2>Параметры: </h2>
            <?php
            $i = 0;
            if ($params = $block->getParams()) {
                foreach ($params as $param => $value) {
                    ?>
                    <div class="form-inline row-<?= $i?>">
                    <?php
                    echo $form->field($block, 'params[' . $i . '][key]')
                        ->textInput(
                            [
                                'placeholder' => 'Ключ',
                                'value' => $param,
                                'class' => 'form-control'
                            ]
                        )->label('');
                    echo $form->field($block, 'params[' . $i . '][value]')
                        ->textInput(
                            [
                                'placeholder' => 'Значение',
                                'value' => $value,
                                'class' => 'form-control'
                            ]
                        )->label('');
                    ?>
                        <div class="form-group">
                            <?= Html::button('-', ['class' => 'btn btn-primary delete', 'data-id' => $i]);?>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
        </div>
        <div class="form-group adding-fields">
            <div class="form-inline row-<?= $i?>">
                <?php
                echo $form->field($block, 'params[' . $i . '][key]')
                    ->textInput(
                        [
                            'placeholder' => 'Ключ',
                            'class' => 'form-control'
                        ]
                    )->label('');
                echo $form->field($block, 'params[' . $i . '][value]')
                    ->textInput(
                        [
                            'placeholder' => 'Значение',
                            'class' => 'form-control'
                        ]
                    )->label('');
                ?>
                <div class="form-group">
                    <?= Html::button('+', ['class' => 'btn btn-primary add', 'data-id' => $i, 'data-class' => 'Page']);?>
                    <div class="help-block"></div>
                </div>
            </div>
            <?php
            ?>
        </div>
        <div class="btn-wrap">
            <?= Html::submitButton('<div><span>Сохранить</span></div>', ['class' => 'blue-btn']);?>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>