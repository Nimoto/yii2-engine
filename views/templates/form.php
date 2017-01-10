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
                    <span>Редактирование шаблона</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/templates">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            К списку шаблонов
                        </span>
                        </div>
                    </button>
                </div>
            </a>
        </div>
    </div>
    <div class="backend-content-body">
        <h2>Основные поля</h2>
        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="form-group">
        <?= $form->field($template, 'name')
            ->textInput(
                [
                    'placeholder' => 'Название',
                    'value' => $template->getName(),
                    'class' => 'form-control'
                ]
                )->label('Название');
        ?>
        </div>

        <div class="form-group">
        <?= $form->field($template, 'key')
            ->textInput(
                [
                    'placeholder' => 'Символьный код',
                    'value' => $template->getKey(),
                    'class' => 'form-control'
                ]
                )->label('Символьный код');
        ?>
        </div>
        <div class="form-group">
            <h2>Блоки</h2>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>Сортировка</th>
                        <th>Параметры</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($blocks as $block) {
                    ?>
                    <tr>
                        <td>
                            <?= $form->field($block, 'params[' . $i . '][id]')
                                ->checkbox(
                                    [
                                        'value' => $block->id,
                                        'label' => '',
                                        'class' => isset($templateBlocks[$block->id]) ? 'active' : ''
                                    ]
                                )
                                ->label('');
                            ?>
                        </td>
                        <td>
                            <?= $block->name?>
                        </td>
                        <td>
                            <?= $form->field($block, 'params[' . $i . '][sort]')
                                ->textInput(
                                    [
                                        'value' => isset($templateBlocks[$block->id]['sort']) ? $templateBlocks[$block->id]['sort'] : '',
                                    ]
                                )
                                ->label('');
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($block->params)) {
                                $params = Json::decode($block->params);
                                foreach ($params as $param => $value) {
                                    if ($param) {
                                        echo $form->field($block, 'params[' . $i . '][params][' . $param . ']')
                                            ->textInput(
                                                [
                                                    'placeholder' => $value,
                                                    'value' => isset($templateBlocks[$block->id]['params'][$param]) ? $templateBlocks[$block->id]['params'][$param] : '',
                                                    'class' => 'form-control'
                                                ]
                                            )->label($param);
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="btn-wrap">
            <?= Html::submitButton('<div><span>Сохранить</span></div>', ['class' => 'blue-btn']);?>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>